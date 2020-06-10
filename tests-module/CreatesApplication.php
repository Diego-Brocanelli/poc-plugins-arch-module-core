<?php

declare(strict_types=1);

namespace Tests\Module\Core;

use Bnw\Core\ServiceProvider;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    public function createApplication()
    {
        // A aplicação padrão do Laravel está instalada como dependência do composer
        $app = require dirname(__DIR__).'/vendor/laravel/laravel/bootstrap/app.php';

        // Muda a localização do diretório de ambiente. 
        // Onde se encontra o .env
        $app->useEnvironmentPath(__DIR__.'/../../.docker/laravel/app/');

        $app->make(Kernel::class)->bootstrap();

        // Disponibiliza este módulo para o Laravel
        $app->register(ServiceProvider::class);

        return $app;
    }
}
