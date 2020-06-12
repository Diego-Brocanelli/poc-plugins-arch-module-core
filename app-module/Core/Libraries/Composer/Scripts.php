<?php

declare(strict_types=1);

namespace App\Module\Core\Libraries\Composer;

use App\Module\Core\Libraries\Plugins\Config;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Foundation\Application;

class Scripts
{
    private static $instance;
    
    protected static function instance()
    {
        if (static::$instance === null) {
            static::$instance = new Scripts();
            static::$instance->bootstrap();
        }
        
        return static::$instance;
    }

    private function bootstrap()
    {
        require __DIR__ . '/../../../../vendor/autoload.php';
        
        $laravelPath = self::instance()->config('module_core.laravel_path');

        if (is_file("{$laravelPath}/.env") === false) {
            $event->getIO()->error("O diretório {$laravelPath} não parece conter uma instalação válida do Laravel");
        }

    }
    
    /**
     * Obtem o valor de um parâmetro de configuração existente neste módulo.
     * A busca deve ser feira usando a notação pontuada do Laravel.
     * Ex.: module_core.minha_conf.legal
     */
    private function config(string $param)
    {
        return (new Config(__DIR__ . '/../../../../config'))->param($param);
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
        $laravelPath = $script->config('module_core.laravel_path');
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
        $laravelPath = $script->config('module_core.laravel_path');
        $script->clearCompiled($event, $laravelPath);
    }

    /**
     * Manipula o evento de 'pre-autoload-dump'.
     *
     * @param  \Composer\Script\Event  $event
     * @return void
     * @see https://getcomposer.org/apidoc/master/Composer/Script/Event.html
     */
    public static function preAutoloadDump($event)
    {
        $script = self::instance();
        $laravelPath = $script->config('module_core.laravel_path');
        $script->updateModule($event, $laravelPath);
        $script->clearCompiled($event, $laravelPath);
    }

    /**
     * Atualiza o módulo automaticamente na instalação do Laravel.
     * Para não precisar executar "composer update".
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

        $laravelVendor = $laravel->basePath("vendor");
        if (is_dir($laravelVendor) === false) {
            $event->getIO()->error("O diretório {$laravelVendor} não foi encontrado");
        }

        $develPath = getcwd();
        $installedPath = $laravel->basePath("vendor/{$config->name}");
        shell_exec("rm -Rf {$installedPath}");
        $this->copyDirectory($develPath, $installedPath);

        // Publica os assets
        shell_exec("cd $laravelPath; php artisan vendor:publish --tag=assets --force");
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
                    $this->copyDirectory($source . '/' . $file,$destination . '/' . $file); 
                } else { 
                    copy($source . '/' . $file,$destination . '/' . $file); 
                } 
            } 
        } 
        
        closedir($dir); 
    }
}
