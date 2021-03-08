<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\Map;

use Tmx\Group;
use Tmx\Layer;
use Tmx\Tests\Parser\ParserTest;

class GroupLayerParserTest extends ParserTest
{
    public function testSimpleLayerIsNotGroupLayer(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertCount(1, $map->getLayers());
        self::assertNotInstanceOf(Group::class, $map->getLayers()[0]);
    }

    public function testGroupLayerCanBeParse(): array
    {
        // when
        $map = $this->parser->parse($this->getMapPath('group-layer-simple'));

        // then
        self::assertCount(1, $map->getGroups());

        return $map->getGroups();
    }

    /**
     * @depends testGroupLayerCanBeParse
     */
    public function testGroupIdAndNameAreSet(array $groups): void
    {
        // then
        self::assertSame(9, $groups[0]->getId());
        self::assertSame('Group 5', $groups[0]->getName());
    }

    /**
     * @depends testGroupLayerCanBeParse
     */
    public function testGroupContainsLayer(array $groups): Layer
    {
        // then
        self::assertNotEmpty($groups[0]->getLayers());
        self::assertCount(1, $groups[0]->getLayers());

        return $groups[0]->getLayers()[0];
    }

    /**
     * @depends testGroupContainsLayer
     */
    public function testLayerHasRightOrdering(Layer $layer): void
    {
        // then
        self::assertSame(0, $layer->getOrder());
    }

    public function testMultipleGroupLayerCanBeParse(): array
    {
        // when
        $map = $this->parser->parse($this->getMapPath('group-layer-multiple'));

        // then
        self::assertCount(2, $map->getGroups());

        return $map->getGroups();
    }

    /**
     * @depends testMultipleGroupLayerCanBeParse
     */
    public function testMultipleGroupIdAndNameAreSet(array $groups): void
    {
        // then
        self::assertSame(9, $groups[0]->getId());
        self::assertSame('Group 5', $groups[0]->getName());
        self::assertSame(11, $groups[1]->getId());
        self::assertSame('Group 11', $groups[1]->getName());
    }

    /**
     * @depends testMultipleGroupLayerCanBeParse
     */
    public function testMultipleGroupContainsLayer(array $groups): array
    {
        // then
        self::assertNotEmpty($groups[0]->getLayers());
        self::assertCount(1, $groups[0]->getLayers());

        self::assertNotEmpty($groups[1]->getLayers());
        self::assertCount(1, $groups[1]->getLayers());

        return $groups;
    }

    /**
     * @depends testMultipleGroupContainsLayer
     */
    public function testMultipleLayerHasRightOrdering(array $groups): void
    {
        // then
        self::assertSame(0, $groups[0]->getLayers()[0]->getOrder());
        self::assertSame(1, $groups[1]->getLayers()[0]->getOrder());
    }

    public function testNestedGroupLayerCanBeParse(): array
    {
        // when
        $map = $this->parser->parse($this->getMapPath('group-layer-nested'));

        // then
        self::assertCount(2, $map->getGroups());
        self::assertCount(1, $map->getGroups()[0]->getGroups());
        self::assertCount(0, $map->getGroups()[1]->getGroups());

        return $map->getGroups();
    }

    /**
     * @depends testNestedGroupLayerCanBeParse
     */
    public function testNestedGroupIdAndNameAreSet(array $groups): void
    {
        // then
        self::assertSame(6, $groups[0]->getId());
        self::assertSame('Group 3', $groups[0]->getName());

        self::assertSame(7, $groups[0]->getGroups()[0]->getId());
        self::assertSame('Group 4', $groups[0]->getGroups()[0]->getName());

        self::assertSame(11, $groups[1]->getId());
        self::assertSame('Group 3', $groups[1]->getName());
    }

    /**
     * @depends testNestedGroupLayerCanBeParse
     */
    public function testNestedGroupContainsLayer(array $groups): array
    {
        // then
        self::assertCount(0, $groups[0]->getLayers());
        self::assertCount(1, $groups[0]->getGroups()[0]->getLayers());
        self::assertCount(1, $groups[1]->getLayers());

        return $groups;
    }

    /**
     * @depends testNestedGroupContainsLayer
     */
    public function testNestedLayerHasRightOrdering(array $groups): void
    {
        // then
        self::assertSame(0, $groups[0]->getGroups()[0]->getLayers()[0]->getOrder());
        self::assertSame(1, $groups[1]->getLayers()[0]->getOrder());
    }

    public function testGroupOpacityIsDefaultTo1(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('group-layer-simple'));

        // then
        self::assertCount(1, $map->getGroups());
        self::assertSame(1.0, $map->getGroups()[0]->getOpacity());
    }

    public function testGroupVisibilityWillBeParsed(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('group-layer-visible'));

        // then
        self::assertCount(1, $map->getGroups());
        self::assertFalse($map->getGroups()[0]->isVisible());
    }

    public function testGroupVisibilityIsDefaultTrue(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('group-layer-simple'));

        // then
        self::assertCount(1, $map->getGroups());
        self::assertTrue($map->getGroups()[0]->isVisible());
    }

    public function testInfiniteMapWithGroupLayerDoesHaveRightChunks(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('group-infinite'));

        // then
        self::assertCount(1, $map->getGroups());
    }
}
