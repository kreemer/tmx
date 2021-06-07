# Using TMX


- [Installation](#installation)
- [Core Concepts](#core-concepts)
- [Parsing](#parsing)
  - [Parsing data of a layer](#parsing-data-of-a-layer)
  - [Find all layers](#find-all-layers)
- [Creating maps manually](#creating-maps-manually)
  - [Tiles inside TileSets](#tiles-inside-tilesets)
  - [Tile management](#tile-management)
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

Currently, only [version 1.4](https://doc.mapeditor.org/en/stable/reference/tmx-map-format/) of the tmx format is fully supported, while the newer version (1.5) should also work as well.  

# Parsing


```php
<?php

use Tmx\Service\Parser;

$parser = new Parser();
$map = $parser->parse('filename.tmx');
```

The `$map` object contains about the parsed data. You can browse the api [here](api/classes/Tmx-Map.html).

## Parsing data of a layer

If you wan't to parse the data of a layer, you will soon find out that this library just saves the raw data in the `LayerData` object. Because of the different encodings and compressions, which can be used, this library provides a  `LayerDataReader` service class to read this data and returns them as 2 dimensional array:


```php
<?php

use Tmx\Service\Parser;
use Tmx\Service\LayerDataReader;

$layerDataReader = LayerDataReader::getDefaultLayerDataReader();

$parser = new Parser();
$map = $parser->parse('filename.tmx');

foreach ($map->getLayers() as $layer) {
    $tiles = $layerDataReader->readLayerData($layer->getLayerData());
    
    // process tiles array
    // $tiles = [
    //   [ 
    //     0, 0, 0, 1, 2, 3, ...
    //   ],
    //   [ 
    //     0, 0, 0, 1, 2, 3, ...
    //   ],
    //   ...
    // ]
}
```

In the previous example, the tiles array contains all tile ids, which this layer contains.


## Find all layers

In the previous chapter we looped through all layers of a map. But the map object is not the only object which can contain layers. Also group layers can contain layers (but also nested group layers). To get all layers from all maps and groups, you can use the map service class:


```php
<?php

use Tmx\Service\Parser;
use Tmx\Service\MapService;

$parser = new Parser();
$map = $parser->parse('filename.tmx');

$layers = MapService::findLayers($map);

foreach ($layers as $layer) {
  // loop through every layer
}
```


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

## Tiles inside TileSets

You can manually define tiles with additional properties inside the `TileSet` object. While not necessary, it will help you if you want to later draw the map.

```php
<?php

use Tmx\Tile;
use Tmx\TileSet;


$tileSet = new TileSet();
$tile = new Tile();
$tile->setId(123);
// Creating type or set animation frames
```


## Tile management

If you manage the `TileSet` manually, there is a service class to help you to find `Tile` objects inside the `TileSet` object. It works by adding a `StringProperty` to a tile, which can later be identified:

```php
<?php
use Tmx\TileSet;
use Tmx\Tile;
use Tmx\PropertyBag;
use Tmx\Property\StringProperty;
use Tmx\Service\TileFinder;

$tileSet = new TileSet();
$tile = new Tile();
$propertyBag = new PropertyBag();
$property = new StringProperty();
$property->setName('identifier');
$property->setValue('grasTile');
$tile->setPropertyBag($propertyBag);
$tileSet->addTile($tile);

$tiles = TileFinder::findTileByProperty($tileSet, ['identifier' => 'grasTile']);

// tiles is an array which contains all tiles with
// a string property with the name 'identifier'
// and value 'grasTile'
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
