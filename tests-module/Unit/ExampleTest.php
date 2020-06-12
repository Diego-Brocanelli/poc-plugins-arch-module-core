<?php

declare(strict_types=1);

namespace Tests\Module\Unit;

use Tests\Module\TestCase;
// use \PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function basicTest()
    {
        $this->assertTrue(1 + 1 == 2);
    }
}
