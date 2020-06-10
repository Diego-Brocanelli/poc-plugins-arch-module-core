<?php

declare(strict_types=1);

namespace App\Module\Core;

use App\Module\Console\Commands\CoreCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * O serviceProvider é a forma que um modulo se comunicar com o projeto principal do Laravel.
 * Através dele é possivel personalizar o caminho das configurações, rotas, views e assets da 
 * aplicação, segmentando as funcionalidades num contexto delimitado.
 * 
 * Para mais iformações sobre módulos do Laravel,
 * leia https://laravel.com/docs/7.x/packages
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Este método é invocado pelo Laravel apenas após todos os módulos serem registrados.
     * Veja o método register().
     * 
     * Aqui pode-se implementar tratativas específicas do modulo em questão, como invocação de 
     * classes que só existem no módulo, ou utilização de classes provenientes de outros 
     * módulos de dependência.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            // Aqui devem ser registrados quantos comandos forem necesários
            $this->commands([
                CoreCommand::class,
            ]);
        }

        // Arquivos publicados pelo artisan:
        // Ex: php artisan vendor:publish --tag=core --force
        $this->publishes([
            __DIR__.'/../public' => public_path('modules/core'),
            __DIR__."/../config/module-core.php" => config_path("module-core.php"),
        ], 'module-core');

        include_once 'Helpers.php';
    }

    /**
     * Este método é invocado pelo Laravel no momento que o módulo é carregado.
     * Neste momento, o Kernel estará carregando todos os módulos disponíveis no diretório 
     * vendor e executando seus respectivos métodos register(). 
     * 
     * IMPORTANTE: Não coloque implementações que dependam de outros módulos neste método!
     * Como o laravel carregará os módulos de forma automatizada, não é possível determinar 
     * a ordem de execução!!
     */
    public function register()
    {
        // O 'mergeConfigFrom' junta os valores do arquivo de configuração disponíveis no módulo
        // com o o arquivo de mesmo nome, publicado no projeto principal do Laravel
        // para que não existam inconsistencias ou ausência de parâmetros usados pelo módulo
        $this->mergeConfigFrom(__DIR__.'/../config/module-core.php', 'module-core');

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        // Nos templates do Blade as views do módulo devem ser utilizadas com prefixo.
        // Ao invés de @include('minha.linda.view'), 
        // deve-se usar @include('core::minha.linda.view')
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'module-core');
        
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/', 'module-core');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', 'module-core');

        // Disponibiliza a classe principal do módulo como um alias acessível
        // pelo namespace 'module-core'
        $this->app->alias(Module::class, 'module-core');
    }
}
