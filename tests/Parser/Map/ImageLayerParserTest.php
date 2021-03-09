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
use Tmx\ImageLayer;
use Tmx\Layer;
use Tmx\Tests\Parser\ParserTest;

class ImageLayerParserTest extends ParserTest
{
    public function testSimpleLayerIsNotGroupLayer(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertCount(0, $map->getImageLayers());
    }

    public function testImageLayerCanBeParse(): array
    {
        // when
        $map = $this->parser->parse($this->getMapPath('image-layer'));

        // then
        self::assertCount(1, $map->getImageLayers());

        return $map->getImageLayers();
    }

    /**
     * @depends testImageLayerCanBeParse
     */
    public function testImageLayerIdAndNameAreSet(array $imageLayers): void
    {
        // then
        self::assertSame(2, $imageLayers[0]->getId());
        self::assertSame('Image Layer 1', $imageLayers[0]->getName());
    }

    /**
     * @depends testImageLayerCanBeParse
     */
    public function testImageLayerContainsImage(array $imageLayers): void
    {
        // then
        self::assertNotNull($imageLayers[0]->getImage()->getSource());
        self::assertSame(realpath($this->getResourceFolder()  . '_tileSet/door_32x32.png'), $imageLayers[0]->getImage()->getSource());
        self::assertSame(128, $imageLayers[0]->getImage()->getWidth());
        self::assertSame(32, $imageLayers[0]->getImage()->getHeight());
    }

}
