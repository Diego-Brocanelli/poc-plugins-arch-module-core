<?php

declare(strict_types=1);

namespace App\Module\Core\Libraries\Composer;

use App\Module\Core\Libraries\Plugins\Config;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Foundation\Application;

class Scripts
{
    private static $instance;

    private $laravelPath;
    
    private function __construct()
    {
        // acesso somente através do singleton
    }

    public static function instance(): Scripts
    {
        if (static::$instance === null) {
            static::$instance = new Scripts();
            static::$instance->bootstrap();
        }
        
        return static::$instance;
    }

    private function bootstrap(): void
    {
        require __DIR__ . '/../../../../vendor/autoload.php';
        
        $this->laravelPath = self::instance()->config('module_core.laravel_path');

        if (is_file("{$this->laravelPath}/.env") === false) {
            $event->getIO()->error("O diretório {$this->laravelPath} não parece conter uma instalação válida do Laravel");
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
        $script->clearCompiled();
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
        $script->clearCompiled();
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
        $script->updateModule($event);
        $script->clearCompiled();
    }

    /**
     * Atualiza o módulo automaticamente na instalação do Laravel.
     * Para não precisar executar "composer update".
     *
     * @return void
     */
    protected function updateModule($event)
    {
        $laravel = new Application($this->laravelPath);

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
        shell_exec("cd {$this->laravelPath}; php artisan vendor:publish --tag=assets --force");
    }
    
    /**
     * Limpa os arquivos de cachê do Laravel.
     *
     * @return void
     */
    public function clearCompiled()
    {
        $laravel = new Application($this->laravelPath);

        if (file_exists($servicesPath = $laravel->getCachedServicesPath())) {
            @unlink($servicesPath);
        }

        if (file_exists($packagesPath = $laravel->getCachedPackagesPath())) {
            @unlink($packagesPath);
        }
    }

    public function clearCache()
    {
        shell_exec(implode(";", [
            "cd {$this->laravelPath}", 
            "php artisan view:cache",
            "php artisan optimize:clear"
        ]));
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
