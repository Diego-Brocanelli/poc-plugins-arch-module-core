<?php

declare(strict_types=1);

namespace App\Module\Core\Libraries\Templates;

use App\Module\Core\Libraries\Templates\Compilers\Base;
use App\Module\Core\Libraries\Templates\Compilers\Form;
use Illuminate\Support\Facades\Blade;

/**
 * Esta é a classe contem os helpers usados para compilar diretivas 
 * do Laravel personalizadas.
 */
class Directives
{
    use Base;
    use Form;

    private $directivesList = [];

    public function boot()
    {
        $this->registerDirective('extendsTemplate', 'compileExtends');
        $this->registerDirective('includeTemplate', 'compileInclude');
        $this->registerDirective('coreTest', 'compileTest');

        foreach($this->directivesList as $name => $method) {
            Blade::directive($name, Directives::class . "::{$method}");
        }
    }

    protected function compileExtends($expression)
    {
        $expression = $this->clearExpression($expression);
        $view = Handler::instance()->resolveExtendsCore($expression);
        Blade::compileString("@extends('{$view}')");
        return ""; // A diretiva extends não deve retornar código!!
    }

    protected function compileInclude($expression)
    {
        $expression = $this->clearExpression($expression);
        $view = Handler::instance()->resolveExtendsCore($expression);
        return "<?php echo \$__env->make('{$view}', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
        //return Blade::compileString("@include('{$view}')");
    }

    protected function compileComponent(string $view)
    {
        return "<?php echo \$__env->make('{$view}', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
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
