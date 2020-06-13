<?php

declare(strict_types=1);

namespace App\Module\Core\Providers;

use App\Module\Core\Console\Commands\CoreCommand;
use App\Module\Core\Libraries\Plugins\Handler;
use App\Module\Core\Libraries\Templates\Directives;
use Illuminate\Support\Str;

/**
 * O serviceProvider é a forma que um pacote se comunicar com o projeto principal do Laravel.
 * Através dele é possivel personalizar o caminho das configurações, rotas, views e assets da 
 * aplicação, segmentando as funcionalidades num contexto delimitado.
 * 
 * Para mais informações sobre pacotes do Laravel,
 * leia https://laravel.com/docs/7.x/packages
 */
class ServiceProvider extends ModuleServiceProvider
{
    protected function sufix(): string
    {
        return 'core';
    }

    /**
     * Deve retornar o caminho completo para o diretório raiz do módulo
     * 
     * @return string
     */
    protected function modulePath(): string
    {
        return realpath(__DIR__."/../../../");
    }

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
        parent::boot();

        (new Directives())->boot();

        // Adaptações aqui ...
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
        parent::register();

        
        // Adaptações aqui ...
    }
}
