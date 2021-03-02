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

class ChunkParserTest extends ParserTest
{
    public function testSimpleEmptyLayerExists(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertCount(1, $map->getLayers());

        $layer = $map->getLayers()[0];
        self::assertNotNull($layer->getLayerData());
        self::assertNotNull($layer->getLayerData()->getChunks());
        self::assertEmpty($layer->getLayerData()->getChunks());
    }

    public function testAmountOfChunkIsNotEmpty(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('infinite'));

        // then
        self::assertCount(2, $map->getLayers());

        $layer = $map->getLayers()[0];
        self::assertNotNull($layer->getLayerData());
        self::assertNotNull($layer->getLayerData()->getChunks());
        self::assertNotEmpty($layer->getLayerData()->getChunks());
        self::assertCount(6, $layer->getLayerData()->getChunks());
    }

    public function testChunkXIsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('infinite'));

        // then
        self::assertCount(2, $map->getLayers());

        $chunks = $map->getLayers()[0]->getLayerData()->getChunks();

        self::assertSame(-16, $chunks[0]->getX());
        self::assertSame(0, $chunks[1]->getX());
        self::assertSame(48, $chunks[2]->getX());
        self::assertSame(-16, $chunks[3]->getX());
        self::assertSame(0, $chunks[4]->getX());
        self::assertSame(48, $chunks[5]->getX());
    }

    public function testChunkYIsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('infinite'));

        // then
        self::assertCount(2, $map->getLayers());

        $chunks = $map->getLayers()[0]->getLayerData()->getChunks();

        self::assertSame(-16, $chunks[0]->getY());
        self::assertSame(-16, $chunks[1]->getY());
        self::assertSame(-16, $chunks[2]->getY());
        self::assertSame(0, $chunks[3]->getY());
        self::assertSame(0, $chunks[4]->getY());
        self::assertSame(0, $chunks[5]->getY());
    }

    public function testChunkWidthIsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('infinite'));

        // then
        self::assertCount(2, $map->getLayers());

        $chunks = $map->getLayers()[0]->getLayerData()->getChunks();

        foreach ($chunks as $chunk) {
            self::assertSame(16, $chunk->getWidth());
        }
    }

    public function testChunkHeightIsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('infinite'));

        // then
        self::assertCount(2, $map->getLayers());

        $chunks = $map->getLayers()[0]->getLayerData()->getChunks();

        foreach ($chunks as $chunk) {
            self::assertSame(16, $chunk->getHeight());
        }
    }

    public function testChunkDatatIsCorrect(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('infinite'));

        // then
        self::assertCount(2, $map->getLayers());

        $chunks = $map->getLayers()[0]->getLayerData()->getChunks();

        foreach ($chunks as $chunk) {
            self::assertNotNull(16, $chunk->getData());
        }
    }
}
