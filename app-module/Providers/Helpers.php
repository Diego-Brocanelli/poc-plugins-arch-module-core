<?php

use App\Module\Core\Providers\Module;

if (function_exists('dummy_core_helpers') === false) {

    function dummy_core_helpers(){}

    function main_js()
    {
        return Module::instance()->mainJs();
    }

    function main_css()
    {
        return Module::instance()->mainCss();
    }

    function module_js()
    {
        return Module::instance()->moduleJs();
    }

    function module_css()
    {
        return Module::instance()->moduleCss();
    }

}
