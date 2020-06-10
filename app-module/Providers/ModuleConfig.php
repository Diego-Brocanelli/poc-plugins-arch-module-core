<?php

declare(strict_types=1);

namespace App\Module\Core\Providers;

use Illuminate\Support\Arr;

/**
 * Esta é a classe que permite acesso às configurações do módulo antes do Laravel ser carregado.
 * Não há necessidade de utilizá-la dentro das implementaçções normais do Laravel,
 * destina-se somente aos scripts executados entes do carregamento do framework.
 */
class ModuleConfig
{
    static $instance;

    private $moduleConfigFirst;
    
    private $moduleConfig;

    public static function instance() : ModuleConfig
    {
        if (static::$instance === null) {
            static::$instance = new ModuleConfig();
        }

        return static::$instance;
    }

    /**
     * Obtem o valor de um parâmetro de configuração existente neste módulo.
     * A busca deve ser feita usando a notação pontuada do Laravel.
     * Ex.: module_core.minha_conf.legal
     */
    public function config(string $param)
    {
        if ($this->moduleConfig === null) {
        
            $path = __DIR__ . '/../../config/';
            $list = scandir($path);
            array_map(function($file) use($path) {
            
                if (in_array($file, ['.', '..']) === true) {
                    return $path;
                }
                
                $configName = str_replace(['-', '.php'], ['_',''], $file);
                $this->moduleConfig[$configName] = include realpath($path . $file);
                
                if ($this->moduleConfigFirst === null) {
                    $this->moduleConfigFirst = $configName;
                }
                
            }, $list);

            $this->moduleConfig = Arr::dot($this->moduleConfig);
        }
        
        if ($this->moduleConfig === null) {
            return null;
        }
        
        return $this->moduleConfig[$param] 
            ?? $this->moduleConfig["{$this->moduleConfigFirst}.{$param}"];
    }
}
