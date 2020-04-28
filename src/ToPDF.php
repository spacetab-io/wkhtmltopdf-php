<?php

declare(strict_types=1);

namespace Spacetab\WkHTML;

use Spacetab\WkHTML\Format\AbstractFormat;

final class ToPDF extends AbstractFormat
{
    protected string $binaryPath = '/usr/local/bin/wkhtmltopdf';
}
