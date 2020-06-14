Non-blocking WkHTMLtoPDF
========================

[![CircleCI](https://circleci.com/gh/spacetab-io/wkhtmltopdf-php/tree/master.svg?style=svg)](https://circleci.com/gh/spacetab-io/wkhtmltopdf-php/tree/master)
[![codecov](https://codecov.io/gh/spacetab-io/wkhtmltopdf-php/branch/master/graph/badge.svg)](https://codecov.io/gh/spacetab-io/wkhtmltopdf-php)

Non-blocking PHP wrapper for `wkhtmltopdf` and `wkhtmltoimage` built with [AMP](https://amphp.org).

## Table of contents

* [Features](#features)
* [Why?](#why)
* [Installation](#installation)
* Usage
    + [On your machine](#on-your-machine)
        - [Simple cases](#simple-cases)
        - [Parallel](#parallel)
        - [Option Groups](#option-groups)
    + [Docker](#docker)
* [License](#license)

## Features

* An elegant interface to usage
* Create PDF files from HTML or URI strings
* Create Image files from HTML or URI string
* Faster than others because can be run in parallel (native)
* In-the-box your can use `OptionGroup` feature to group options for different cases  

## Why

Existing wrappers are slow, uses blocking API and does not have a normal object-oriented interface (for options).

It prevents to write fast and more elegant programming code. 

## Installation

```bash
composer require spacetab-io/wkhtmltopdf
```

## Usage

### On your machine
#### Simple cases

1. Create a PDF file from HTML string and save it to current directory:

```php
use Amp\Loop;
use Spacetab\WkHTML;

Loop::run(static fn() => 
  yield WkHTML\ToPDF::new()->fromHtml('<p>hello world</p>')->asFile('hi.pdf')
);
```

2. Create a PDF file from URI and save it to current directory:

```php
use Amp\Loop;
use Spacetab\WkHTML;

Loop::run(static fn() => 
  yield WkHTML\ToPDF::new()->fromUrl('https://google.com')->asFile('google.pdf')
);
```

3. Create a PDF file with custom options:

```php
use Amp\Loop;
use Spacetab\WkHTML;
use Spacetab\WkHTML\OptionBuilder;

Loop::run(static function () {
  $option = new OptionBuilder\PDF();
  $option->addGrayscale();

  yield WkHTML\ToPDF::new()->fromUrl('https://google.com')->asFile('google.pdf');
});
```

Note: By default uses `UTF-8` encoding.

#### Parallel

It simple! Right?

```php
Loop::run(static fn() =>
    yield [
        WkHTML\ToPDF::new()->fromHtml('<p>hi1</p>')->asFile('hi1.pdf'),
        WkHTML\ToPDF::new()->fromHtml('<p>hi2</p>')->asFile('hi2.pdf'),
        WkHTML\ToPDF::new()->fromHtml('<p>hi3</p>')->asFile('hi3.pdf'),
    ]
);
```

#### Option Groups

So, if you work with many reports or create PDF files with set of different options 
you can be attempt to use option groups. Sample:

```php
use Amp\Loop;
use Spacetab\WkHTML;
use Spacetab\WkHTML\OptionBuilder;
use Spacetab\WkHTML\OptionBuilder\OptionBuilderInterface;
use Spacetab\WkHTML\OptionGroup\OptionGroupInterface;

Loop::run(static function () {
    $pdf = new WkHTML\ToPDF(new class implements OptionGroupInterface {
        public function __invoke(): OptionBuilderInterface {
            $option = new OptionBuilder\PDF();
            $option->addGrayscale();

            return $option;
        }
    });

    yield $pdf->fromUrl('https://google.com')->asFile('google.pdf');
});
```   

### Docker

For usage in Docker your can like to use this image:
https://github.com/spacetab-io/docker-amphp-php

```Dockerfile
FROM spacetabio/amphp-alpine:7.4-wkhtmltopdf-1.1.0

COPY * /app

# cli commands should be created in the responsible service. 
CMD ["bin/service", "run"]
```

This library tested in Docker container above in Circle CI.

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

