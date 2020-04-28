<?php

declare(strict_types=1);

namespace Spacetab\WkHTML\OptionBuilder;

final class Image extends AbstractOptionBuilder
{
    /**
     * Set height for cropping
     *
     * @param int $value
     */
    public function addCropH(int $value): void
    {
        $this->addOption('--crop-h', $value);
    }

    /**
     * Set width for cropping
     *
     * @param int $value
     */
    public function addCropW(int $value): void
    {
        $this->addOption('--crop-w', $value);
    }

    /**
     * Set x coordinate for cropping
     *
     * @param int $value
     */
    public function addCropX(int $value): void
    {
        $this->addOption('--crop-x', $value);
    }

    /**
     * Set y coordinate for cropping
     *
     * @param int $value
     */
    public function addCropY(int $value): void
    {
        $this->addOption('--crop-y', $value);
    }

    /**
     * Output file format
     *
     * @param string $value
     */
    public function addFormat(string $value): void
    {
        $this->addOption('--format', $value);
    }

    /**
     * Set screen height (default is calculated from page content)
     *
     * @param int $value
     */
    public function addHeight(int $value): void
    {
        $this->addOption('--height', $value);
    }

    /**
     * Output image quality (between 0 and 100)
     *
     * @param int $value
     */
    public function addQuality(int $value): void
    {
        $this->addOption('--quality', $value);
    }

    /**
     * Use the specified width even if it is not large enough for the content
     */
    public function addDisableSmartWidth(): void
    {
        $this->addOption('--disable-smart-width');
    }

    /**
     * Extend --width to fit unbreakable content
     */
    public function addEnableSmartWidth(): void
    {
        $this->addOption('--enable-smart-width');
    }

    /**
     * Make the background transparent in pngs
     */
    public function addTransparent(): void
    {
        $this->addOption('--transparent');
    }

    /**
     * Set screen width, note that this is used only as a guide line. Use --disable-smart-width to make it strict.
     *
     * @param int $value
     */
    public function addWidth(int $value): void
    {
        $this->addOption('--width', $value);
    }
}
