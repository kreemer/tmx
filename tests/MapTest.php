<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests;

use PHPUnit\Framework\TestCase;
use Tmx\Chunk;
use Tmx\Layer;
use Tmx\LayerData;
use Tmx\Map;
use Tmx\Service\MapService;

class MapTest extends TestCase
{
    private Map $map;

    public function testCalculatedWidthIsWidthWhenNotInfinite(): void
    {
        // given
        $this->map->setWidth(100);

        // when
        $result = MapService::getCalculatedWidth($this->map);

        // then
        self::assertSame(100, $result);
    }

    public function testCalculatedHeightIsHeightWhenNotInfinite(): void
    {
        // given
        $this->map->setHeight(100);

        // when
        $result = MapService::getCalculatedHeight($this->map);

        // then
        self::assertSame(100, $result);
    }

    public function testCalculatedWidthIsCalculatedLongestChunk(): void
    {
        // given
        $this->map->setInfiniteMap(true);

        $chunk = new Chunk();
        $chunk->setX(-12);
        $chunk->setWidth(12);

        $layerData = new LayerData();
        $layerData->addChunk($chunk);

        $layer = new Layer();
        $layer->setLayerData($layerData);

        $this->map->addLayer($layer);

        // when
        $result = MapService::getCalculatedWidth($this->map);

        // then
        self::assertSame(12, $result);
    }

    public function testCalculatedHeightIsCalculatedLongestChunk(): void
    {
        // given
        $this->map->setInfiniteMap(true);

        $chunk = new Chunk();
        $chunk->setY(-12);
        $chunk->setHeight(12);

        $layerData = new LayerData();
        $layerData->addChunk($chunk);

        $layer = new Layer();
        $layer->setLayerData($layerData);

        $this->map->addLayer($layer);

        // when
        $result = MapService::getCalculatedHeight($this->map);

        // then
        self::assertSame(12, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->map = new Map();
    }
}
