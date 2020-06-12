<?php

declare(strict_types=1);

namespace App\Module\Core\Libraries\Plugins;

use App\Module\Core\Libraries\Composer\Parser;
use Exception;
use InvalidArgumentException;
use ReflectionException;
use Illuminate\Support\ServiceProvider;

/**
 * Esta é a classe que permite acesso as todos os plugins registrados na aplicação.
 * Ela funciona como uma API, para que qualquer plugin seja acessível de forma direta.
 */
class Handler
{
    static $instance;
    
    private $modules = [];
    
    private $themes = [];
    
    private $modulesMap = [];

    private $themesMap = [];
    
    private $lastModule;
    
    private $currentModule;

    private $activeTheme;

    private $assets;

    private function __construct()
    {
        // acesso somente através do singleton
    }

    public static function instance(): Handler
    {
        if (static::$instance === null) {
            static::$instance = new Handler();
        }

        return static::$instance;
    }

    public function flush(): Handler
    {
        $this->modules       = [];
        $this->themes        = [];
        $this->modulesMap    = [];
        $this->themesMap     = [];
        $this->lastModule    = null;
        $this->currentModule = null;
        $this->activeTheme   = null;
        $this->assets        = null;
        return $this;
    }

    private function flushAssets(): Handler
    {
        $this->assets = null;
        return $this;
    }
    
    private function getProviderPath(string $serviceProviderClass)
    {
        try {
            $reflect = new \ReflectionClass($serviceProviderClass);
        } catch(ReflectionException $e) {
            throw new InvalidArgumentException("O ServiceProvider {$serviceProviderClass} não existe");
        }

        if($reflect->isSubclassOf(ServiceProvider::class) === false) {
            throw new InvalidArgumentException(
                "O ServiceProvider {$serviceProviderClass} é inválido, " .
                "pois não implementa Illuminate\Support\ServiceProvider");
        }

        return dirname(dirname(dirname(dirname($reflect->getFilename()))));
    }

    private function getModuleName(array $composerParams)
    {
        foreach($composerParams as $param => $value) {
            if (strpos($param, 'autoload.psr_4.app_module') !== false) {
                $nodes = explode('/', $value);
                return end($nodes);
            }
        }

        throw new Exception(
            'O parâmetro autoload.psr-4.App\\Module\\XX ' .
            'do composer.json deve conter o namespace como último nó da cadeia');
    }

    /**
      * Registra o módulo para ser encontrado pelo mecanismo posteriormente.
      * 
      * @param string $serviceProvider
      */
    public function registerModule(string $serviceProviderClass): Handler
    {
        // não é possível registrar o mesmo módulo duas vezes
        if (isset($this->modulesMap[$serviceProviderClass]) === true) {
            return $this;
        }

        $path = $this->getProviderPath($serviceProviderClass);
        $composerParams = new Parser("{$path}/composer.json");

        $name = $this->getModuleName($composerParams->all());
        
        $module = new Module($name, $path, [$serviceProviderClass]);

        $this->modules[$module->tag()] = $module;
        $this->modulesMap[$serviceProviderClass] = $module->tag();
        $this->lastModule = $module->tag();
        
        return $this;
    }

    /**
      * Registra o tema para ser encontrado pelo mecanismo posteriormente.
      * 
      * @param string $serviceProvider
      */
    public function registerTheme(string $serviceProviderClass): Handler
    {
        // não é possível registrar o mesmo módulo duas vezes
        if (isset($this->themesMap[$serviceProviderClass]) === true) {
            return $this;
        }

        $path = $this->getProviderPath($serviceProviderClass);

        $composerParams = new Parser("{$path}/composer.json");

        $name = $this->getModuleName($composerParams->all());

        $theme = new Theme($name, $path, [$serviceProviderClass]);

        $this->themes[$theme->tag()] = $theme;
        $this->themesMap[$serviceProviderClass] = $theme->tag();

        return $this;
    }
    
    public function lastModule() : ?Module
    {
        return $this->modules[$this->lastModule] ?? null;
    }
    
    public function module(string $id): ?Module
    {
        // se a identificação for o nome do ServiceProvider
        if (isset($this->modulesMap[$id]) === true) {
            $id = $this->modulesMap[$id];
        }

        return $this->modules[$id] ?? null;
    }

    public function theme(string $id): ?Theme
    {
        // se a identificação for o nome do ServiceProvider
        if (isset($this->themesMap[$id]) === true) {
            $id = $this->themesMap[$id];
        }

        return $this->themes[$id] ?? null;
    }

    public function allModules(): array
    {
        return $this->modules;
    }

    public function allThemes(): array
    {
        return $this->themes;
    }

    /**
     * Determina qual é o módulo atualmente em execução.
     * 
     * @param string $id
     */
    public function setCurrentModule(string $id): Handler
    {
        // se a identificação for o nome do ServiceProvider
        if (isset($this->modulesMap[$id]) === true) {
            $id = $this->modulesMap[$id];
        }

        if (isset($this->modules[$id]) === false) {
            throw new Exception("O módulo especificado não foi encontrado no registro");
        }

        $this->currentModule = $id;
        $this->flushAssets();
        return $this;
    }

    public function currentModule() : ?Module
    {
        return $this->modules[$this->currentModule] ?? null;
    }

    /**
     * Determina qual é o tema ativo.
     * 
     * @param string $id
     */
    public function setActiveTheme(string $id): Handler
    {
        // se a identificação for o nome do ServiceProvider
        if (isset($this->themesMap[$id]) === true) {
            $id = $this->themesMap[$id];
        }

        if (isset($this->themes[$id]) === false) {
            throw new Exception("O tema especificado não foi encontrado no registro");
        }

        $this->flushAssets();
        $this->activeTheme = $id;
        return $this;
    }

    public function activeTheme() : ?Theme
    {
        return $this->themes[$this->activeTheme] ?? ThemeDefault::factory();
    }
    
    protected function resolveAssets(): array
    {
        if ($this->assets === null) {
            
            $assets = [
                'scripts' => [],
                'styles'  => [],
            ];

            // Os assets principais sempre estão presentes.
            // Entre eles se concontra: Boosttrap4, SweetAlert, Axios, etc
            $assets['scripts'][] = '/modules/core/js/core.js';
            $assets['styles'][]  = '/modules/core/css/core.css';

            // Os assets do tema servem para adaptar a aparência do
            // sistema como um todo, modificando o Bootstrap4 e
            // os componentes adicionais como o SweetAlert, por exemplo
            $theme = $this->activeTheme();
            $assets['scripts'] = array_merge($assets['scripts'], array_values($theme->scripts()));
            $assets['styles']  = array_merge($assets['styles'], array_values($theme->styles()));

            // Por último, são acrregados os assets do módulo em execução,
            // para que seja possível ao módulo modificar algum script ou estilo
            // proveniente do Core ou do Tema
            $module = $this->currentModule();
            if ($module !== null) {
                $assets['scripts'] = array_merge($assets['scripts'], array_values($module->scripts()));
                $assets['styles']  = array_merge($assets['styles'], array_values($module->styles()));
            }

            $this->assets = $assets;
        }

        return $this->assets;
    }

    public function scripts()
    {
        $assets = $this->resolveAssets();
        return $assets['scripts'] ?? [];
    }

    public function styles()
    {
        $assets = $this->resolveAssets();
        return $assets['styles'] ?? [];
    }
}
