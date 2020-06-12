<?php

declare(strict_types=1);

// Atenção, os parâmetros de configuração devem seguir o padrão de nomenclatura do Laravel
// sempre em snake_case!!

return [

    // 'App\Module\Core' para classes e 'module-core' para aliases
    'module_namespace' => 'Core', 

    // Apenas para desenvolvimento! Este parâmetro notifica o Artisan 
    // do pacote sobre a localização da instalação principal do Laravel.
    'laravel_path' => realpath(__DIR__ . '/../../laravel'),
];
