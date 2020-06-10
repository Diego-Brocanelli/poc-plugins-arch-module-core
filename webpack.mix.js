const mix = require('laravel-mix');

// Cada módulo possui seu próprio contexto, de forma que a compilação de 
// assets deve ser efetuada de forma independente do projeto principal do Laravel.

mix.js('resources/js/module.js', 'public/js')
   .sass('resources/sass/module.scss', 'public/css');
