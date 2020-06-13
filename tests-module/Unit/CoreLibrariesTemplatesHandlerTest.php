<?php

declare(strict_types=1);

namespace Tests\Module\Unit;

use App\Module\Core\Libraries\Templates\Handler;
use Error;
use Illuminate\Support\Facades\Artisan;
use InvalidArgumentException;
use Tests\Module\TestCase;

// Atenção!
// Os testes devem extender 'Tests\Module\TestCase'!!
// Este é um caso a parte para testar o mecanismo principal 

class CoreLibrariesTemplatesHandlerTest extends TestCase
{
    protected function setUp(): void
    {
        // Importante:
        // Sempre que sobrescrever o setUp, caso esteja-se usando o Tests\Module\TestCase
        // é preciso invocar a sobrecarga, pois contém implementações originais o Laravel
        parent::setUp();

        // Zera o manipulador para não haver interferência nos testes
        Handler::instance()->flush();

        $this->flushLaravelCache();
    }

    /** @test */
    public function singleton()
    {
        $this->expectException(Error::class);
        new Handler();
    }

    /** @test */
    public function registerInvalidPrototype()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("A view core::'prototype.not-exists' correspondente ao protótipo 'prototype.not-exists' não existe no Módulo Core");
        $instance = Handler::instance();
        $instance->registerView('prototype.not-exists','view.not-exists');
    }

    /** @test */
    public function registerInvalidView()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("A view 'view.not-exists' não foi encontrada no sistema e por isso não foi registrada");
        $instance = Handler::instance();
        $instance->registerView('body','view.not-exists');
    }

    /** @test */
    public function noReplace()
    {
        $instance = Handler::instance();

        // Por padrão, a view 'unit_tests.test-body' irá extender a 'core::unit_tests.test-document'
        $this->assertCount(0, $instance->allReplaces());
        $render = view('core::unit_tests.test-body')->with('name', 'legal')->render();
        $this->assertEquals('<html id="original" name="legal"> <body id="original" name="legal"></body> </html>', $render);
    }

    /** @test */
    public function replaceDirectParent()
    {
        $instance = Handler::instance();

        // O pai imediatamente a cima deve ser substituído
        $instance->registerView('unit_tests.test-document', 'core::unit_tests.test-document-replaced');
        $this->assertCount(1, $instance->allReplaces());
        $render = view('core::unit_tests.test-body')->with('name', 'nice')->render();
        $this->assertEquals('<html id="replaced" name="nice"> <body id="original" name="nice"></body> </html>', $render);
    }

    /** @test */
    public function replaceOldParent()
    {
        $instance = Handler::instance();

        // O avô deve ser substituído
        $instance->registerView('unit_tests.test-document', 'core::unit_tests.test-document-replaced');
        $this->assertCount(1, $instance->allReplaces());
        $render = view('core::unit_tests.test-component')->with('name', 'nice')->render();
        $this->assertEquals('<html id="replaced" name="nice"> <body id="original" name="nice"> <div name="nice">Testado Componente</div> </body> </html>', $render);

        $this->flushLaravelCache();

        // Ambos são substrituidos
        $instance->registerView('unit_tests.test-body', 'core::unit_tests.test-body-replaced');
        $this->assertCount(2, $instance->allReplaces());
        $render = view('core::unit_tests.test-component')->with('name', 'nice')->render();
        $this->assertEquals('<html id="replaced" name="nice"> <body id="replaced" name="nice"> <div name="nice">Testado Componente</div> </body> </html>', $render);
    }

    /** @test */
    public function replaceOnlyParent()
    {
        $instance = Handler::instance();

        // Somente o pai deve ser substituído, mantendo o avô
        $instance->registerView('unit_tests.test-body', 'core::unit_tests.test-body-replaced');
        $this->assertCount(1, $instance->allReplaces());
        $render = view('core::unit_tests.test-component')->with('name', 'nice')->render();
        $this->assertEquals('<html id="original" name="nice"> <body id="replaced" name="nice"> <div name="nice">Testado Componente</div> </body> </html>', $render);
    }
}
