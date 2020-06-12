<?php

declare(strict_types=1);

namespace Tests\Module\Unit;

use App\Module\Core\Libraries\Plugins\Module;
use App\Module\Core\Providers\ServiceProvider;
use Carbon\Laravel\ServiceProvider as LaravelServiceProvider;
use InvalidArgumentException;
// use Tests\Module\TestCase;
use \PHPUnit\Framework\TestCase;

// Atenção!
// Os testes devem extender 'Tests\Module\TestCase'!!
// Este é um caso a parte para testar o mecanismo principal 

class CoreLibrariesPluginsModuleTest extends TestCase
{
    /** @test */
    public function pathNotExists()
    {
        $this->expectException(InvalidArgumentException::class);
        new Module('Teste', __DIR__ . '/../files/not-exixts');
    }

    /** @test */
    public function invalidPath()
    {
        $this->expectException(InvalidArgumentException::class);
        new Module('Teste', __DIR__ . '/../files');
    }

    /** @test */
    public function accessing()
    {
        $path = __DIR__ . '/../files/module_path';

        $instance = new Module('Teste', $path, [ServiceProvider::class]);
        $this->assertEquals('Teste', $instance->name());
        $this->assertEquals('test_one', $instance->tag());
        $this->assertEquals($path, $instance->path());
        $this->assertEquals('shore_one', $instance->config()->param('config_one.theme'));
        $this->assertEquals('shore_two', $instance->config()->param('config_two.theme'));
        $this->assertCount(1, $instance->providers());
        $this->assertEquals(ServiceProvider::class, $instance->providers()[0]);

        // Não pode haver duplicidade de providers
        $instance->addProvider(ServiceProvider::class);
        $this->assertCount(1, $instance->providers());

        $instance->addProvider(LaravelServiceProvider::class);
        $this->assertCount(2, $instance->providers());

    }

    
}
