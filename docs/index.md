# Using TMX


- [Installation](#installation)
- [Core Concepts](#core-concepts)


## Installation

TMX is available on Packagist ([kreemer/tmx](http://packagist.org/packages/kreemer/tmx))
and as such installable via [Composer](http://getcomposer.org/).

```bash
composer require kreemer/tmx
```

## Core Concepts

The library consist of three services:

* Parser, which parses a tmx file into an object graph
* Writer, which writes the graph into a tmx file
* Printer, which prints the graph of objects to an image file

You can also build up the object graph yourself, which can be exported to an actual tmx file afterwards. 

Only [version 1.4](https://doc.mapeditor.org/en/stable/reference/tmx-map-format/) of the tmx format is supported. 

## Parsing


[Creating maps programmatically](manual.md) &rarr;