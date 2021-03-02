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

class WangCornerColorParserTest extends WangSetTest
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
    public function testWangCornerColorIsNotNull(array $wangSet): array
    {
        // then
        self::assertNotNull($wangSet[0]->getWangCornerColors());
        self::assertNotNull($wangSet[1]->getWangCornerColors());
        self::assertNotNull($wangSet[2]->getWangCornerColors());

        return $wangSet;
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangCornerColorIsNotNull
     */
    public function testWangCornerColorHasCorrectAmount(array $wangSet): array
    {
        // then
        self::assertCount(3, $wangSet[1]->getWangCornerColors());

        return $wangSet;
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangCornerColorHasCorrectAmount
     */
    public function testWangCornerColorHasCorrectName(array $wangSet): void
    {
        // then
        self::assertEquals('WCC1', $wangSet[1]->getWangCornerColors()[0]->getName());
        self::assertEquals('WCC2', $wangSet[1]->getWangCornerColors()[1]->getName());
        self::assertEquals('WCC3', $wangSet[1]->getWangCornerColors()[2]->getName());
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangCornerColorHasCorrectAmount
     */
    public function testWangCornerColorHasCorrectColor(?array $wangSet): void
    {
        // then
        self::assertEquals('#ff0000', $wangSet[1]->getWangCornerColors()[0]->getColor());
        self::assertEquals('#00ff00', $wangSet[1]->getWangCornerColors()[1]->getColor());
        self::assertEquals('#0000ff', $wangSet[1]->getWangCornerColors()[2]->getColor());
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangCornerColorHasCorrectAmount
     */
    public function testWangCornerColorHasCorrectTileId(?array $wangSet): void
    {
        // then
        self::assertEquals('1', $wangSet[1]->getWangCornerColors()[0]->getTileId());
        self::assertEquals('2', $wangSet[1]->getWangCornerColors()[1]->getTileId());
        self::assertEquals('3', $wangSet[1]->getWangCornerColors()[2]->getTileId());
    }

    /**
     * @param array<WangSet> $wangSet
     * @depends testWangCornerColorHasCorrectAmount
     */
    public function testWangCornerColorHasCorrectProbability(?array $wangSet): void
    {
        // then
        self::assertEquals(0.25, $wangSet[1]->getWangCornerColors()[0]->getProbability());
        self::assertEquals(0.3, $wangSet[1]->getWangCornerColors()[1]->getProbability());
        self::assertEquals(1, $wangSet[1]->getWangCornerColors()[2]->getProbability());
    }
}
