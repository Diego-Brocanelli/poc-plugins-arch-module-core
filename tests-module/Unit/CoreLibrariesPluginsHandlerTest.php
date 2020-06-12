<?php

declare(strict_types=1);

namespace Tests\Module\Unit;

use App\Module\Core\Libraries\Plugins\Handler;
use App\Module\Core\Libraries\Plugins\Module;
use App\Module\Core\Libraries\Plugins\Theme;
use App\Module\Core\Libraries\Plugins\ThemeDefault;
use Error;
use Exception;
use InvalidArgumentException;
// use Tests\Module\TestCase;
use \PHPUnit\Framework\TestCase;
use Tests\Module\files\Fake\ModuleOne\app_module\One\Providers\ServiceProviderInvalid;
use Tests\Module\files\Fake\ModuleOne\app_module\One\Providers\ServiceProviderOne;
use Tests\Module\files\Fake\ModuleTwo\app_module\Two\Providers\ServiceProviderTwo;

// Atenção!
// Os testes devem extender 'Tests\Module\TestCase'!!
// Este é um caso a parte para testar o mecanismo principal 

class CoreLibrariesPluginsHandlerTest extends TestCase
{
    protected function setUp(): void
    {
        // Zera o manipulador para não haver interferência nos testes
        Handler::instance()->flush();
    }

    /** @test */
    public function singleton()
    {
        $this->expectException(Error::class);
        new Handler();
    }

    /** @test */
    public function registerNotExists()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O ServiceProvider ".ServiceProviderOne::class."Invalid não existe");
        $instance = Handler::instance();
        $instance->registerModule(ServiceProviderOne::class . 'Invalid');
    }

    /** @test */
    public function registerInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O ServiceProvider ".ServiceProviderInvalid::class." é inválido, pois não implementa Illuminate\Support\ServiceProvider");
        $instance = Handler::instance();
        $instance->registerModule(ServiceProviderInvalid::class);
    }

    /** @test */
    public function registerModule()
    {
        $instance = Handler::instance();

        $instance->registerModule(ServiceProviderOne::class);
        $last = $instance->lastModule();
        $this->assertEquals('one', $last->tag());

        $instance->registerModule(ServiceProviderTwo::class);
        $last = $instance->lastModule();
        $this->assertEquals('two', $last->tag());

        $this->assertCount(2, $instance->allModules());

        // Não pode haver duplicidade de módulos
        $instance->registerModule(ServiceProviderOne::class);
        $last = $instance->lastModule();
        $this->assertEquals('two', $last->tag());

        $this->assertCount(2, $instance->allModules());

        // Obtém o módulo pelo provider
        $module = $instance->module(ServiceProviderTwo::class);
        $this->assertInstanceOf(Module::class, $module);
        $this->assertEquals('Two', $module->name());
        $this->assertEquals('two', $module->tag());

        // Obtém o módulo pela tag
        $module = $instance->module('one');
        $this->assertInstanceOf(Module::class, $module);
        $this->assertEquals('One', $module->name());
        $this->assertEquals('one', $module->tag());

        $module = $instance->module('two');
        $this->assertInstanceOf(Module::class, $module);
        $this->assertEquals('Two', $module->name());
        $this->assertEquals('two', $module->tag());
    }

    /** @test */
    public function registerTheme()
    {
        $instance = Handler::instance()->flush();
        $instance->registerTheme(ServiceProviderOne::class);
        $instance->registerTheme(ServiceProviderTwo::class);
        $this->assertCount(2, $instance->allThemes());

        // Não pode haver duplicidade de temas
        $instance->registerTheme(ServiceProviderTwo::class);
        $this->assertCount(2, $instance->allThemes());

        // Obtém o tema pelo provider
        $theme = $instance->theme(ServiceProviderTwo::class);
        $this->assertInstanceOf(Theme::class, $theme);
        $this->assertEquals('Two', $theme->name());
        $this->assertEquals('two', $theme->tag());

        // Obtém o tema pela tag
        $theme = $instance->theme('one');
        $this->assertInstanceOf(Theme::class, $theme);
        $this->assertEquals('One', $theme->name());
        $this->assertEquals('one', $theme->tag());
        
        $theme = $instance->theme('two');
        $this->assertInstanceOf(Theme::class, $theme);
        $this->assertEquals('Two', $theme->name());
        $this->assertEquals('two', $theme->tag());
    }

    /** @test */
    public function currentModule()
    {
        $instance = Handler::instance();

        $instance->registerModule(ServiceProviderOne::class);
        $instance->registerModule(ServiceProviderTwo::class);
        $this->assertNull($instance->currentModule());

        // Quando o usuario acessar uma rota, o módulo implemenetado deverá notificar o Core 
        // para que seja possível identifica o modulo em execução
        $instance->setCurrentModule(ServiceProviderOne::class);
        $this->assertNotNull($instance->currentModule());
        $this->assertEquals('One', $instance->currentModule()->name());
        $this->assertEquals('one', $instance->currentModule()->tag());

        $instance->setCurrentModule(ServiceProviderTwo::class);
        $this->assertEquals('Two', $instance->currentModule()->name());
        $this->assertEquals('two', $instance->currentModule()->tag());
    }

    /** @test */
    public function currentModuleInvalid()
    {
        $this->expectException(Exception::class);

        $instance = Handler::instance();
        $instance->registerModule(ServiceProviderOne::class);
        $instance->registerModule(ServiceProviderTwo::class);
        $this->assertNull($instance->currentModule());

        // Módulo inexistente
        $instance->setCurrentModule('xxx');
    }

    /** @test */
    public function activateTheme()
    {
        $instance = Handler::instance();

        $instance->registerTheme(ServiceProviderOne::class);
        $instance->registerTheme(ServiceProviderTwo::class);
        $this->assertInstanceOf(ThemeDefault::class, $instance->activeTheme());

        // De alguma forma, o sistema deverá setar o tema atualmente em uso
        // seja através de uma configuração implementada ou diretamente no código fonte
        $instance->setActiveTheme(ServiceProviderOne::class);
        $this->assertNotInstanceOf(ThemeDefault::class, $instance->activeTheme());
        $this->assertEquals('One', $instance->activeTheme()->name());
        $this->assertEquals('one', $instance->activeTheme()->tag());

        $instance->setActiveTheme(ServiceProviderTwo::class);
        $this->assertEquals('Two', $instance->activeTheme()->name());
        $this->assertEquals('two', $instance->activeTheme()->tag());
    }

    /** @test */
    public function activateThemeInvalid()
    {
        $this->expectException(Exception::class);

        $instance = Handler::instance();
        $instance->registerTheme(ServiceProviderOne::class);
        $instance->registerTheme(ServiceProviderTwo::class);
        $this->assertInstanceOf(ThemeDefault::class, $instance->activeTheme());

        // Tema inexistente
        $instance->setActiveTheme('xxx');
    }

    /** @test */
    public function resolveAssets()
    {
        $instance = Handler::instance();
        $instance->registerModule(ServiceProviderTwo::class);
        $instance->registerTheme(ServiceProviderOne::class);
        $this->assertNull($instance->currentModule());
        $this->assertInstanceOf(ThemeDefault::class, $instance->activeTheme());

        // Assets padrões
        $this->assertCount(1, $instance->scripts());
        $this->assertEquals('/modules/core/js/core.js', $instance->scripts()[0]);
        $this->assertCount(1, $instance->styles());
        $this->assertEquals('/modules/core/css/core.css', $instance->styles()[0]);

        $instance->setCurrentModule(ServiceProviderTwo::class);

        // Veja: tests-module/files/Fake/ModuleTwo/config/module_two.php
        $this->assertCount(3, $instance->scripts());
        $this->assertEquals('/modules/core/js/core.js', $instance->scripts()[0]);
        $this->assertEquals('/modules/two/js/shorenaitis.js', $instance->scripts()[1]);
        $this->assertEquals('/modules/two/js/birineiders.js', $instance->scripts()[2]);

        // Veja: tests-module/files/Fake/ModuleTwo/config/module_two.php
        $this->assertCount(2, $instance->styles());
        $this->assertEquals('/modules/core/css/core.css', $instance->styles()[0]);
        $this->assertEquals('/modules/two/css/shoooo.css', $instance->styles()[1]);


        $instance->setActiveTheme(ServiceProviderOne::class);

        // Veja: tests-module/files/Fake/ModuleOne/config/module_one.php
        $this->assertCount(5, $instance->scripts());
        $this->assertEquals('/modules/core/js/core.js', $instance->scripts()[0]);
        $this->assertEquals('/themes/one/js/module.js', $instance->scripts()[1]);
        $this->assertEquals('/themes/one/js/legal.js', $instance->scripts()[2]);
        $this->assertEquals('/modules/two/js/shorenaitis.js', $instance->scripts()[3]);
        $this->assertEquals('/modules/two/js/birineiders.js', $instance->scripts()[4]);

        // Veja: tests-module/files/Fake/ModuleOne/config/module_one.php
        $this->assertCount(3, $instance->styles());
        $this->assertEquals('/modules/core/css/core.css', $instance->styles()[0]);
        $this->assertEquals('/themes/one/css/module.css', $instance->styles()[1]);
        $this->assertEquals('/modules/two/css/shoooo.css', $instance->styles()[2]);
    }
}
