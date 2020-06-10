<?php

declare(strict_types=1);

namespace App\Module\Core\Console;

use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;

class ComposerScripts
{
    private static $instance;
    
    private $moduleConfigFirst;
    
    private $moduleConfig;
    
    protected static function instance()
    {
        if (static::$instance === null) {
            static::$instance = new self();
            static::$instance->bootstrap();
        }
        
        return static::$instance;
    }
    
    /**
     * Carrega as configurações existentes neste módulo
     * e as disponibiliza com o formato de notação pontuada 'module_core.minha_conf.legal'.
     */
    private function config(string $param)
    {
        if ($this->moduleConfig === null) {
        
            $path = __DIR__ . '/../../config/';
            $list = scandir($path);
            array_map(function($file) use($path) {
            
                if (in_array($file, ['.', '..']) === true) {
                    return $path;
                }
                
                $configName = str_replace(['-', '.php'], ['_',''], $file);
                $this->moduleConfig[$configName] = include realpath($path . $file);
                
                if ($this->moduleConfigFirst === null) {
                    $this->moduleConfigFirst = $configName;
                }
                
            }, $list);

            $this->moduleConfig = Arr::dot($this->moduleConfig);
        }
        
        if ($this->moduleConfig === null) {
            return null;
        }
        
        return $this->moduleConfig[$param] 
            ?? $this->moduleConfig["{$this->moduleConfigFirst}.{$param}"];
    }

    /**
     * Handle the post-install Composer event.
     *
     * @param  \Composer\Script\Event  $event
     * @return void
     */
    public static function postInstall(Event $event)
    {
        $script = self::instance();
        $laravelPath = $script->config('module_core.laravel_install_path');
        $script->clearCompiled($event, $laravelPath);
    }

    /**
     * Handle the post-update Composer event.
     *
     * @param  \Composer\Script\Event  $event
     * @return void
     */
    public static function postUpdate(Event $event)
    {
        $script = self::instance();
        $laravelPath = $script->config('module_core.laravel_install_path');
        $script->clearCompiled($event, $laravelPath);
    }

    /**
     * Manipula o evento de 'post-autoload-dump'.
     *
     * @param  \Composer\Script\Event  $event
     * @return void
     * @see https://getcomposer.org/apidoc/master/Composer/Script/Event.html
     */
    public static function postAutoloadDump($event)
    {
        $script = self::instance();
        $laravelPath = $script->config('module_core.laravel_install_path');
        $script->updateModule($event, $laravelPath);
        $script->clearCompiled($event, $laravelPath);
    }
    
    private function bootstrap()
    {
        require __DIR__ . '/../../vendor/autoload.php';
        
        $laravelPath = self::instance()->config('module_core.laravel_install_path');
        if (is_file("{$laravelPath}/.env") === false) {
            $event->getIO()->error("O diretório {$laravelPath} não parece conter uma instalação válida do Laravel");
        }
    }

    /**
     * Atualiza o módulo automaticamente na instalação do Laravel.
     *
     * @return void
     */
    protected function updateModule($event, string $laravelPath)
    {
        $laravel = new Application($laravelPath);

        $composerJson = getcwd() . "/composer.json";
        if (is_file($composerJson) === false) {
            $event->getIO()->error("O arquivo {$composerJson} não foi encontrado");
        }
        
        $config = @json_decode(file_get_contents($composerJson));
        if (json_last_error() !== JSON_ERROR_NONE) {
            $event->getIO()->error("O arquivo {$composerJson} é inválido, ou está corrompido");
        }

        $develPath = getcwd();
        $installedPath = $laravel->basePath("vendor/{$config->name}");
        shell_exec("rm -Rf {$installedPath}");
        $this->copyDirectory($develPath, $installedPath);
    }
    
    /**
     * Limpa os arquivos de cachê do Laravel.
     *
     * @return void
     */
    protected function clearCompiled($event, string $laravelPath)
    {
        $laravel = new Application($laravelPath);

        if (file_exists($servicesPath = $laravel->getCachedServicesPath())) {
            @unlink($servicesPath);
        }

        if (file_exists($packagesPath = $laravel->getCachedPackagesPath())) {
            @unlink($packagesPath);
        }
    }
    
    private function copyDirectory(string $source, string $destination): void
    { 
        $dir = opendir($source); 
        @mkdir($destination); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($source . '/' . $file) ) { 
                    copyDirectory($source . '/' . $file,$destination . '/' . $file); 
                } else { 
                    copy($source . '/' . $file,$destination . '/' . $file); 
                } 
            } 
        } 
        
        closedir($dir); 
    } 
}