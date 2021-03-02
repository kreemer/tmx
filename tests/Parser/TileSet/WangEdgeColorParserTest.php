<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\TileSet;

use Tmx\WangSet;

class WangEdgeColorParserTest extends WangSetTest
{
    public function testNoWangSetIfThereIsNone(): void
    {
        // when
        $tileSet = $this->parser->parseTileSet($this->getTileSetPath('map-3'));

        // then
        self::assertNull($this->extractWangSet($tileSet));
    }

    public function testWangSetHasCorrectAmount(): array
    {
        // when
        $tileSet = $this->parser->parseTileSet($this->getTileSetPath('wangSet'));

        // then
        self::assertCount(3, $this->extractWangSet($tileSet));

        return $this->extractWangSet($tileSet);
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangSetHasCorrectAmount
     */
    public function testWangEdgeColorIsNotNull(array $wangSet): array
    {
        // then
        self::assertNotNull($wangSet[0]->getWangEdgeColors());
        self::assertNotNull($wangSet[1]->getWangEdgeColors());
        self::assertNotNull($wangSet[2]->getWangEdgeColors());

        return $wangSet;
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangEdgeColorIsNotNull
     */
    public function testWangEdgeColorHasCorrectAmount(array $wangSet): array
    {
        // then
        self::assertCount(3, $wangSet[0]->getWangEdgeColors());

        return $wangSet;
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangEdgeColorHasCorrectAmount
     */
    public function testWangEdgeColorHasCorrectName(array $wangSet): void
    {
        // then
        self::assertEquals('WEC1', $wangSet[0]->getWangEdgeColors()[0]->getName());
        self::assertEquals('WEC2', $wangSet[0]->getWangEdgeColors()[1]->getName());
        self::assertEquals('WEC3', $wangSet[0]->getWangEdgeColors()[2]->getName());
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangEdgeColorHasCorrectAmount
     */
    public function testWangEdgeColorHasCorrectColor(?array $wangSet): void
    {
        // then
        self::assertEquals('#ff0000', $wangSet[0]->getWangEdgeColors()[0]->getColor());
        self::assertEquals('#00ff00', $wangSet[0]->getWangEdgeColors()[1]->getColor());
        self::assertEquals('#0000ff', $wangSet[0]->getWangEdgeColors()[2]->getColor());
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangEdgeColorHasCorrectAmount
     */
    public function testWangEdgeColorHasCorrectTileId(?array $wangSet): void
    {
        // then
        self::assertEquals('1', $wangSet[0]->getWangEdgeColors()[0]->getTileId());
        self::assertEquals('2', $wangSet[0]->getWangEdgeColors()[1]->getTileId());
        self::assertEquals('3', $wangSet[0]->getWangEdgeColors()[2]->getTileId());
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangEdgeColorHasCorrectAmount
     */
    public function testWangEdgeColorHasCorrectProbability(?array $wangSet): void
    {
        // then
        self::assertEquals(0.25, $wangSet[0]->getWangEdgeColors()[0]->getProbability());
        self::assertEquals(0.3, $wangSet[0]->getWangEdgeColors()[1]->getProbability());
        self::assertEquals(1, $wangSet[0]->getWangEdgeColors()[2]->getProbability());
    }
}
