Non-blocking WkHTMLtoPDF
========================

[![CircleCI](https://circleci.com/gh/spacetab-io/wkhtmltopdf-php/tree/master.svg?style=svg)](https://circleci.com/gh/spacetab-io/wkhtmltopdf-php/tree/master)
[![codecov](https://codecov.io/gh/spacetab-io/wkhtmltopdf-php/branch/master/graph/badge.svg)](https://codecov.io/gh/spacetab-io/wkhtmltopdf-php)

Non-blocking PHP wrapper for `wkhtmltopdf` and `wkhtmltoimage` built with AMP.

## Installation

```bash
composer require spacetab-io/wkhtmltopdf
```

## Usage

```php
use Amp\Loop;
use Spacetab\WkHTML;

Loop::run(static fn() => 
  yield WkHTML\ToPDF::new()->fromHtml('<p>hello world</p>')->asFile('hi.pdf')
);
```

## Parallel sample

```php
use Amp\Loop;
use Spacetab\WkHTML;
use Spacetab\WkHTML\OptionBuilder;

Loop::run(static function () {
    $option = new OptionBuilder\PDF();
    $option->addGrayscale();

    $pdf = new WkHTML\ToPDF($option);

    $urls = [
        'https://google.com/?q=1' => 'g1',
        'https://google.com/?q=2' => 'g2',
        'https://google.com/?q=3' => 'g3',
    ];

    $promises = [];
    foreach ($urls as $url => $name) {
        $promises[] = $pdf->fromUrl($url)
            ->asFile(__DIR__ . "/google/{$name}.pdf");
    }

    yield $promises;
});
```

## Depends

* \>= PHP 7.4
* Composer for install package

## License

The MIT License

Copyright © 2020 spacetab.io, Inc. https://spacetab.io

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

