<?php

declare(strict_types=1);

namespace Spacetab\WkHTML\OptionBuilder;

abstract class AbstractOptionBuilder implements OptionBuilderInterface
{
    protected array $options = [];

    public function addOption(string $key, ...$value): void
    {
        $this->options[$key] = $value ? join(' ', $value) : true;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Bypass proxy for host (repeatable)
     *
     * @param string $value
     */
    public function addBypassProxyFor(string $value): void
    {
        $this->addOption('--bypass-proxy-for', $value);
    }

    /**
     * Web cache directory
     *
     * @param string $dir
     */
    public function addCacheDir(string $dir): void
    {
        $this->addOption('--cache-dir', $dir);
    }

    /**
     * Use this SVG file when rendering checked checkboxes
     *
     * @param string $path
     */
    public function addCheckboxCheckedSvg(string $path): void
    {
        $this->addOption('--checkbox-checked-svg', $path);
    }


    /**
     * Use this SVG file when rendering unchecked checkboxes
     *
     * @param string $path
     */
    public function addCheckboxSvg(string $path): void
    {
        $this->addOption('--checkbox-svg', $path);
    }

    /**
     * Set an additional cookie (repeatable), value should be url encoded.
     *
     * @param string $name
     * @param string $value
     */
    public function addCookie(string $name, string $value): void
    {
        $this->addOption('--cookie', $name, $value);
    }

    /**
     * Read and write cookies from and to the supplied cookie jar file
     *
     * @param string $path
     */
    public function addCookieJar(string $path): void
    {
        $this->addOption('--cookie-jar', $path);
    }

    /**
     * Set an additional HTTP header (repeatable)
     *
     * @param string $name
     * @param string $value
     */
    public function addCustomHeader(string $name, string $value): void
    {
        $this->addOption('--custom-header', $name, $value);
    }

    /**
     * Add HTTP headers specified by --custom-header for each resource request.
     */
    public function addCustomHeaderPropagation(): void
    {
        $this->addOption('--custom-header-propagation');
    }

    /**
     * Do not add HTTP headers specified by --custom-header for each resource request.
     */
    public function addNoCustomHeaderPropagation(): void
    {
        $this->addOption('--no-custom-header-propagation');
    }

    /**
     * Set the default text encoding, for input
     *
     * @param string $value
     */
    public function addEncoding(string $value): void
    {
        $this->addOption('--encoding', $value);
    }

    /**
     * Do load or print images
     */
    public function addImages(): void
    {
        $this->addOption('--images');
    }

    /**
     * Do not load or print images
     */
    public function addNoImages(): void
    {
        $this->addOption('--no-images');
    }

    /**
     * Do not allow web pages to run javascript
     */
    public function addDisableJavascript(): void
    {
        $this->addOption('--disable-javascript');
    }

    /**
     * Do allow web pages to run javascript
     */
    public function addEnableJavascript(): void
    {
        $this->addOption('--enable-javascript');
    }

    /**
     * Wait some milliseconds for javascript finish
     *
     * @param int $value
     */
    public function addJavascriptDelay(int $value): void
    {
        $this->addOption('--javascript-delay', $value);
    }


    /**
     * Specify how to handle pages that fail to load: abort, ignore or skip
     *
     * @param string $value
     */
    public function addLoadErrorHandling(string $value): void
    {
        $this->addOption('--load-error-handling', $value);
    }

    /**
     * Specify how to handle media files that fail to load: abort, ignore or skip
     *
     * @param string $value
     */
    public function addLoadMediaErrorHandling(string $value): void
    {
        $this->addOption('--load-media-error-handling', $value);
    }

    /**
     * HTTP Authentication password
     *
     * @param string $value
     */
    public function addPassword(string $value): void
    {
        $this->addOption('--password', $value);
    }

    /**
     * Add a additional post field (repeatable)
     *
     * @param string $name
     * @param string $value
     */
    public function addPost(string $name, string $value): void
    {
        $this->addOption('--post', $name, $value);
    }

    /**
     * Post an additional file (repeatable)
     *
     * @param string $name
     * @param string $path
     */
    public function addPostFile(string $name, string $path): void
    {
        $this->addOption('--post-file', $name, $path);
    }

    /**
     * Use a proxy
     *
     * @param string $value
     */
    public function addProxy(string $value): void
    {
        $this->addOption('--proxy', $value);
    }

    /**
     * Use the proxy for resolving hostnames
     */
    public function addProxyHostnameLookup(): void
    {
        $this->addOption('--proxy-hostname-lookup');
    }


    /**
     * Use this SVG file when rendering checked radiobuttons
     *
     * @param string $path
     */
    public function addRadiobuttonCheckedSvg(string $path): void
    {
        $this->addOption('--radiobutton-checked-svg', $path);
    }

    /**
     * Use this SVG file when rendering unchecked radiobuttons
     *
     * @param string $path
     */
    public function addRadiobuttonSvg(string $path): void
    {
        $this->addOption('--radiobutton-svg', $path);
    }

    /**
     * Run this additional javascript after the page is done loading (repeatable)
     *
     * @param string $js
     */
    public function addRunScript(string $js): void
    {
        $this->addOption('--run-script', $js);
    }


    /**
     * Path to the ssl client cert public key in OpenSSL PEM format, optionally followed by intermediate ca and trusted certs
     *
     * @param string $path
     */
    public function addSslCrtPath(string $path): void
    {
        $this->addOption('--ssl-crt-path', $path);
    }

    /**
     * Password to ssl client cert private key
     *
     * @param string $password
     */
    public function addSslKeyPassword(string $password): void
    {
        $this->addOption('--ssl-key-password', $password);
    }

    /**
     * Path to ssl client cert private key in OpenSSL PEM format
     *
     * @param string $path
     */
    public function addSslKeyPath(string $path): void
    {
        $this->addOption('--ssl-key-path', $path);
    }

    /**
     * Stop slow running javascripts
     */
    public function addStopSlowScripts(): void
    {
        $this->addOption('--stop-slow-scripts');
    }

    /**
     * Do not Stop slow running javascripts
     */
    public function addNoStopSlowScripts(): void
    {
        $this->addOption('--no-stop-slow-scripts');
    }

    /**
     * HTTP Authentication username
     *
     * @param string $value
     */
    public function addUsername(string $value): void
    {
        $this->addOption('--username', $value);
    }

    /**
     * Wait until window.status is equal to this string before rendering page
     *
     * @param string $value
     */
    public function addWindowStatus(string $value): void
    {
        $this->addOption('--window-status', $value);
    }

    /**
     * Use this zoom factor
     *
     * @param float $value
     */
    public function addZoom(float $value): void
    {
        $this->addOption('--zoom', $value);
    }

    /**
     * Use the X server (some plugins and other stuff might not work without X11)
     *
     * @param string $value
     */
    public function addUseXServer(string $value): void
    {
        $this->addOption('--use-xserver');
    }

    /**
     * Do not link from section header to toc
     *
     * @param string $url
     */
    public function addUserStyleSheet(string $url): void
    {
        $this->addOption('--user-style-sheet', $url);
    }
}
