<?php

declare(strict_types=1);

namespace Spacetab\WkHTML;

use Amp\Loop;
use Amp\Process\Process;
use Amp\Promise;
use Amp\ByteStream;
use Error;
use Generator;
use InvalidArgumentException;
use League\Uri\Contracts\UriInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use Spacetab\WkHTML\OptionBuilder\OptionBuilderInterface;
use function Amp\call;
use Amp\File;

final class Runner implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private const TMP_FILE_PREFIX = 'spacetab-io-wkhtmltopdf-tmp-';

    /** @var UriInterface|string */
    private $htmlOrUrl;

    /** @var array<string, string> */
    private array $environment;

    private string $binaryPath;
    private OptionBuilderInterface $optionBuilder;

    /** @var array<string> */
    private array $usedTemporaryPaths = [];

    /**
     * Runner constructor.
     *
     * @param \Psr\Http\Message\UriInterface|string $htmlOrUrl
     * @param string $binaryPath
     * @param \Spacetab\WkHTML\OptionBuilder\OptionBuilderInterface $optionBuilder
     * @param array<string, string> $environment
     */
    public function __construct(
        $htmlOrUrl,
        string $binaryPath,
        OptionBuilderInterface $optionBuilder,
        array $environment = []
    ) {
        $this->htmlOrUrl     = $htmlOrUrl;
        $this->binaryPath    = $binaryPath;
        $this->optionBuilder = $optionBuilder;
        $this->environment   = $environment;

        $this->setLogger(new NullLogger());
    }

    /**
     * Saves file with $filename to disk.
     *
     * @param string $path
     * @return Promise<void>
     */
    public function asFile(string $path): Promise
    {
        // @phpstan-ignore-next-line
        return call(fn() =>
            // @phpstan-ignore-next-line
            yield from $this->runCommand($path, strlen($path) < 1 ? null : yield from $this->writeTemporaryFile())
        );
    }

    /**
     * Reads stream to string and returns.
     *
     * @return Promise<string>
     */
    public function asString(): Promise
    {
        // @phpstan-ignore-next-line
        return call(fn() => yield from $this->runCommand(
            // @phpstan-ignore-next-line
            null, yield from $this->writeTemporaryFile()
        ));
    }

    /**
     * Runs command and handle the error if happened.
     *
     * @param string|null $path
     * @param string|null $temporary
     * @return Generator<Promise>
     */
    private function runCommand(?string $path = null, ?string $temporary = null): Generator
    {
        $this->logger->info("Run command: {$this->getCommandToCreateSomething($path, $temporary)}", [
            'Environment' => $this->environment
        ]);

        $process = new Process($this->getCommandToCreateSomething($path, $temporary), null, $this->environment);
        yield $process->start();

        $stdout = yield ByteStream\buffer($process->getStdout());
        $stderr = yield ByteStream\buffer($process->getStderr());
        $code   = yield $process->join();

        $this->defineCleaner();

        if ($code !== 0) {
            throw new Error($stderr, $code);
        }

        return $stdout;
    }

    private function getTrustedOptions(): string
    {
        $options = '';
        foreach ($this->optionBuilder->getOptions() as $option => $value) {
            $option = escapeshellarg($option);
            if (true === $value) {
                $options .= " {$option}";
            } else {
                $value = escapeshellarg($value);
                $options .= " {$option} {$value}";
            }
        }

        return $options;
    }

    private function getTrustedBinary(): string
    {
        return escapeshellarg($this->binaryPath);
    }

    private function getTrustedHtmlOrUrl(): string
    {
        if ($this->htmlOrUrl instanceof UriInterface) {
            return escapeshellarg(
                (string) $this->htmlOrUrl
            );
        }

        return $this->htmlOrUrl;
    }

    private function getCommandToCreateSomething(?string $path = null, ?string $temporary = null): string
    {
        $temporary = is_null($temporary) ? '' : escapeshellarg($temporary);
        $command   = "{$this->getTrustedBinary()} {$this->getTrustedOptions()} {$temporary}";

        if ($this->htmlOrUrl instanceof UriInterface) {
            $command = "{$this->getTrustedBinary()} {$this->getTrustedOptions()} {$this->getTrustedHtmlOrUrl()}";
        }

        if (is_null($path)) {
            return "{$command} -";
        }

        $path = pathinfo($path);

        if (!array_key_exists('extension', $path)) {
            throw new InvalidArgumentException('Extension will require to saving file.');
        }

        $filename = "{$path['dirname']}/{$path['basename']}";
        $this->logger->info("Save file: {$filename} to disk");

        return "mkdir -p {$path['dirname']} && {$command} {$filename}";
    }

    private function defineCleaner(): void
    {
        Loop::defer(function () {
            $promises = [];
            foreach ($this->usedTemporaryPaths as $path) {
                $promises[] = File\unlink($path);
            }

            yield $promises;

            $this->usedTemporaryPaths = [];
        });
    }

    private function getTemporaryPath(): string
    {
        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid(self::TMP_FILE_PREFIX) . '.html';

        $this->usedTemporaryPaths[] = $path;

        return $path;
    }

    /**
     * Writes a temporary file.
     *
     * @return Generator<string|mixed>
     */
    private function writeTemporaryFile(): Generator
    {
        $path = $this->getTemporaryPath();

        /** @var File\Handle $file */
        $file = yield File\open($path, 'c');
        yield $file->write($this->getTrustedHtmlOrUrl());
        yield $file->close();

        return $path;
    }
}
