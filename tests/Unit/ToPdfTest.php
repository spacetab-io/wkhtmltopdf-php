<?php

declare(strict_types=1);

namespace Spacetab\Tests\WkHTML\Unit;

use InvalidArgumentException;
use Psr\Log\NullLogger;
use Spacetab\WkHTML;
use Spacetab\WkHTML\OptionBuilder;
use Amp\PHPUnit\AsyncTestCase;

class ToPdfTest extends AsyncTestCase
{
    public function testConstructorInitializingWithoutArguments()
    {
        $pdf = new WkHTML\ToPDF();

        $this->assertInstanceOf(WkHTML\ToPDF::class, $pdf);
    }

    public function testConstructorHasSecondArgumentAsLogger()
    {
        $pdf = new WkHTML\ToPDF(new OptionBuilder\PDF(), new NullLogger());

        $this->assertInstanceOf(WkHTML\ToPDF::class, $pdf);
    }

    public function testObjectHasMethodToCustomizeBinaryPath()
    {
        $pdf = $this->createMock(WkHTML\Format\AbstractFormat::class);
        $pdf->expects($this->once())
            ->method('setBinaryPath')
            ->with('/bin/cat');

        $pdf->setBinaryPath('/bin/cat');
    }

    public function testObjectHasMethodToAddCommandEnvVariables()
    {
        $pdf = $this->createMock(WkHTML\Format\AbstractFormat::class);
        $pdf->expects($this->once())
            ->method('addEnvironment')
            ->with('USER', 'roquie');

        $pdf->addEnvironment('USER', 'roquie');
    }

    public function testsWhereUserPassedInvalidOptionAsObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/Options must be .*/');

        new WkHTML\ToPDF(new \stdClass());
    }

    public function testsWhereUserPassedInvalidOptionAsClosure()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/Options must be .*/');

        new WkHTML\ToPDF(function () {
            return new \stdClass();
        });
    }

    public function testsWhereUserPassedValidOptionAsClosure()
    {
        $image = new WkHTML\ToPDF(function (): OptionBuilder\OptionBuilderInterface {
            return new OptionBuilder\Image();
        });

        $this->assertInstanceOf(WkHTML\ToPDF::class, $image);
    }

    public function testsWhereUserPassedValidOptionAsOptionBuilder()
    {
        $image = new WkHTML\ToPDF(new class implements OptionBuilder\OptionBuilderInterface {
            public function getOptions(): array {
                return [];
            }
        });

        $this->assertInstanceOf(WkHTML\ToPDF::class, $image);
    }
}
