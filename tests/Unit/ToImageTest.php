<?php

declare(strict_types=1);

namespace Spacetab\Tests\WkHTML\Unit;

use InvalidArgumentException;
use Psr\Log\NullLogger;
use Spacetab\WkHTML;
use Spacetab\WkHTML\OptionBuilder;
use Amp\PHPUnit\AsyncTestCase;

class ToImageTest extends AsyncTestCase
{
    public function testConstructorInitializingWithoutArguments()
    {
        $image = new WkHTML\ToImage();

        $this->assertInstanceOf(WkHTML\ToImage::class, $image);
    }

    public function testConstructorHasSecondArgumentAsLogger()
    {
        $image = new WkHTML\ToImage(new OptionBuilder\Image(), new NullLogger());

        $this->assertInstanceOf(WkHTML\ToImage::class, $image);
    }

    public function testWhereUserPassedInvalidOptionAsObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/Options must be .*/');

        new WkHTML\ToImage(new \stdClass());
    }

    public function testWhereUserPassedInvalidOptionAsClosure()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/Options must be .*/');

        new WkHTML\ToImage(function () {
            return new \stdClass();
        });
    }

    public function testWhereUserPassedValidOptionAsClosure()
    {
        $image = new WkHTML\ToImage(function (): OptionBuilder\OptionBuilderInterface {
            return new OptionBuilder\Image();
        });

        $this->assertInstanceOf(WkHTML\ToImage::class, $image);
    }

    public function testWhereUserPassedValidOptionAsOptionBuilder()
    {
        $image = new WkHTML\ToImage(new class implements OptionBuilder\OptionBuilderInterface {
            public function getOptions(): array {
                return [];
            }
        });

        $this->assertInstanceOf(WkHTML\ToImage::class, $image);
    }
}
