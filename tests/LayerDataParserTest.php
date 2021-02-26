<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests;

use Tmx\Parser;

class LayerDataParserTest extends TmxTest
{
    private Parser $parser;

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

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
}
