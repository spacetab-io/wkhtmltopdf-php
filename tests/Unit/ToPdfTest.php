<?php

declare(strict_types=1);

namespace Spacetab\Tests\WkHTML\Unit;

use Psr\Log\NullLogger;
use Spacetab\WkHTML;
use Spacetab\WkHTML\OptionBuilder;
use Amp\PHPUnit\AsyncTestCase;

class ToPdfTest extends AsyncTestCase
{
    public function testConstructorInitializingWithOneRequiredArgument()
    {
        $pdf = new WkHTML\ToPDF(new OptionBuilder\PDF());

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
}
