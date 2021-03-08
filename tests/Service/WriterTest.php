<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Service;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Tmx\Image;
use Tmx\Layer;
use Tmx\LayerData;
use Tmx\Map;
use Tmx\Service\Writer;
use Tmx\Tests\TmxTest;
use Tmx\TileSet;

class WriterTest extends TmxTest
{
    private vfsStreamDirectory $root;
    private Writer $writer;

    public function testSaveSimpleMap(): void
    {
        // given
        $map = new Map();
        $map->setHeight(1);
        $map->setWidth(2);
        $map->setTileWidth(32);
        $map->setTileHeight(32);

        $image = new Image();
        $image->setWidth(32);
        $image->setHeight(32);
        $image->setSource($this->getResourceFolder() . '_tileSet' . DIRECTORY_SEPARATOR . 'door_32x32.png');
        $image->setFormat('png');

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

        // when
        $this->writer->write($map, vfsStream::url('root') . DIRECTORY_SEPARATOR . 'testmap.tmx');

        // then
        self::assertFileExists(vfsStream::url('root') . DIRECTORY_SEPARATOR . 'testmap.tmx');
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->root = vfsStream::setup();
        $this->writer = new Writer();
    }
}
