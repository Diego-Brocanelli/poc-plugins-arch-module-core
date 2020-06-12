<?php

use App\Module\Core\Libraries\Plugins\Handler;

if (function_exists('dummy_core_helpers') === false) {

    function dummy_core_helpers(){}

    function front_scripts()
    {
        return Handler::instance()->scripts();
    }

    function front_styles()
    {
        return Handler::instance()->styles();
    }

}
