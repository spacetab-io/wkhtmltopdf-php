<?php

declare(strict_types=1);

namespace Spacetab\WkHTML\OptionGroup;

use Spacetab\WkHTML\OptionBuilder\OptionBuilderInterface;
use Spacetab\WkHTML\OptionBuilder;

final class DefaultOptionGroup implements OptionGroupInterface
{
    public function __invoke(): OptionBuilderInterface
    {
        $builder = new class extends OptionBuilder\AbstractOptionBuilder {};
        $builder->addEncoding('UTF-8');

        return $builder;
    }
}
