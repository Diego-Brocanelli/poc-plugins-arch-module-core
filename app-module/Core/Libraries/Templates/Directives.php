<?php

declare(strict_types=1);

namespace App\Module\Core\Libraries\Templates;

use Illuminate\Support\Facades\Blade;

/**
 * Esta é a classe contem os helpers usados para compilar diretivas 
 * do Laravel personalizadas.
 */
class Directives
{
    public function __construct()
    {
        // ...        
    }

    public function boot()
    {
        $directives = [
            'core_extends' => 'compileExtends',
            'core_test'    => 'compileTest'
        ];

        foreach($directives as $name => $method) {
            Blade::directive($name, Directives::class . "::{$method}");
        }
    }

    protected function compileExtends($expression)
    {
        $expression = trim($expression, "'");
        $view = Handler::instance()->resolveExtendsCore($expression);
        Blade::compileString("@extends('{$view}')");
    }

    protected function compileTest($expression)
    {
        return "<?php echo {$expression}; ?>";
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([new self(), $name], $arguments);
    }
    
}
