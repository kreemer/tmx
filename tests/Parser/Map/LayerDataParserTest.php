<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\Map;

use Tmx\Tests\Parser\ParserTest;

class LayerDataParserTest extends ParserTest
{
    public function testSimpleEmptyLayerExists(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        self::assertNotNull($layer->getLayerData());
    }

    public function testEncodingOfLayerData(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        self::assertEquals('csv', $layer->getLayerData()->getEncoding());
    }

    public function testCompressionNullOfMap(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        self::assertNull($layer->getLayerData()->getCompression());
    }

    public function testCompressionZlibOfMap(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('base64-saved-zlib'));

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        self::assertEquals('zlib', $layer->getLayerData()->getCompression());
    }

    public function testDataOfLayerData(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        $data = $layer->getLayerData()->getData();
        self::assertNotNull($data);
    }

    public function testDataMapOfLayerData(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        $data = $layer->getLayerData()->getDataMap();
        self::assertNotNull($data);
        self::assertCount(100, $data);
        foreach ($data as $line) {
            self::assertCount(100, $line);
        }
    }

    public function testPlainBase64EncodedCanBeParsed(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('base64-saved'));

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        $data = $layer->getLayerData()->getDataMap();
        self::assertNotNull($data);
        self::assertCount(4, $data);
        foreach ($data as $line) {
            self::assertCount(4, $line);
        }
    }

    public function testZlibBase64EncodedCanBeParsed(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('base64-saved-zlib'));

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        $data = $layer->getLayerData()->getDataMap();
        self::assertNotNull($data);
        self::assertCount(4, $data);
        foreach ($data as $line) {
            self::assertCount(4, $line);
        }
    }

    public function testZstdBase64EncodedCanBeParsed(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('base64-saved-zstd'));

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        $data = $layer->getLayerData()->getDataMap();
        self::assertNotNull($data);
        self::assertCount(4, $data);
        foreach ($data as $line) {
            self::assertCount(4, $line);
        }
    }
}
