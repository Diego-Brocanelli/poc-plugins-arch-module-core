<?php

declare(strict_types=1);

namespace App\Module\Core\Libraries\Templates;

use InvalidArgumentException;

/**
 * Esta é a classe que permite acesso as todos os plugins registrados na aplicação.
 * Ela funciona como uma API, para que qualquer plugin seja acessível de forma direta.
 */
class Handler
{
    static $instance;
    
    private $views = [];

    private function __construct()
    {
        // acesso somente através do singleton
    }

    public static function instance(): Handler
    {
        if (static::$instance === null) {
            static::$instance = new Handler();
        }

        return static::$instance;
    }

    /**
      * Zera as informações do manupulador de plugins.
      * Isso é utilizado, principalemnet, para efetuar testes de unidade 
      * sem interferência de rotinas anteriormente executadas
      */
    public function flush(): Handler
    {
        $this->views = [];
        return $this;
    }

    /**
      * Registra a view que será usada no lugar do protótipo encontrado no Módulo Core.
      * Qualquer view existente no Módulo Core pode ser usada como protótipo de substituição.
      * Por exemplo, para usar um core::document personalizado, deve registrar o substituido
      * com: ...\Templates\Handler::instance()->registerView('body', 'meu::substututo.para.body')
      * 
      * @param string $serviceProvider
      */
    public function registerView(string $prototype, string $viewTag): Handler
    {
        if (view()->exists("core::{$prototype}") === false) {
            throw new InvalidArgumentException(
                "A view core::'{$prototype}' correspondente ao protótipo '{$prototype}' não existe no Módulo Core");
        }
        
        if (view()->exists($viewTag) === false) {
            throw new InvalidArgumentException(
                "A view '{$viewTag}' não foi encontrada no sistema e por isso não foi registrada");
        }

        $this->views["core::{$prototype}"] = $viewTag;

        return $this;
    }

    /**
      * Decide se a view possui substituta,
      * caso contrário, devolve a original
      * 
      * @param string $view
      */
    public function resolveExtendsCore(string $view): string
    {
        return $this->views[$view] ?? $view;
    }

    public function allReplaces(): array
    {
        return $this->views;
    }
}
