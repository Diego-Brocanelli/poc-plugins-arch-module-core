
// Retro-compatibilidade
require('html5shiv');

// Bibliotecas globais
window.$ = window.JQuery = require('jquery');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('bootstrap');
require('@fortawesome/fontawesome-free/js/all.js');
require('datatables.net-bs4');
require('datatables.net-responsive');
require('select2');
require('sweetalert2');

$(document).ready(function(){

    require('./components/form/input');

});
