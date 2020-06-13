<?php

declare(strict_types=1);

namespace Tests\Module;

use App\Module\Core\Libraries\Composer\Scripts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Facade;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function flushLaravelCache()
    {
        Scripts::instance()->clearCache();
    }
}
