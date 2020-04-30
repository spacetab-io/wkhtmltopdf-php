<?php

declare(strict_types=1);

namespace Spacetab\Tests\WkHTML\Unit\OptionBuilder;

use Amp\PHPUnit\AsyncTestCase;
use Spacetab\WkHTML\OptionBuilder\AbstractOptionBuilder;

class AbstractOptionBuilderTest extends AsyncTestCase
{
    public function testCommonOptions()
    {
        $builder = new class extends AbstractOptionBuilder{};
        $builder->addEncoding('utf-8');
        $builder->addBypassProxyFor('proxy://');
        $builder->addCacheDir('/tmp');
        $builder->addCheckboxCheckedSvg('/tmp/file.svg');
        $builder->addCheckboxSvg('/tmp/file.svg');
        $builder->addCookie('key', 'value');
        $builder->addCookieJar('/tmp/cookie.jar');
        $builder->addCustomHeader('User-Agent', 'Amphp wkhtmltopdf');
        $builder->addCustomHeaderPropagation();
        $builder->addNoCustomHeaderPropagation();
        $builder->addImages();
        $builder->addNoImages();
        $builder->addDisableJavascript();
        $builder->addEnableJavascript();
        $builder->addJavascriptDelay(1200);
        $builder->addLoadErrorHandling('ignore');
        $builder->addLoadMediaErrorHandling('ignore');
        $builder->addPassword('pwned password');
        $builder->addPost('key', 'value');
        $builder->addPostFile('name', '/tmp/file.txt');
        $builder->addProxy('proxy');
        $builder->addProxyHostnameLookup();
        $builder->addRadiobuttonCheckedSvg('/tmp/file.svg');
        $builder->addRadiobuttonSvg('/tmp/file.svg');
        $builder->addRunScript('console.log(\'hi\');');
        $builder->addSslCrtPath('/tmp/ssl.crt');
        $builder->addSslKeyPath('/tmp/ssl.key');
        $builder->addSslKeyPassword('pwned password');
        $builder->addStopSlowScripts();
        $builder->addNoStopSlowScripts();
        $builder->addUsername('user');
        $builder->addWindowStatus('ready');
        $builder->addZoom(130);
        $builder->addUseXServer('x');
        $builder->addUserStyleSheet('https://google.com/main.css');

        $array = [
            '--encoding' => 'utf-8',
            '--bypass-proxy-for' => 'proxy://',
            '--cache-dir' => '/tmp',
            '--checkbox-checked-svg' => '/tmp/file.svg',
            '--checkbox-svg' => '/tmp/file.svg',
            '--cookie' => 'key value',
            '--cookie-jar' => '/tmp/cookie.jar',
            '--custom-header' => 'User-Agent Amphp wkhtmltopdf',
            '--custom-header-propagation' => true,
            '--no-custom-header-propagation' => true,
            '--images' => true,
            '--no-images' => true,
            '--disable-javascript' => true,
            '--enable-javascript' => true,
            '--javascript-delay' => '1200',
            '--load-error-handling' => 'ignore',
            '--load-media-error-handling' => 'ignore',
            '--password' => 'pwned password',
            '--post' => 'key value',
            '--post-file' => 'name /tmp/file.txt',
            '--proxy' => 'proxy',
            '--proxy-hostname-lookup' => true,
            '--radiobutton-checked-svg' => '/tmp/file.svg',
            '--radiobutton-svg' => '/tmp/file.svg',
            '--run-script' => 'console.log(\'hi\');',
            '--ssl-crt-path' => '/tmp/ssl.crt',
            '--ssl-key-path' => '/tmp/ssl.key',
            '--ssl-key-password' => 'pwned password',
            '--stop-slow-scripts' => true,
            '--no-stop-slow-scripts' => true,
            '--username' => 'user',
            '--window-status' => 'ready',
            '--zoom' => '130',
            '--use-xserver' => true,
            '--user-style-sheet' => 'https://google.com/main.css',
        ];

        $this->assertSame($array, $builder->getOptions());
    }
}
