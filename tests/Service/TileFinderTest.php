<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Service;

use Tmx\Property\ColorProperty;
use Tmx\Property\StringProperty;
use Tmx\PropertyBag;
use Tmx\Service\TileFinder;
use PHPUnit\Framework\TestCase;
use Tmx\Tile;
use Tmx\TileSet;

class TileFinderTest extends TestCase
{
    public function testArrayIsEmptyIfNoTilesInsideTileSet(): void
    {
        // given
        $tileSet = new TileSet();

        // when
        $tiles = TileFinder::findTileByProperty($tileSet, ['id' => 'key']);

        // then
        self::assertEmpty($tiles);
    }

    public function testArrayIsEmptyIfNoCriteria(): void
    {
        // given
        $tileSet = new TileSet();

        // when
        $tiles = TileFinder::findTileByProperty($tileSet, []);

        // then
        self::assertEmpty($tiles);
    }


    public function testArrayIsEmptyIfTileHasNoPropertyBag(): void
    {
        // given
        $tileSet = new TileSet();
        $tile = new Tile();
        $tileSet->addTile($tile);

        // when
        $tiles = TileFinder::findTileByProperty($tileSet, ['id' => 'key']);

        // then
        self::assertEmpty($tiles);
    }

    public function testArrayIsEmptyIfNoPropertiesInBag(): void
    {
        // given
        $tileSet = new TileSet();
        $tile = new Tile();
        $propertyBag = new PropertyBag();

        $tile->setPropertyBag($propertyBag);
        $tileSet->addTile($tile);

        // when
        $tiles = TileFinder::findTileByProperty($tileSet, ['id' => 'key']);

        // then
        self::assertEmpty($tiles);
    }

    public function testArrayIsEmptyIfNoPropertyString(): void
    {
        // given
        $tileSet = new TileSet();
        $tile = new Tile();
        $propertyBag = new PropertyBag();

        $property = new ColorProperty();
        $property->setName('id');
        $property->setValue('key');

        $propertyBag->addProperty($property);
        $tile->setPropertyBag($propertyBag);
        $tileSet->addTile($tile);

        // when
        $tiles = TileFinder::findTileByProperty($tileSet, ['id' => 'key']);

        // then
        self::assertEmpty($tiles);
    }

    public function testArrayIsEmptyIfIdDoesNotMatchKey(): void
    {
        // given
        $tileSet = new TileSet();
        $tile = new Tile();
        $propertyBag = new PropertyBag();

        $property = new StringProperty();
        $property->setName('id2');
        $property->setValue('key');

        $propertyBag->addProperty($property);
        $tile->setPropertyBag($propertyBag);
        $tileSet->addTile($tile);

        // when
        $tiles = TileFinder::findTileByProperty($tileSet, ['id' => 'key']);

        // then
        self::assertEmpty($tiles);
    }

    public function testArrayIsEmptyIfIdDoesNotMatchValue(): void
    {
        // given
        $tileSet = new TileSet();
        $tile = new Tile();
        $propertyBag = new PropertyBag();

        $property = new StringProperty();
        $property->setName('id');
        $property->setValue('key1');

        $propertyBag->addProperty($property);
        $tile->setPropertyBag($propertyBag);
        $tileSet->addTile($tile);

        // when
        $tiles = TileFinder::findTileByProperty($tileSet, ['id' => 'key']);

        // then
        self::assertEmpty($tiles);
    }

    public function testArrayIsContainsOneTile(): void
    {
        // given
        $tileSet = new TileSet();
        $tile = new Tile();
        $propertyBag = new PropertyBag();

        $property = new StringProperty();
        $property->setName('id');
        $property->setValue('key');

        $propertyBag->addProperty($property);
        $tile->setPropertyBag($propertyBag);
        $tileSet->addTile($tile);

        // when
        $tiles = TileFinder::findTileByProperty($tileSet, ['id' => 'key']);

        // then
        self::assertCount(1, $tiles);
        self::assertSame($tile, $tiles[0]);
    }

    public function testArrayIsContainsNotDuplicateTiles(): void
    {
        // given
        $tileSet = new TileSet();
        $tile = new Tile();
        $propertyBag = new PropertyBag();

        $property1 = new StringProperty();
        $property1->setName('id');
        $property1->setValue('key');

        $property2 = new StringProperty();
        $property2->setName('id');
        $property2->setValue('key');

        $propertyBag->addProperty($property1);
        $propertyBag->addProperty($property2);
        $tile->setPropertyBag($propertyBag);
        $tileSet->addTile($tile);

        // when
        $tiles = TileFinder::findTileByProperty($tileSet, ['id' => 'key']);

        // then
        self::assertCount(1, $tiles);
        self::assertSame($tile, $tiles[0]);
    }

    public function testArrayIsContainsMultipleTile(): void
    {
        // given
        $tileSet = new TileSet();
        $tile1 = new Tile();
        $propertyBag1 = new PropertyBag();
        $property1 = new StringProperty();
        $property1->setName('id');
        $property1->setValue('key');

        $tile2 = new Tile();
        $propertyBag2 = new PropertyBag();
        $property2 = new StringProperty();
        $property2->setName('id');
        $property2->setValue('key');

        $propertyBag1->addProperty($property1);
        $tile1->setPropertyBag($propertyBag1);

        $propertyBag2->addProperty($property2);
        $tile2->setPropertyBag($propertyBag2);

        $tileSet->addTile($tile1);
        $tileSet->addTile($tile2);

        // when
        $tiles = TileFinder::findTileByProperty($tileSet, ['id' => 'key']);

        // then
        self::assertCount(2, $tiles);
        self::assertSame($tile1, $tiles[0]);
        self::assertSame($tile2, $tiles[1]);
    }

}
