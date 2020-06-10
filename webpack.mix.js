const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Cada módulo possui seu próprio contexto, de forma que a compilação de 
 | assets deve ser efetuada de forma independente do projeto principal do Laravel.
 |
 */

mix.js('src/resources/js/module.js', 'src/public/js')
    .sass('src/resources/sass/module.scss', 'src/public/css');
