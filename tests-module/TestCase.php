<?php

declare(strict_types=1);

namespace Tests\Module\Core;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
