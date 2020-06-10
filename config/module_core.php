<?php

declare(strict_types=1);

// Atenção, os parâmetros de configuração devem seguir o padrão de nomenclatura do Laravel
// sempre em snake_case!!

return [

    // 'App\Module\Core' para classes e 'module-core' para aliases
    'module_namespace' => 'Core', 
    
    // O caminho para a instalação do Laravel é usada quando o modulo está sendo desenvolvido
    'laravel_install_path' => realpath(__DIR__ . '/../../laravel'),
    
    'theme' => 'bnw/poc-plugins-arch-theme-01'
];
