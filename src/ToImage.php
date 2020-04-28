<?php

declare(strict_types=1);

namespace Spacetab\WkHTML;

use Spacetab\WkHTML\Format\AbstractFormat;

final class ToImage extends AbstractFormat
{
    protected string $binaryPath = '/usr/local/bin/wkhtmltoimage';
}
