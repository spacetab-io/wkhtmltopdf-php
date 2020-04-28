<?php

declare(strict_types=1);

namespace Spacetab\Tests\WkHTML\Unit\OptionBuilder;

use Amp\PHPUnit\AsyncTestCase;
use Spacetab\WkHTML\OptionBuilder\PDF;

class PDFTest extends AsyncTestCase
{
    public function testPdfOptions()
    {
        $pdf = new PDF();
        $pdf->addGrayscale();
        $pdf->addCopies(2);
        $pdf->addEncoding('utf-8');
        $pdf->addDisableJavascript();
        $pdf->addDefaultHeader();
        $pdf->addBackground();
        $pdf->addOption('test', 'value');
        $pdf->addCollate();
        $pdf->addDisableExternalLinks();
        $pdf->addDisableInternalLinks();
        $pdf->addDisableSmartShrinking();
        $pdf->addDpi(100);
        $pdf->addEnableExternalLinks();
        $pdf->addEnableForms();
        $pdf->addDisableForms();
        $pdf->addFooterCenter('center');
        $pdf->addFooterFontName('fontName');
        $pdf->addFooterFontSize(10);
        $pdf->addFooterHtml('html');
        $pdf->addFooterLeft('left');

        $array = [
            '--grayscale' => true,
            '--copies' => '2',
            '--encoding' => 'utf-8',
            '--disable-javascript' => true,
            '--default-header' => true,
            '--background' => true,
            'test' => 'value',
            '--collate' => true,
            '--disable-external-links' => true,
            '--disable-internal-links' => true,
            '--disable-smart-shrinking' => true,
            '--dpi' => '100',
            '--enable-external-links' => true,
            '--enable-forms' => true,
            '--disable-forms' => true,
            '--footer-center' => 'center',
            '--footer-font-name' => 'fontName',
            '--footer-font-size' => '10',
            '--footer-html' => 'html',
            '--footer-left' => 'left',
        ];

        $this->assertSame($array, $pdf->getOptions());
    }
}
