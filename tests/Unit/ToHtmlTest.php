<?php

declare(strict_types=1);

namespace Spacetab\Tests\WkHTML\Unit;

use Psr\Log\NullLogger;
use Spacetab\WkHTML;
use Spacetab\WkHTML\OptionBuilder;
use Amp\PHPUnit\AsyncTestCase;

class ToHtmlTest extends AsyncTestCase
{
    public function testConstructorInitializingWithOneRequiredArgument()
    {
        $image = new WkHTML\ToImage(new OptionBuilder\Image());

        $this->assertInstanceOf(WkHTML\ToImage::class, $image);
    }

    public function testConstructorHasSecondArgumentAsLogger()
    {
        $image = new WkHTML\ToImage(new OptionBuilder\Image(), new NullLogger());

        $this->assertInstanceOf(WkHTML\ToImage::class, $image);
    }
}
