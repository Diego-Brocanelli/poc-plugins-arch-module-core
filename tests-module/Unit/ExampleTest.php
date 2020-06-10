<?php

declare(strict_types=1);

namespace Tests\Module\Core\Unit;

use Tests\Module\Core\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function basicTest()
    {
        $this->assertTrue(1 + 1 == 2);
    }
}
