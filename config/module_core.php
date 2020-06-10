<?php

declare(strict_types=1);

// Atenção, os parêmytreo sde configuraçãoi devem seguir o padrão de nomenclatura do Laravel
// sempre em snake_case!!

return [

    'laravel_install_path' => realpath(__DIR__ . '/../../laravel'),
    
    // Para invocar essa configuração, deve-se usar config('core.module_name')
    'module_name' => 'core',

    'module_vendor' => 'Bnw',

    'module_namespace' => 'Core',

    'module_tag' => 'core',

    // Só é utilizado se o módulo precisar ser desenvolvido em uma instalação padrão do Laravel
    'modules_path' => 'modules/',

];
