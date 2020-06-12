<?php

declare(strict_types=1);

namespace App\Module\Core\Libraries\Plugins;

class ThemeDefault extends Theme
{
    public static function factory(): ThemeDefault
    {
        $corePath = realpath(__DIR__ . '/../../../../');
        return new ThemeDefault('Default', $corePath);
    }
}
