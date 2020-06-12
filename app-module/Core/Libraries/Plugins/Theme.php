<?php

declare(strict_types=1);

namespace App\Module\Core\Libraries\Plugins;

class Theme extends Module
{
    protected function formatPrefixUrl(): string
    {
        return "/themes/" . $this->tag();
    }
}
