<?php

declare(strict_types=1);

namespace Spacetab\WkHTML;

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

final class Runner implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private const MASKED_OUTPUT = '\'[MASKED HTML]\'';

    /**
     * @var UriInterface|string
     */
    private $htmlOrUrl;

    /**
     * @var array<string, string>
     */
    private array $environment;

    private string $binaryPath;
    private OptionBuilderInterface $optionBuilder;

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
        return call(fn() => yield from $this->runCommand($path));
    }

    /**
     * Reads stream to string and returns.
     *
     * @return Promise<string>
     */
    public function asString(): Promise
    {
        // @phpstan-ignore-next-line
        return call(fn() => yield from $this->runCommand());
    }

    /**
     * Runs command and handle the error if happened.
     *
     * @param string|null $path
     * @return Generator<Promise>
     */
    private function runCommand(?string $path = null): Generator
    {
        $masquerade = $this->htmlOrUrl instanceof UriInterface;

        $this->logger->info("Run command: {$this->getCommandToCreateSomething($path, !$masquerade)}", [
            'Environment' => $this->environment
        ]);

        $process = new Process($this->getCommandToCreateSomething($path), null, $this->environment);
        yield $process->start();

        $stdout = yield ByteStream\buffer($process->getStdout());
        $stderr = yield ByteStream\buffer($process->getStderr());
        $code   = yield $process->join();

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

    private function getTrustedHtmlOrUrl(bool $masquerade = false): string
    {
        if ($masquerade) {
            return self::MASKED_OUTPUT;
        }

        return escapeshellarg(
            (string) $this->htmlOrUrl
        );
    }

    private function getCommandToCreateSomething(?string $path = null, bool $masquerade = false): string
    {
        $command = "echo {$this->getTrustedHtmlOrUrl($masquerade)} | {$this->getTrustedBinary()} {$this->getTrustedOptions()} -";

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
}
