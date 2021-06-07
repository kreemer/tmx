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
use SimpleXMLElement;
use Tmx\Image;
use Tmx\Layer;
use Tmx\LayerData;
use Tmx\Map;
use Tmx\Service\Parser;
use Tmx\Service\Writer;
use Tmx\Tests\TmxTest;
use Tmx\TileSet;

class WriterTest extends TmxTest
{
    private vfsStreamDirectory $root;
    private Writer $writer;
    private Parser $parser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->root = vfsStream::setup();
        $this->writer = new Writer();
        $this->parser = new Parser();
    }

    public function testSaveSimpleMap(): string
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

        return file_get_contents(vfsStream::url('root') . DIRECTORY_SEPARATOR . 'testmap.tmx');
    }

    /**
     * @depends testSaveSimpleMap
     */
    public function testSavedMapCanBeParsed(string $fileContent): void
    {
        // given
        file_put_contents(vfsStream::url('root') . DIRECTORY_SEPARATOR . 'testmap.tmx', $fileContent);

        // when
        $map = $this->parser->parse(vfsStream::url('root') . DIRECTORY_SEPARATOR . 'testmap.tmx');

        // then
        self::assertSame(1, $map->getHeight());
        self::assertSame(2, $map->getWidth());
        self::assertCount(1, $map->getTileSets());
        self::assertSame('png', $map->getTileSets()[0]->getImage()->getFormat());
        self::assertCount(1, $map->getLayers());
        self::assertSame(1, $map->getLayers()[0]->getHeight());
        self::assertSame(2, $map->getLayers()[0]->getWidth());
    }

    /**
     * @dataProvider mapOutputProvider
     */
    public function testWritingMaps(string $mapName, bool $debug = false): void
    {
        // given
        $actualMapPath = $debug ?
            __DIR__ . DIRECTORY_SEPARATOR . $mapName . '-saved.tmx' :
            vfsStream::url('root') . DIRECTORY_SEPARATOR . $mapName . '-saved.tmx';
        $map = $this->parser->parse($this->getMapPath($mapName));

        // when
        $this->writer->write($map, $actualMapPath);

        // then
        self::assertMapIsEqual($this->getMapPath($mapName), $actualMapPath);
    }

    private static function assertMapIsEqual(string $fileExpected, string $fileActual): void
    {
        self::assertFileExists($fileExpected);
        self::assertFileExists($fileActual);

        $xml1 = new SimpleXMLElement(file_get_contents($fileExpected));
        $xml2 = new SimpleXMLElement(file_get_contents($fileActual));

        self::assertXmlElementEquals($xml1, $fileExpected, $xml2, $fileActual);
    }

    private static function assertXmlElementEquals(SimpleXMLElement $expected, string $expectedFile, SimpleXMLElement $actual, string $actualFile): void
    {
        self::assertEquals($expected->getName(), $actual->getName(), 'xml name is different');
        self::assertXmlAttributesEquals($expected, $expectedFile, $actual, $actualFile);
        self::assertXmlChildrenEquals($expected, $expectedFile, $actual, $actualFile);
    }

    private static function assertXmlAttributesEquals(SimpleXMLElement $expected, string $expectedFile, SimpleXMLElement $actual, string $actualFile): void
    {
        $actualArray = [];
        $expectedArray = [];

        foreach ($actual->attributes() as $actualKey => $actualValue) {
            $actualArray[$actualKey] = (string) $actualValue;
        }
        foreach ($expected->attributes() as $expectedKey => $expectedValue) {
            $expectedArray[$expectedKey] = (string) $expectedValue;
        }

        if ('tileset' === $expected->getName()) {
            if (isset($expectedArray['source'])) {
                self::assertSame($expectedArray['firstgid'], $actualArray['firstgid']);

                $tileSetArray = [];

                $tileSetXml = new SimpleXMLElement(file_get_contents(dirname($expectedFile) . DIRECTORY_SEPARATOR . $expectedArray['source']));
                foreach ($tileSetXml->attributes() as $tileSetKey => $tileSetValue) {
                    $tileSetArray[$tileSetKey] = (string) $tileSetValue;
                }

                $map = ['name', 'tilewidth', 'tileheight', 'tilecount', 'columns'];
                foreach ($map as $key) {
                    if (isset($actualArray[$key])) {
                        self::assertArrayHasKey($key, $tileSetArray);
                        self::assertSame($actualArray[$key], $tileSetArray[$key]);
                    }
                }

                return;
            }
        }

        self::assertEquals(
            count($expectedArray), count($actualArray),
            'xml attributes within element "' . $expected->getName() . '" have different sizes, expectedKeys: ' . implode(', ', array_keys($expectedArray)) . '. actual: ' . implode(', ', array_keys($actualArray))
        );

        foreach ($expectedArray as $expectedKey => $expectedValue) {
            self::assertArrayHasKey($expectedKey, $actualArray, 'Actual xml element "' . $expected->getName() . '" has no key "' . $expectedKey . '"');
            if ('source' === $expectedKey) {
                self::assertStringEndsWith(basename($expectedValue), $actualArray[$expectedKey]);
                continue;
            }
            self::assertEquals((string) $expectedValue, $actualArray[$expectedKey], 'Actual xml element "' . $expected->getName() . '" has different value for "' . $expectedKey . '"');
        }
    }

    private static function assertXmlChildrenEquals(SimpleXMLElement $expected, string $expectedFile, SimpleXMLElement $actual, string $actualFile): void
    {
        if ('tileset' === $expected->getName()) {
            $expectedArray = [];
            foreach ($expected->attributes() as $expectedKey => $expectedValue) {
                $expectedArray[$expectedKey] = (string) $expectedValue;
            }

            if (isset($expectedArray['source'])) {
                $tileSetXml = new SimpleXMLElement(file_get_contents(dirname($expectedFile) . DIRECTORY_SEPARATOR . $expectedArray['source']));
                for ($i = 0; $i < $tileSetXml->children()->count(); ++$i) {
                    self::assertXmlElementEquals($tileSetXml->children()[$i], $expectedFile, $actual->children()[$i], $actualFile);
                }

                return;
            }
        }

        self::assertEquals($expected->children()->count(), $actual->children()->count(), 'xml children have different sizes');

        for ($i = 0; $i < $expected->children()->count(); ++$i) {
            self::assertXmlElementEquals($expected->children()[$i], $expectedFile, $actual->children()[$i], $actualFile);
        }
    }

    public function mapOutputProvider(): array
    {
        return [
            'map-1' => ['map-1'],
            'map-2' => ['map-2'],
            'map-3' => ['map-3'],
            'map-5' => ['map-5'],
            'map-7' => ['map-7'],
            'map-8' => ['map-8'],
            'background' => ['background'],
            // 'tileoffset' => ['tileoffset'],
            'opacity' => ['opacity'],
            'opacity2' => ['opacity2'],
            'visible' => ['visible'],
            'base64-saved' => ['base64-saved'],
            'base64-saved-zlib' => ['base64-saved-zlib'],
            'base64-saved-zstd' => ['base64-saved-zstd'],
            'infinite' => ['infinite'],
            'infinite-base64' => ['infinite-base64'],
            'group-layer-simple' => ['group-layer-simple'],
            'group-layer-multiple' => ['group-layer-multiple'],
            'group-layer-nested' => ['group-layer-nested'],
            'group-layer-opacity' => ['group-layer-opacity'],
            'group-layer-visible' => ['group-layer-visible'],
            // 'group-infinite' => ['group-infinite'],
            // 'layer-tint' => ['layer-tint', true],
            // 'group-layer-tint' => ['group-layer-tint'],
            'embedded-tileset' => ['embedded-tileset'],
            'image-layer' => ['image-layer'],
            'image-layer-multiple' => ['image-layer-multiple'],
            'animation' => ['animation'],
            'version1-5' => ['version1-5'],
        ];
    }
}
