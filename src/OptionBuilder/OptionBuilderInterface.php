<?php

declare(strict_types=1);

namespace Spacetab\WkHTML\OptionBuilder;

interface OptionBuilderInterface
{
    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array;
}
