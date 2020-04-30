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
        $pdf->addNoBackground();
        $pdf->addOption('test', 'value');
        $pdf->addCollate();
        $pdf->addEnableExternalLinks();
        $pdf->addKeepRelativeLinks(1);
        $pdf->addMinimumFontSize(9);
        $pdf->addPageOffset(5);
        $pdf->addPrintMediaType();
        $pdf->addNoPrintMediaType();
        $pdf->addResolveRelativeLinks();
        $pdf->addDisableExternalLinks();
        $pdf->addDisableInternalLinks();
        $pdf->addDisableSmartShrinking();
        $pdf->addEnableSmartShrinking();
        $pdf->addViewportSize('1000px');
        $pdf->addDpi(100);
        $pdf->addEnableExternalLinks();
        $pdf->addEnableForms();
        $pdf->addDisableForms();
        $pdf->addHeaderCenter('text');
        $pdf->addHeaderFontName('Arial');
        $pdf->addHeaderFontSize(10);
        $pdf->addHeaderHtml('<strong>World</strong>');
        $pdf->addHeaderLeft('left text');
        $pdf->addHeaderLine();
        $pdf->addNoHeaderLine();
        $pdf->addHeaderRight('right text');
        $pdf->addHeaderSpacing(2);
        $pdf->addReplace('[var]', '[value]');
        $pdf->addFooterCenter('center');
        $pdf->addFooterFontName('fontName');
        $pdf->addFooterFontSize(10);
        $pdf->addFooterHtml('html');
        $pdf->addFooterLeft('left');
        $pdf->addFooterRight('right');
        $pdf->addFooterLine();
        $pdf->addNoFooterLine();
        $pdf->addFooterSpacing(2);
        $pdf->addImageDpi(70);
        $pdf->addImageQuality(70);
        $pdf->addLowQuality();
        $pdf->addMarginBottom('10mm');
        $pdf->addMarginLeft('5mm');
        $pdf->addMarginRight('5mm');
        $pdf->addMarginTop('5mm');
        $pdf->addOrientation('Landscape');
        $pdf->addPageHeight('100vh');
        $pdf->addPageWidth('100mm');
        $pdf->addPageSize('A4');
        $pdf->addNoPdfCompression();
        $pdf->addTitle('title');

        $array = [
            '--grayscale' => true,
            '--copies' => '2',
            '--encoding' => 'utf-8',
            '--disable-javascript' => true,
            '--default-header' => true,
            '--background' => true,
            '--no-background' => true,
            'test' => 'value',
            '--collate' => true,
            '--enable-external-links' => true,
            '--keep-relative-links' => '1',
            '--minimum-font-size' => '9',
            '--page-offset' => '5',
            '--print-media-type' => true,
            '--no-print-media-type' => true,
            '--resolve-relative-links' => true,
            '--disable-external-links' => true,
            '--disable-internal-links' => true,
            '--disable-smart-shrinking' => true,
            '--enable-smart-shrinking' => true,
            '--viewport-size' => '1000px',
            '--dpi' => '100',
            '--enable-forms' => true,
            '--disable-forms' => true,
            '--header-center' => 'text',
            '--header-font-name' => 'Arial',
            '--header-font-size' => '10',
            '--header-html' => '<strong>World</strong>',
            '--header-left' => 'left text',
            '--header-line' => true,
            '--no-header-line' => true,
            '--header-right' => 'right text',
            '--header-spacing' => '2',
            '--replace' => '[var] [value]',
            '--footer-center' => 'center',
            '--footer-font-name' => 'fontName',
            '--footer-font-size' => '10',
            '--footer-html' => 'html',
            '--footer-left' => 'left',
            '--footer-right' => 'right',
            '--footer-line' => true,
            '--no-footer-line' => true,
            '--footer-spacing' => '2',
            '--image-dpi' => '70',
            '--image-quality' => '70',
            '--lowquality' => true,
            '--margin-bottom' => '10mm',
            '--margin-left' => '5mm',
            '--margin-right' => '5mm',
            '--margin-top' => '5mm',
            '--orientation' => 'Landscape',
            '--page-height' => '100vh',
            '--page-width' => '100mm',
            '--page-size' => 'A4',
            '--no-pdf-compression' => true,
            '--title' => 'title',
        ];

        $this->assertSame($array, $pdf->getOptions());
    }
}
