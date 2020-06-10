<?php

declare(strict_types=1);

namespace App\Module\Core\Providers;

/**
 * Esta é a classe que permite acesso a todas as funcionalidades do módulo.
 * Ela funciona como uma API, para que o módulo seja acessível a partir de outro módulos de forma
 * facilitada e direta.
 */
class Module
{
    static $instance;

    private $registers = [
    
        // namespace do módulo atualmente em execução
        'module'      => 'none',
        
        // namespace do tema utilizado  
        'theme_module' => 'none'
    ];

    public static function instance() : Module
    {
        if (static::$instance === null) {
            static::$instance = new Module();
        }

        return static::$instance;
    }

    /**
     * Diz para o "módulo compartilhado" qual é o "módulo plugin" atualmente em execução.
     * Essa informação possibilita que o mecanismo principal decida quais assets incorporar
     * na hora de desenhar a página html.
     */
    public function setCurrentModule(string $module) : void
    {
        $this->registers['module'] = $module;
    }

    public function currentModule() : string
    {
        return $this->registers['module'];
    }

    // public function setMainModule(string $module, string $tagScript) : void
    // {
    //     $this->registers['main-module'] = [
    //         'module' => $module,
    //         'style'  => "{$tagScript}.css",
    //         'script' => "{$tagScript}.js",
    //     ];
    // }

    public function mainCss()
    {
    //     if ($this->registers['main-module']['module'] === 'none') {
    //         return '';
    //     }

    //     $module = $this->registers['main-module']['module'];
    //     $style  = $this->registers['main-module']['style'];

    //     return "<link href='/modules/{$module}/css/{$style}' rel='stylesheet' />";
    }

    public function mainJs()
    {
    //     if ($this->registers['main-module']['module'] === 'none') {
    //         return '';
    //     }

    //     $module = $this->registers['main-module']['module'];
    //     $script = $this->registers['main-module']['script'];

    //     return "<script src='/modules/{$module}/js/{$script}'></script>";
    }
    

    public function moduleCss()
    {
    //     $module = $this->currentModule();
    //     if ($module === 'none') {
    //         return '';
    //     }

    //     return "<link href='/modules/{$module}/css/module.css' rel='stylesheet' />";
    }

    public function moduleJs()
    {
    //     $module = $this->currentModule();
    //     if ($module === 'none') {
    //         return '';
    //     }

    //     return "<script src='/modules/{$module}/js/module.js'></script>";
    }
}
