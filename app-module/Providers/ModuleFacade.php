<?php

declare(strict_types=1);

namespace App\Module\Core\Providers;

use Illuminate\Support\Facades\Facade;

/**
 * O Facade (Padrão Fachada) é um artifício usado pelo Laravel para acessar diretamente
 * as classes através de seu alias.
 * 
 * Os alias são definidos no método register() do ServiceProvider, como no exemplo a seguir:
 * $this->app->alias(\App\Module\Core\Module::class, 'module-core');
 * 
 * Para mais informações, veja /app-module/Providers/ServiceProvider.php
 */
class ModuleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $namespace = (new ModuleConfig)->config('module_namespace');
        $sufix = Str::snake($namespace);
        
        // aqui, deve-se retornar a mesma string definida no registro do módulo .
        // Ex: $this->app->alias(\App\Module\Core\Module::class, 'module-core');
        return "module-{$sufix}";
    }
}
