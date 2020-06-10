<?php

declare(strict_types=1);

namespace App\Module\Core\Providers;

use App\Module\Core\Console\Commands\CoreCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Str;

/**
 * O serviceProvider é a forma que um pacote se comunicar com o projeto principal do Laravel.
 * Através dele é possivel personalizar o caminho das configurações, rotas, views e assets da 
 * aplicação, segmentando as funcionalidades num contexto delimitado.
 * 
 * Para mais informações sobre pacotes do Laravel,
 * leia https://laravel.com/docs/7.x/packages
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Este método é invocado pelo Laravel apenas após todos os pacotes serem registrados.
     * Veja o método register().
     * 
     * Aqui pode-se implementar tratativas específicas do pacote em questão, como invocação de 
     * classes que só existem no pacote, ou utilização de classes provenientes de outros 
     * módulos de dependência.
     */
    public function boot()
    {
        $sufix = $this->sufix();
    
        if ($this->app->runningInConsole()) {

            // Aqui devem ser registrados quantos comandos forem necesários
            $this->commands([
                CoreCommand::class,
            ]);
        }

        // Arquivos publicados pelo artisan:
        // Ex: php artisan vendor:publish --tag=modules --force
        $this->publishes([
            __DIR__.'/../../public' => public_path("modules/{$sufix}"),
            __DIR__."/../../config/module_{$sufix}.php" => config_path("module_{$sufix}.php"),
        ], 'modules');

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
        $sufix = $this->sufix();
    
        $rootPath = realpath(__DIR__."/../../");
        
        // O 'mergeConfigFrom' junta os valores do arquivo de configuração disponíveis no módulo
        // com o o arquivo de mesmo nome, publicado no projeto principal do Laravel
        // para que não existam inconsistencias ou ausência de parâmetros usados pelo módulo
        $this->mergeConfigFrom("{$rootPath}/config/module_{$sufix}.php", "module_{$sufix}");

        $this->loadRoutesFrom("{$rootPath}/routes/web.php");
        $this->loadRoutesFrom("{$rootPath}/routes/api.php");

        // Nos templates do Blade as views do módulo devem ser utilizadas com prefixo.
        // Ao invés de @include('minha.linda.view'), 
        // deve-se usar @include('core::minha.linda.view')
        $this->loadViewsFrom("{$rootPath}/resources/views/", "module-{$sufix}");
        
        $this->loadMigrationsFrom("{$rootPath}/database/migrations/", "module-{$sufix}");
        $this->loadTranslationsFrom("{$rootPath}/resources/lang/", "module-{$sufix}");

        // Disponibiliza a classe principal do módulo como um alias acessível
        // pelo namespace 'module-core'
        $this->app->alias(Module::class, "module-{$sufix}");
    }
    
    private function sufix()
    {
        $namespace = (new ModuleConfig)->config('module_namespace');
        return Str::snake($namespace);
    }
}
