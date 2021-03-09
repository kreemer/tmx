# Using TMX


- [Installation](#installation)
- [Core Concepts](#core-concepts)
- [Parsing](#parsing)
- [Printing](#printing)
- [Saving](#saving)
- [API](#api)

# Installation

TMX is available on Packagist ([kreemer/tmx](http://packagist.org/packages/kreemer/tmx))
and as such installable via [Composer](http://getcomposer.org/).

```bash
composer require kreemer/tmx
```

# Core Concepts

The library consist of three services:

* Parser, which parses a tmx file into an object graph
* Writer, which writes the graph into a tmx file
* Printer, which prints the graph of objects to an image file

You can also build up the object graph yourself, which can be exported to an actual tmx file afterwards. 

Only [version 1.4](https://doc.mapeditor.org/en/stable/reference/tmx-map-format/) of the tmx format is supported. 

# Parsing


```php
<?php

use Tmx\Service\Parser;

$parser = new Parser();
$map = $parser->parse('filename.tmx');
```

The `$map` object contains about the parsed data. You can browse the api [here](api/classes/Tmx-Map.html).

# Creating maps manually

You can create the `$map` object also manually. Following is the simplest working example:


```php
<?php

use Tmx\Map;
use Tmx\Image;
use Tmx\TileSet;
use Tmx\Layer;
use Tmx\LayerData;


$map = new Map();
$map->setHeight(1);
$map->setWidth(2);
$map->setTileWidth(32);
$map->setTileHeight(32);

$image = new Image();
$image->setWidth(32);
$image->setHeight(32);
$image->setSource(__DIR__ . '_tileSet' . DIRECTORY_SEPARATOR . 'door_32x32.png');

$tileSet = new TileSet();
$tileSet->setImage($image);
$tileSet->setColumns(1);
$tileSet->setTileWidth(32);
$tileSet->setTileHeight(32);
$tileSet->setFirstGid(1);

$layerData = new LayerData();
$layerData->setData('1,0');
$layerData->setEncoding('csv');

$layer = new Layer();
$layer->setHeight(1);
$layer->setWidth(2);
$layer->setLayerData($layerData);

$map->addTileSet($tileSet);
$map->addLayer($layer);
```

# Printing

The library provides the ability to transform the created map object into an image.

```php
use Tmx\Service\Printer;
use Tmx\Map;

$map = new Map();
// create map manually or parse existing file

$printer = new Printer();
$printer->print($map, 'filename.png');

// you can also get the image object
$image = $printer->render($map);
```

The library uses the [intervention image](http://image.intervention.io) library. The method `render()` will result the generated image object.

# Saving

The generated or parsed `$map` object can be saved with the writer service:

```php
use Tmx\Service\Writer;
use Tmx\Map;

$map = new Map();
// create map manually or parse existing file

$printer = new Writer();
$printer->write($map, 'filename.tmx');
```

The generated file will include the map and the embedded tileset. 

# API

You can view the API documentation [here](api/index.html)