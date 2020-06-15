const mix = require('laravel-mix');

// Cada módulo possui seu próprio contexto, de forma que a compilação de 
// assets deve ser efetuada de forma independente do projeto principal do Laravel.

mix.js('resources/js/module.js', 'public/js/core.js')
   .sass('resources/sass/module.scss', 'public/css/core.css');

// Fonte de ícones
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/fonts/fontawesome5');   
