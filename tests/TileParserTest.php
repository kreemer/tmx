<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests;

use Tmx\Tile;

class TileParserTest extends TmxTest
{
    public function testTileSetWithoutTiles(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-3'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertCount(0, $map->getTileSets()[0]->getTiles());
    }

    public function testTileSetWithTilesWillParseThemAsArray(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('terrain'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertNotCount(0, $map->getTileSets()[0]->getTiles());
    }

    public function testTileTerrainHasCorrectAmountOfTiles(): array
    {
        // when
        $map = $this->parser->parse($this->getMapPath('tile-terrain'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertCount(4, $map->getTileSets()[0]->getTiles());

        return $map->getTileSets()[0]->getTiles();
    }

    /**
     * @param array<Tile> $tiles
     * @depends testTileTerrainHasCorrectAmountOfTiles
     */
    public function testTileTerrainHasCorrectReferencesForTerrain1(array $tiles): void
    {
        $tile = $tiles[0];

        // then
        self::assertSame(0, $tile->getTopLeftTerrainId());
        self::assertSame(0, $tile->getTopRightTerrainId());
        self::assertSame(0, $tile->getBottomLeftTerrainId());
        self::assertSame(0, $tile->getBottomRightTerrainId());
    }

    /**
     * @param array<Tile> $tiles
     * @depends testTileTerrainHasCorrectAmountOfTiles
     */
    public function testTileTerrainHasCorrectReferencesForTerrain2(array $tiles): void
    {
        $tile = $tiles[1];

        // then
        self::assertSame(1, $tile->getTopLeftTerrainId());
        self::assertSame(2, $tile->getTopRightTerrainId());
        self::assertSame(1, $tile->getBottomLeftTerrainId());
        self::assertSame(2, $tile->getBottomRightTerrainId());
    }

    /**
     * @param array<Tile> $tiles
     * @depends testTileTerrainHasCorrectAmountOfTiles
     */
    public function testTileTerrainHasCorrectReferencesForTerrain3(array $tiles): void
    {
        $tile = $tiles[2];

        // then
        self::assertSame(1, $tile->getTopLeftTerrainId());
        self::assertSame(3, $tile->getTopRightTerrainId());
        self::assertSame(1, $tile->getBottomLeftTerrainId());
        self::assertSame(3, $tile->getBottomRightTerrainId());
    }

    /**
     * @param array<Tile> $tiles
     * @depends testTileTerrainHasCorrectAmountOfTiles
     */
    public function testTileTerrainHasCorrectReferencesForTerrain4(array $tiles): void
    {
        $tile = $tiles[3];

        // then
        self::assertSame(2, $tile->getTopLeftTerrainId());
        self::assertNull($tile->getTopRightTerrainId());
        self::assertSame(1, $tile->getBottomLeftTerrainId());
        self::assertSame(0, $tile->getBottomRightTerrainId());
    }

    /**
     * @param array<Tile> $tiles
     * @depends testTileTerrainHasCorrectAmountOfTiles
     */
    public function testTileTerrainHasCorrectIdForTiles(array $tiles): void
    {
        // then
        self::assertSame(0, $tiles[0]->getId());
        self::assertSame(1, $tiles[1]->getId());
        self::assertSame(2, $tiles[2]->getId());
        self::assertSame(3, $tiles[3]->getId());
    }

    /**
     * @param array<Tile> $tiles
     * @depends testTileTerrainHasCorrectAmountOfTiles
     */
    public function testTileTypesAreCorrect(array $tiles): void
    {
        // then
        self::assertSame('Blah', $tiles[0]->getType());
        self::assertNull($tiles[1]->getType());
        self::assertSame('Test', $tiles[2]->getType());
        self::assertNull($tiles[3]->getType());
    }

    /**
     * @param array<Tile> $tiles
     * @depends testTileTerrainHasCorrectAmountOfTiles
     */
    public function testTileProbabilityAreCorrect(array $tiles): void
    {
        // then
        self::assertSame(1.123, $tiles[0]->getProbability());
        self::assertSame(4.0, $tiles[1]->getProbability());
        self::assertSame(1.0, $tiles[2]->getProbability());
        self::assertSame(0.0, $tiles[3]->getProbability());
    }
}
