<?php

declare(strict_types=1);

namespace Spacetab\WkHTML\OptionBuilder;

final class PDF extends AbstractOptionBuilder
{
    /**
     * Collate when printing multiple copies
     */
    public function addCollate(): void
    {
        $this->addOption('--collate');
    }

    /**
     * Do not collate when printing multiple copies
     */
    public function addNoCollate(): void
    {
        $this->addOption('--no-collate');
    }

    /**
     * Number of copies to print into the pdf file
     *
     * @param int $number
     */
    public function addCopies(int $number): void
    {
        $this->addOption('--copies', $number);
    }

    /**
     * Change the dpi explicitly (this has no effect on X11 based systems)
     *
     * @param int $value
     */
    public function addDpi(int $value): void
    {
        $this->addOption('--dpi', $value);
    }

    /**
     * PDF will be generated in grayscale
     */
    public function addGrayscale(): void
    {
        $this->addOption('--grayscale');
    }

    /**
     * When embedding images scale them down to this dpi
     *
     * @param int $value
     */
    public function addImageDpi(int $value): void
    {
        $this->addOption('--image-dpi', $value);
    }

    /**
     * When jpeg compressing images use this quality
     *
     * @param int $value
     */
    public function addImageQuality(int $value): void
    {
        $this->addOption('--image-quality', $value);
    }

    /**
     * Generates lower quality pdf/ps. Useful to shrink the result document space
     */
    public function addLowQuality(): void
    {
        $this->addOption('--lowquality');
    }

    /**
     * Set the page bottom margin
     *
     * @param string $value
     */
    public function addMarginBottom(string $value): void
    {
        $this->addOption('--margin-bottom', $value);
    }

    /**
     * Set the page left margin
     *
     * @param string $value
     */
    public function addMarginLeft(string $value): void
    {
        $this->addOption('--margin-left', $value);
    }

    /**
     * Set the page right margin
     *
     * @param string $value
     */
    public function addMarginRight(string $value): void
    {
        $this->addOption('--margin-right', $value);
    }

    /**
     * Set the page top margin
     *
     * @param string $value
     */
    public function addMarginTop(string $value): void
    {
        $this->addOption('--margin-top', $value);
    }

    /**
     * Set orientation to Landscape or Portrait
     *
     * @param string $value
     */
    public function addOrientation(string $value): void
    {
        $this->addOption('--orientation', $value);
    }

    /**
     * Page height
     *
     * @param string $value
     */
    public function addPageHeight(string $value): void
    {
        $this->addOption('--page-height', $value);
    }

    /**
     * Page width
     *
     * @param string $value
     */
    public function addPageWidth(string $value): void
    {
        $this->addOption('--page-width', $value);
    }

    /**
     * Set paper size to: A4, Letter, etc.
     *
     * @param string $value
     */
    public function addPageSize(string $value): void
    {
        $this->addOption('--page-size', $value);
    }

    /**
     * Do not use lossless compression on pdf objects
     */
    public function addNoPdfCompression(): void
    {
        $this->addOption('--no-pdf-compression');
    }

    /**
     * The title of the generated pdf file (The title of the first document is used if not specified)
     *
     * @param string $value
     */
    public function addTitle(string $value): void
    {
        $this->addOption('--title', $value);
    }

    /**
     * Do print background
     */
    public function addBackground(): void
    {
        $this->addOption('--background');
    }

    /**
     * Do not print background
     */
    public function addNoBackground(): void
    {
        $this->addOption('--no-background');
    }

    /**
     * Add a default header, with the name of the page to the left,
     * and the page number to the right, this is short for:
     * --header-left='[webpage]'
     * --header-right='[page]/[toPage]'
     * --top 2cm
     * --header-line
     */
    public function addDefaultHeader(): void
    {
        $this->addOption('--default-header');
    }

    /**
     * Do not make links to remote web pages
     */
    public function addDisableExternalLinks(): void
    {
        $this->addOption('--disable-external-links');
    }

    /**
     * Make links to remote web pages
     */
    public function addEnableExternalLinks(): void
    {
        $this->addOption('--enable-external-links');
    }

    /**
     * Do not turn HTML form fields into pdf form fields
     */
    public function addDisableForms(): void
    {
        $this->addOption('--disable-forms');
    }

    /**
     * Turn HTML form fields into pdf form fields
     */
    public function addEnableForms(): void
    {
        $this->addOption('--enable-forms');
    }

    /**
     * Do not make local links
     */
    public function addDisableInternalLinks(): void
    {
        $this->addOption('--disable-internal-links');
    }

    /**
     * Make local links
     */
    public function addEnableInternalLinks(): void
    {
        $this->addOption('--enable-internal-links');
    }

    /**
     * Keep relative external links as relative external links
     *
     * @param int $value
     */
    public function addKeepRelativeLinks(int $value): void
    {
        $this->addOption('--keep-relative-links', $value);
    }

    /**
     * Minimum font size
     *
     * @param int $value
     */
    public function addMinimumFontSize(int $value): void
    {
        $this->addOption('--minimum-font-size', $value);
    }

    /**
     * Set the starting page number
     *
     * @param int $value
     */
    public function addPageOffset(int $value): void
    {
        $this->addOption('--page-offset', $value);
    }

    /**
     * Use print media-type instead of screen
     */
    public function addPrintMediaType(): void
    {
        $this->addOption('--print-media-type');
    }

    /**
     * Do not use print media-type instead of screen
     */
    public function addNoPrintMediaType(): void
    {
        $this->addOption('--no-print-media-type');
    }

    /**
     * Resolve relative external links into absolute links
     */
    public function addResolveRelativeLinks(): void
    {
        $this->addOption('--resolve-relative-links');
    }

    /**
     * Disable the intelligent shrinking strategy used by WebKit that makes the pixel/dpi ratio none constant
     */
    public function addDisableSmartShrinking(): void
    {
        $this->addOption('--disable-smart-shrinking');
    }

    /**
     * Enable the intelligent shrinking strategy used by WebKit that makes the pixel/dpi ratio none constant
     */
    public function addEnableSmartShrinking(): void
    {
        $this->addOption('--enable-smart-shrinking');
    }

    /**
     * Set viewport size if you have custom scrollbars or css attribute overflow to emulate window size
     *
     * @param string $value
     */
    public function addViewportSize(string $value): void
    {
        $this->addOption('--viewport-size', $value);
    }

    /**
     * Centered footer text
     *
     * @param string $value
     */
    public function addFooterCenter(string $value): void
    {
        $this->addOption('--footer-center', $value);
    }

    /**
     * Set footer font name
     *
     * @param string $value
     */
    public function addFooterFontName(string $value): void
    {
        $this->addOption('--footer-font-name', $value);
    }

    /**
     * Set footer font size
     *
     * @param int $value
     */
    public function addFooterFontSize(int $value): void
    {
        $this->addOption('--footer-font-size', $value);
    }

    /**
     * Adds a html footer
     *
     * @param string $url
     */
    public function addFooterHtml(string $url): void
    {
        $this->addOption('--footer-html', $url);
    }

    /**
     * Left aligned footer text
     *
     * @param string $text
     */
    public function addFooterLeft(string $text): void
    {
        $this->addOption('--footer-left', $text);
    }

    /**
     * Display line above the footer
     */
    public function addFooterLine(): void
    {
        $this->addOption('--footer-line');
    }

    /**
     * Do not display line above the footer
     */
    public function addNoFooterLine(): void
    {
        $this->addOption('--no-footer-line');
    }

    /**
     * Right aligned footer text
     *
     * @param string $text
     */
    public function addFooterRight(string $text): void
    {
        $this->addOption('--footer-right', $text);
    }

    /**
     * Spacing between footer and content in mm
     *
     * @param int $value
     */
    public function addFooterSpacing(int $value): void
    {
        $this->addOption('--footer-spacing', $value);
    }

    /**
     * Centered header text
     *
     * @param string $value
     */
    public function addHeaderCenter(string $value): void
    {
        $this->addOption('--header-center', $value);
    }

    /**
     * Set header font name
     *
     * @param string $value
     */
    public function addHeaderFontName(string $value): void
    {
        $this->addOption('--header-font-name', $value);
    }

    /**
     * Set header font size
     *
     * @param int $value
     */
    public function addHeaderFontSize(int $value): void
    {
        $this->addOption('--header-font-size', $value);
    }

    /**
     * Adds a html header
     *
     * @param string $value
     */
    public function addHeaderHtml(string $value): void
    {
        $this->addOption('--header-html', $value);
    }

    /**
     * Left aligned header text
     *
     * @param string $value
     */
    public function addHeaderLeft(string $value): void
    {
        $this->addOption('--header-left', $value);
    }

    /**
     * Display line below the header
     */
    public function addHeaderLine(): void
    {
        $this->addOption('--header-line');
    }

    /**
     * Do not display line below the header
     */
    public function addNoHeaderLine(): void
    {
        $this->addOption('--no-header-line');
    }

    /**
     * Right aligned header text
     *
     * @param string $value
     */
    public function addHeaderRight(string $value): void
    {
        $this->addOption('--header-right', $value);
    }

    /**
     * Spacing between header and content in mm
     *
     * @param int $value
     */
    public function addHeaderSpacing(int $value): void
    {
        $this->addOption('--header-spacing', $value);
    }

    /**
     * Replace [name] with value in header and footer (repeatable)
     *
     * @param string $name
     * @param string $value
     */
    public function addReplace(string $name, string $value): void
    {
        $this->addOption('--replace', $name, $value);
    }
}
