<?php

declare(strict_types=1);

namespace Tests\Module;

use App\Module\Core\Libraries\Plugins\Handler;
use Illuminate\Contracts\Console\Kernel;
use App\Module\Core\Libraries\Composer\Parser;

trait CreatesApplication
{
    public function createApplication()
    {
        $laravelPath = Handler::instance()
             ->registerModule(\App\Module\Core\Providers\ServiceProvider::class)
             ->lastModule()
             ->config()->param('module_core.laravel_path');
        
        $app = require "{$laravelPath}/bootstrap/app.php";

        // Muda a localização do diretório de ambiente. 
        // Onde se encontra o .env
        $app->useEnvironmentPath($laravelPath);
        $app->useStoragePath($laravelPath . '/storage');

        $app->make(Kernel::class)->bootstrap();

        $config = (new Parser(__DIR__ . '/../composer.json'))->all(true);
        
        if (isset($config['extra']) 
         && isset($config['extra']['laravel'])
         && isset($config['extra']['laravel']['providers'])
        ) {
            
            // Disponibiliza os providers do módulo para o artisan
            foreach($config['extra']['laravel']['providers'] as $moduleProvider) {
                $app->register($moduleProvider);
            }
        }
        
        return $app;
    }
}
