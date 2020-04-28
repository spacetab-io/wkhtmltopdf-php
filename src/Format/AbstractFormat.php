<?php

declare(strict_types=1);

namespace Spacetab\WkHTML\Format;

use Closure;
use InvalidArgumentException;
use League\Uri\Contracts\UriInterface;
use League\Uri\Uri;
use Psr\Log\LoggerInterface;
use Spacetab\WkHTML\OptionBuilder\OptionBuilderInterface;
use Spacetab\WkHTML\OptionGroup\OptionGroupInterface;
use Spacetab\WkHTML\OptionGroup\DefaultOptionGroup;
use Spacetab\WkHTML\Runner;

abstract class AbstractFormat
{
    protected OptionBuilderInterface $optionBuilder;
    protected ?LoggerInterface $logger;

    protected string $binaryPath;
    protected array $environment = [];

    /**
     * AbstractFormat constructor.
     *
     * @param OptionBuilderInterface|OptionGroupInterface $options
     * @param \Psr\Log\LoggerInterface|null $logger
     */
    public function __construct($options, ?LoggerInterface $logger = null)
    {
        $this->optionBuilder = $this->resolveOptions($options);
        $this->logger        = $logger;
    }

    public static function new(): self
    {
        return new static(new DefaultOptionGroup());
    }

    /**
     * Generates pdf or image from HTML.
     *
     * @param string $html
     * @return \Spacetab\WkHTML\Runner
     */
    public function fromHtml(string $html): Runner
    {
        return $this->createRunner($html);
    }

    /**
     * Generates pdf or image from URL.
     *
     * @param $url
     * @return \Spacetab\WkHTML\Runner
     */
    public function fromUrl($url): Runner
    {
        if ($url instanceof UriInterface) {
            return $this->createRunner($url);
        }

        return $this->createRunner(
            Uri::createFromString($url)
        );
    }

    public function addEnvironment(string $variable, string $value): void
    {
        $this->environment[$variable] = $value;
    }

    public function setBinaryPath(string $path): void
    {
        $this->binaryPath = $path;
    }

    private function createRunner($htmlOrUrl): Runner
    {
        $runner = new Runner($htmlOrUrl, $this->binaryPath, $this->optionBuilder, $this->environment);

        if ($this->logger) {
            $runner->setLogger($this->logger);
        }

        return $runner;
    }

    private function resolveOptions($options): OptionBuilderInterface
    {
        if ($options instanceof OptionBuilderInterface) {
            return $options;
        }

        if ($options instanceof Closure || $options instanceof OptionGroupInterface) {
            $value = $options();

            if ($value instanceof OptionBuilderInterface) {
                return $value;
            }
        }

        throw new InvalidArgumentException(
            'Options must be as Closure or instanceof `OptionGroupInterface` or `OptionBuilderInterface`.'
        );
    }
}
