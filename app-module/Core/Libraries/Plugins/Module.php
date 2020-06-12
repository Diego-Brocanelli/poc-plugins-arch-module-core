<?php

declare(strict_types=1);

namespace App\Module\Core\Libraries\Plugins;

use InvalidArgumentException;
use Illuminate\Support\Str;

class Module
{
    private $moduleName;

    private $moduleTag;
    
    private $modulePath;

    private $moduleParams;
    
    private $moduleProviders = [];

    private $assetScripts = [];

    private $assetStyles = [];

    private $assetTemplates = [];
    
    public function __construct(string $name, string $rootPath, array $providers = [])
    {
        $this->setName($name)
            ->setPath($rootPath)
            ->setConfig(new Config("{$rootPath}/config/"));

        array_walk($providers, fn($item) => $this->addProvider($item));

        $config = $this->config()->all(true);

        // podem existir vários arquivos de configuração
        // por isso é preciso varrer todos!
        foreach($config as $params) {

            if (isset($params['scripts'])) {
                array_walk($params['scripts'], fn($item) => $this->addScript($item));
            }

            if (isset($params['styles'])) {
                array_walk($params['styles'], fn($item) => $this->addStyle($item));
            }

            if (isset($params['templates'])) {
                array_walk($params['templates'], fn($item, $target) => $this->addTemplateView($target, $item));
            }
        }
    }

    /**
      * O nome não pode ser mudado depois de um módulo ser construído.
      */
    protected function setName(string $name): Module
    {
        $this->moduleName = $name;
        return $this;
    }
    
    /**
      * Seta o caminho completo até o diretório root do módulo.
      * O caminho não pode ser mudado depois de um módulo ser construído.
      *
      * @param string $rootPath
      */
    protected function setPath(string $rootPath): Module
    {
        if (is_file("{$rootPath}/composer.json") === false) {
            throw new InvalidArgumentException("O caminho {$rootPath} não parece conter um módulo válido");
        }

        $this->modulePath = $rootPath;
        return $this;
    }
    
    /**
      * A instância de configuração não pode ser sobrescrita depois de um módulo ser construído. 
      * Parâmtros podem ser mudados usando a instância com self::config().
      */
    protected function setConfig(Config $config): Module
    {
        $this->moduleParams = $config;

        $namespace = $this->moduleParams->param('module_namespace');
        if ($namespace !== null) {
            $this->moduleTag = Str::snake($namespace);
            return $this;
        }
 
        $this->moduleTag = Str::snake($this->moduleName);
        return $this;
    }
    
    public function addProvider(string $serviceProviderClass): Module
    {
        // evita providers duplicados
        $this->moduleProviders[$serviceProviderClass] = $serviceProviderClass;
        return $this;
    }
    
    public function name(): string
    {
        return $this->moduleName;
    }
    
    public function tag(): string
    {
        return $this->moduleTag;
    }

    public function path(): string
    {
        return $this->modulePath;
    }
    
    public function config() : Config
    {
        return $this->moduleParams;
    }

    public function providers(): array
    {
        return array_values($this->moduleProviders);
    }

    protected function formatPrefixUrl(): string
    {
        return "/modules/" . $this->tag();
    }

    public function addScript(string $scriptName): Module
    {
        // evita scripts duplicados
        $prefix = $this->formatPrefixUrl();
        $this->assetScripts[$scriptName] = "{$prefix}/js/$scriptName";
        return $this;
    } 

    public function addStyle(string $styleName): Module
    {
        // evita estilos duplicados
        $prefix = $this->formatPrefixUrl();
        $this->assetStyles[$styleName] = "{$prefix}/css/$styleName";
        return $this;
    }

    public function addTemplateView(string $target, string $view): Module
    {
        // evita views duplicadas
        $this->assetTemplates[$target] = $view;
        return $this;
    }

    public function scripts(): array
    {
        return $this->assetScripts;
    }

    public function styles(): array
    {
        return $this->assetStyles;
    }

    public function templates(): array
    {
        return $this->assetTemplates;
    }
}
