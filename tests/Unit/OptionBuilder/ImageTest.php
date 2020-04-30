<?php

declare(strict_types=1);

namespace Spacetab\Tests\WkHTML\Unit\OptionBuilder;

use Amp\PHPUnit\AsyncTestCase;
use Spacetab\WkHTML\OptionBuilder\Image;
use Spacetab\WkHTML\OptionBuilder\PDF;

class ImageTest extends AsyncTestCase
{
    public function testImageOptions()
    {
        $image = new Image();
        $image->addEncoding('utf-8');
        $image->addDisableJavascript();
        $image->addOption('test', 'value');
        $image->addCropH(1);
        $image->addCropW(1);
        $image->addCropX(1);
        $image->addCropY(1);
        $image->addFormat('jpg');
        $image->addHeight(100);
        $image->addQuality(80);
        $image->addDisableSmartWidth();
        $image->addEnableSmartWidth();
        $image->addTransparent();
        $image->addWidth(100);

        $array = [
            '--encoding' => 'utf-8',
            '--disable-javascript' => true,
            'test' => 'value',
            '--crop-h' => '1',
            '--crop-w' => '1',
            '--crop-x' => '1',
            '--crop-y' => '1',
            '--format' => 'jpg',
            '--height' => '100',
            '--quality' => '80',
            '--disable-smart-width' => true,
            '--enable-smart-width' => true,
            '--transparent' => true,
            '--width' => '100',
        ];

        $this->assertSame($array, $image->getOptions());
    }
}
