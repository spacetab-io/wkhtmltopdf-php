<?php

declare(strict_types=1);

namespace Spacetab\Tests\WkHTML\Integration;

use Amp\PHPUnit\AsyncTestCase;
use Amp\Promise;
use Amp\File;
use Amp\ByteStream;
use League\Uri\Uri;
use Psr\Log\LoggerInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Spacetab\WkHTML;
use Spacetab\WkHTML\OptionGroup\DefaultOptionGroup;
use function Amp\call;

class ComplexTest extends AsyncTestCase
{
    private const TRASH_DIR = __DIR__ . '/../Trash';

    public function testHowItMakesPdfFromHtml()
    {
        $path = self::TRASH_DIR . '/hi.pdf';

        $runner = WkHTML\ToPDF::new()->fromHtml('<p>hello world</p>');
        yield $runner->asFile($path);

        $this->assert(
            yield $this->getFileContents($path),
            yield $runner->asString()
        );
    }

    public function testHowItMakesPdfFromUrl()
    {
        $path = self::TRASH_DIR . '/google.pdf';
        $runner = WkHTML\ToPDF::new()->fromUrl('https://google.com');

        yield $runner->asFile($path);

        $this->assert(
            yield $this->getFileContents($path),
            yield $runner->asString()
        );
    }

    public function testHowItMakesImageFromHtml()
    {
        $path = self::TRASH_DIR . '/hi.jpg';
        $runner = WkHTML\ToImage::new()->fromHtml('<p>hello world</p>');

        yield $runner->asFile($path);

        $this->assert(
            yield $this->getFileContents($path),
            yield $runner->asString()
        );
    }

    public function testHowItMakesImageFromUrl()
    {
        $path = self::TRASH_DIR . '/google.jpg';
        $runner = WkHTML\ToImage::new()->fromUrl(Uri::createFromString('https://google.com'));

        yield $runner->asFile($path);

        $this->assert(
            yield $this->getFileContents($path),
            yield $runner->asString()
        );
    }

    public function testHowToLoggerWorks()
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger
            ->expects($this->at(2))
            ->method('info')
            ->withConsecutive(
                [
                    $this->matchesRegularExpression('/Save file\: .*/'),
                    $this->isType('array')
                ],
                [
                    $this->matchesRegularExpression('/Run command\: .*/'),
                    $this->isType('array')
                ],
            );

        $path = self::TRASH_DIR . '/google-log.pdf';
        $pdf = new WkHTML\ToPDF(new DefaultOptionGroup(), $logger);
        $runner = $pdf->fromUrl('https://google.com');
        yield $runner->asFile($path);
    }

    public function testWhenCommandExecutingIsFail()
    {
        $this->expectException(\Error::class);

        $pdf = new WkHTML\ToPDF();
        $runner = $pdf->fromUrl('https://asdkja0sdja0djas0djas09dja0jda09sjdasjda0s9jdas0d9jasd09jas0d9j.com');
        yield $runner->asString();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        Promise\wait(self::cleanup());
    }

    private function assert($contents, $string)
    {
        $this->assertNotEmpty($contents);
        $this->assertNotEmpty($string);

        $this->assertTrue(strlen($contents) > 100);
        $this->assertTrue(strlen($string) > 100);
    }

    private static function cleanup()
    {
        return call(static function () {
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(self::TRASH_DIR));

            $promises = [];
            foreach ($iterator as $file) {
                /** @var \SplFileInfo $file */
                if ($file->isDir() || substr($file->getFilename(), 0, 1) === '.'){
                    continue;
                }

                $promises[] = File\unlink($file->getPathname());
            }

            yield $promises;
        });
    }

    private function getFileContents(string $path): Promise
    {
        return call(static function () use ($path) {
            /** @var File\Handle $file */
            $file = yield File\open($path, 'r');
            $buffer = yield ByteStream\buffer($file);
            yield $file->close();

            return $buffer;
        });
    }
}
