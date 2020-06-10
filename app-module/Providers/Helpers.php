<?php

use App\Module\Core\Core;

if (function_exists('dummy_core_helpers') === false) {

    function dummy_core_helpers(){}

    function main_js()
    {
        return Core::instance()->mainJs();
    }

    function main_css()
    {
        return Core::instance()->mainCss();
    }

    function module_js()
    {
        return Core::instance()->moduleJs();
    }

    function module_css()
    {
        return Core::instance()->moduleCss();
    }

}
