<?php

declare(strict_types=1);

namespace Spacetab\WkHTML\OptionGroup;

use Spacetab\WkHTML\OptionBuilder\OptionBuilderInterface;

interface OptionGroupInterface
{
    public function __invoke(): OptionBuilderInterface;
}
