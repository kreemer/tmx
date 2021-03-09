<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\Map;

use Tmx\Property\BoolProperty;
use Tmx\Property\FileProperty;
use Tmx\Property\FloatProperty;
use Tmx\Property\IntProperty;
use Tmx\Property\ObjectProperty;
use Tmx\Property\StringProperty;
use Tmx\PropertyBagHolder;
use Tmx\Tests\Parser\ParserTest;

class PropertyParserTest extends ParserTest
{
    public function testSimpleMapHasNoProperties(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertNull($map->getPropertyBag());
    }

    public function testMapHasCorrectProperties(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('properties'));

        // then
        self::assertNotNull($map->getPropertyBag());
        self::assertPropertiesAreCorrect($map);
    }

    public function testLayerHasCorrectProperties(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('properties'));

        // then
        self::assertCount(1, $map->getLayers());
        self::assertPropertiesAreCorrect($map->getLayers()[0]);
    }

    public function testTileSetHasCorrectProperties(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('properties'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertPropertiesAreCorrect($map->getTileSets()[0]);
    }

    public function testTileHasCorrectProperties(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('properties'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertCount(1, $map->getTileSets()[0]->getTiles());
        self::assertPropertiesAreCorrect($map->getTileSets()[0]->getTiles()[0]);
    }

    public function testTerrainHasCorrectProperties(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('properties'));

        // then
        self::assertCount(1, $map->getTileSets());
        self::assertCount(1, $map->getTileSets()[0]->getTerrainCollection()->getTerrains());
        self::assertPropertiesAreCorrect($map->getTileSets()[0]->getTerrainCollection()->getTerrains()[0]);
    }

    public function testObjectLayerHasCorrectProperties(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('properties'));

        // then
        self::assertCount(1, $map->getObjectLayers());
        self::assertPropertiesAreCorrect($map->getObjectLayers()[0]);
    }

    public function testObjectHasCorrectProperties(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('properties'));

        // then
        self::assertCount(1, $map->getObjectLayers());
        self::assertCount(1, $map->getObjectLayers()[0]->getDrawObjects());
        self::assertPropertiesAreCorrect($map->getObjectLayers()[0]->getDrawObjects()[0]);
    }

    public function testGroupHasCorrectProperties(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('properties'));

        // then
        self::assertCount(1, $map->getGroups());
        self::assertPropertiesAreCorrect($map->getGroups()[0]);
    }

    private static function assertPropertiesAreCorrect(PropertyBagHolder $propertyBagHolder)
    {
        $properties = $propertyBagHolder->getPropertyBag()->getProperties();

        self::assertCount(6, $properties);

        foreach ($properties as $property) {
            if ($property instanceof BoolProperty) {
                /* @var BoolProperty $property */
                self::assertTrue($property->isValue());
            } elseif ($property instanceof FileProperty) {
                /* @var FileProperty $property */
                self::assertSame('../../../../../../../../tmp', $property->getValue());
            } elseif ($property instanceof FloatProperty) {
                /* @var FloatProperty $property */
                self::assertSame(0.2, $property->getValue());
            } elseif ($property instanceof IntProperty) {
                /* @var IntProperty $property */
                self::assertSame(12, $property->getValue());
            } elseif ($property instanceof ObjectProperty) {
                /* @var ObjectProperty $property */
                self::assertSame(1, $property->getValue());
            } elseif ($property instanceof StringProperty) {
                /* @var StringProperty $property */
                self::assertSame('test', $property->getValue());
            } else {
                self::fail();
            }
        }
    }
}
