# TMX [![Continuous Integration](https://github.com/kreemer/tmx/actions/workflows/continuous-integration.yaml/badge.svg?branch=main)]


[![Total Downloads](https://img.shields.io/packagist/dt/kreemer/tmx.svg)](https://packagist.org/packages/kreemer/tmx)
[![Latest Stable Version](https://img.shields.io/packagist/v/kreemer/tmx.svg)](https://packagist.org/packages/kreemer/tmx)

TMX is a library for creating, parsing and editing tmx files. The main purpose is to parse a tmx file and save the parsed file as image file.

The tmx format is used by the program [Tiled](https://www.mapeditor.org). The format is explained [here](https://doc.mapeditor.org/en/stable/reference/tmx-map-format/).

## Installation

Install the latest version with

```bash
$ composer require kreemer/tmx
```

## Basic Usage

```php
<?php

use Tmx\Parser;
use Tmx\Printer;

$parser = new Parser();
$map = $parser->parse('filename.tmx');

echo $map->getWidth(); // get width of map
echo $map->getHeight(); // get height of map

$printer = new Printer();
$printer->print($map, 'output.png'); // save map to output.png
```

## Documentation

Under development

## About

### Requirements

- Tmx works with PHP 7.4 or above.
- You have to install the imagick extension, gd support is currently under development


### Submitting bugs and feature requests

Bugs and feature request are tracked on [GitHub](https://github.com/kreemer/tmx/issues)

### License

Tmx is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

