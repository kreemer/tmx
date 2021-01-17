<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

use PHPUnit\Framework\TestCase;

class LayerDataParserTest extends TestCase
{
    private Parser $parser;
    private string $resourceFolder = __DIR__.'/../resources';

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testSimpleEmptyLayerExists(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example1.tmx');

        // then
        self::assertEquals(1, count($map->getLayers()));

        /** @var Layer $layer */
        $layer = $map->getLayers()[0];
        self::assertNotNull($layer->getLayerData());
    }

    public function testEncodingOfLayerData(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example1.tmx');

        // then
        self::assertEquals(1, count($map->getLayers()));

        /** @var Layer $layer */
        $layer = $map->getLayers()[0];
        self::assertEquals('csv', $layer->getLayerData()->getEncoding());
    }

    public function testDataOfLayerData(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example1.tmx');

        // then
        self::assertEquals(1, count($map->getLayers()));

        /** @var Layer $layer */
        $layer = $map->getLayers()[0];
        $data = $layer->getLayerData()->getData();
        self::assertNotNull($data);
    }

    public function testDataMapOfLayerData(): void
    {
        // when
        $map = $this->parser->parse($this->resourceFolder.'/example1.tmx');

        // then
        self::assertEquals(1, count($map->getLayers()));

        /** @var Layer $layer */
        $layer = $map->getLayers()[0];
        $data = $layer->getLayerData()->getDataMap();
        self::assertNotNull($data);
        self::assertEquals(100, count($data));
        foreach ($data as $line) {
            self::assertEquals(100, count($line));
        }
    }
}
