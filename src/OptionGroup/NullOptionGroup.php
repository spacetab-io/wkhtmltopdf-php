<?php

declare(strict_types=1);

namespace Spacetab\WkHTML\OptionGroup;

use Spacetab\WkHTML\OptionBuilder\AbstractOptionBuilder;
use Spacetab\WkHTML\OptionBuilder\OptionBuilderInterface;

final class NullOptionGroup implements OptionGroupInterface
{
    public function __invoke(): OptionBuilderInterface
    {
        return new class extends AbstractOptionBuilder {};
    }
}
