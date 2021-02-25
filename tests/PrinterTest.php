<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests;

use Intervention\Image\ImageManager;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Tmx\Image;
use Tmx\Layer;
use Tmx\LayerData;
use Tmx\Map;
use Tmx\Parser;
use Tmx\Printer;
use Tmx\TileSet;

class PrinterTest extends TmxTest
{
    private vfsStreamDirectory $root;
    private Printer $printer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->root = vfsStream::setup();
        $this->printer = new Printer();
    }

    public function testRenderEmptyMap(): void
    {
        // given
        $map = new Map();

        $imgPath = vfsStream::url('root') . DIRECTORY_SEPARATOR . '1.png';
        $expectedImgPath = vfsStream::url('root') . DIRECTORY_SEPARATOR . '2.png';

        $manager = new ImageManager();
        $expectedImg = $manager->canvas(1, 1);
        $expectedImg->save($expectedImgPath);

        // when
        $img = $this->printer->render($map);
        $img->save($imgPath);

        // then
        $this->assertImagesAreEqual($expectedImgPath, $imgPath);
    }

    public function testRenderSimpleMapWithOneTile(): void
    {
        // given
        $expectedImg = $this->getResourceFolder() . 'print' . DIRECTORY_SEPARATOR . 'assertDoorOutput.png';

        $map = new Map();
        $map->setHeight(1);
        $map->setWidth(2);
        $map->setTileWidth(32);
        $map->setTileHeight(32);

        $image = new Image();
        $image->setWidth(32);
        $image->setHeight(32);
        $image->setSource($this->getResourceFolder() . 'tileSet' . DIRECTORY_SEPARATOR . 'door_32x32.png');
        $image->setFormat('png');

        $tileSet = new TileSet();
        $tileSet->setImage($image);
        $tileSet->setColumns(1);
        $tileSet->setTileWidth(32);
        $tileSet->setTileHeight(32);
        $tileSet->setFirstGid(1);

        $layerData = new LayerData('1,0', 'csv');

        $layer = new Layer();
        $layer->setHeight(1);
        $layer->setWidth(2);
        $layer->setLayerData($layerData);

        $map->addTileSet($tileSet);
        $map->addLayer($layer);

        // when
        $img = $this->printer->render($map);
        $actualImg = vfsStream::url('root') . DIRECTORY_SEPARATOR . 'testblah.png';
        $img->save($actualImg);

        // then
        $this->assertImagesAreEqual($expectedImg, $actualImg);
    }

    /**
     * @dataProvider mapOutputProvider
     */
    public function testPrintingMaps(string $mapName, string $expectedImageName, bool $debug = false): void
    {
        // given
        $expectedImagePath = $this->getResourceFolder() . 'print' . DIRECTORY_SEPARATOR . $expectedImageName;
        $actualImagePath = $debug ?
            $mapName . '.png' :
            vfsStream::url('root') . DIRECTORY_SEPARATOR . time() . '.png';

        $parser = new Parser();
        $map = $parser->parse($this->getResourceFolder() . $mapName);

        // when
        $this->printer->print($map, $actualImagePath);

        // then
        $this->assertImagesAreEqual($expectedImagePath, $actualImagePath);
    }

    private function assertImagesAreEqual($path1, $path2): void
    {
        if (!file_exists($path1) || !file_exists($path2)) {
            $this->fail('Could not read image');
        }

        $img1 = new \Imagick($path1);
        $img2 = new \Imagick($path2);

        $result = $img1->compareImages($img2, \Imagick::METRIC_ROOTMEANSQUAREDERROR);

        $this->assertLessThan(0.1, $result[1], 'Images are not equal with factor: ' . $result[1]);
    }

    public function mapOutputProvider(): array
    {
        return [
            'largeLandMap' => ['example3.tmx', 'example3.png'],
            'simpleLandMap' => ['example5.tmx', 'example5.png'],
            // 'weirdProportions' => ['example6.tmx', 'example6.png'],
            'orientationSwitched' => ['example7.tmx', 'example7.png'],
            'mulipleLayerMap' => ['example8.tmx', 'example8.png'],
            'basicBackground' => ['basic-background.tmx', 'basic-background.png', true],
            'basicTileOffset' => ['basic-tileoffset.tmx', 'basic-tileoffset.png'],
        ];
    }
}
