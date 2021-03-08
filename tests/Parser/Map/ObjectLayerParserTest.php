<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Tests\Parser\Map;

use Tmx\Object\Ellipse;
use Tmx\Object\Point;
use Tmx\Object\Polygon;
use Tmx\Object\Polyline;
use Tmx\Object\Rectangle;
use Tmx\Object\Text;
use Tmx\Tests\Parser\ParserTest;

class ObjectLayerParserTest extends ParserTest
{
    public function testSimpleMapHasNoObjectLayer(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('map-1'));

        // then
        self::assertCount(0, $map->getObjectLayers());
    }

    public function testEllipseObjectLayerNotEmpty(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-ellipse'));

        // then
        self::assertCount(1, $map->getObjectLayers());
    }

    /**
     * @depends testEllipseObjectLayerNotEmpty
     */
    public function testEllipseObjectLayerHasDrawObject(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-ellipse'));

        // then
        self::assertCount(1, $map->getObjectLayers()[0]->getDrawObjects());
    }

    /**
     * @depends testEllipseObjectLayerHasDrawObject
     */
    public function testEllipseObjectLayerHasInstanceEllipse(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-ellipse'));

        // then
        self::assertInstanceOf(Ellipse::class, $map->getObjectLayers()[0]->getDrawObjects()[0]);
    }

    /**
     * @depends testEllipseObjectLayerHasInstanceEllipse
     */
    public function testEllipseHasCorrectMetadata(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-ellipse'));

        // then
        /** @var Ellipse $ellipse */
        $ellipse = $map->getObjectLayers()[0]->getDrawObjects()[0];
        self::assertSame(1, $ellipse->getId());
        self::assertSame('Simple', $ellipse->getName());
        self::assertSame('Test', $ellipse->getType());
        self::assertSame(25.0598, $ellipse->getX());
        self::assertSame(20.5034, $ellipse->getY());
        self::assertSame(130.994, $ellipse->getWidth());
        self::assertSame(118.464, $ellipse->getHeight());
    }

    public function testPointObjectLayerNotEmpty(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-point'));

        // then
        self::assertCount(1, $map->getObjectLayers());
    }

    /**
     * @depends testPointObjectLayerNotEmpty
     */
    public function testPointObjectLayerHasDrawObject(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-point'));

        // then
        self::assertCount(1, $map->getObjectLayers()[0]->getDrawObjects());
    }

    /**
     * @depends testPointObjectLayerHasDrawObject
     */
    public function testPointObjectLayerHasInstancePoint(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-point'));

        // then
        self::assertInstanceOf(Point::class, $map->getObjectLayers()[0]->getDrawObjects()[0]);
    }

    /**
     * @depends testPointObjectLayerHasInstancePoint
     */
    public function testPointHasCorrectMetadata(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-point'));

        // then
        /** @var Point $point */
        $point = $map->getObjectLayers()[0]->getDrawObjects()[0];
        self::assertSame(1, $point->getId());
        self::assertSame('Simple', $point->getName());
        self::assertSame('Test', $point->getType());
        self::assertSame(109.411, $point->getX());
        self::assertSame(88.3217, $point->getY());
        self::assertSame(130.994, $point->getWidth());
        self::assertSame(118.464, $point->getHeight());
    }

    public function testPolygonObjectLayerNotEmpty(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-polygon'));

        // then
        self::assertCount(1, $map->getObjectLayers());
    }

    /**
     * @depends testPolygonObjectLayerNotEmpty
     */
    public function testPolygonObjectLayerHasDrawObject(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-polygon'));

        // then
        self::assertCount(1, $map->getObjectLayers()[0]->getDrawObjects());
    }

    /**
     * @depends testPolygonObjectLayerHasDrawObject
     */
    public function testPolygonObjectLayerHasInstancePolygon(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-polygon'));

        // then
        self::assertInstanceOf(Polygon::class, $map->getObjectLayers()[0]->getDrawObjects()[0]);
    }

    /**
     * @depends testPolygonObjectLayerHasInstancePolygon
     */
    public function testPolygonHasCorrectMetadata(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-polygon'));

        // then
        /** @var Polygon $polygon */
        $polygon = $map->getObjectLayers()[0]->getDrawObjects()[0];
        self::assertSame(2, $polygon->getId());
        self::assertNull($polygon->getName());
        self::assertNull($polygon->getType());
        self::assertSame(33.0656, $polygon->getX());
        self::assertSame(106.282, $polygon->getY());
        self::assertSame(0.0, $polygon->getWidth());
        self::assertSame(0.0, $polygon->getHeight());

        self::assertSame('0,0 22.2687,-46.2244 88.0626,-34.4153 40.1511,-0.337404', $polygon->getPoints());
    }

    public function testPolylineObjectLayerNotEmpty(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-polyline'));

        // then
        self::assertCount(1, $map->getObjectLayers());
    }

    /**
     * @depends testPolylineObjectLayerNotEmpty
     */
    public function testPolylineObjectLayerHasDrawObject(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-polyline'));

        // then
        self::assertCount(1, $map->getObjectLayers()[0]->getDrawObjects());
    }

    /**
     * @depends testPolylineObjectLayerHasDrawObject
     */
    public function testPolylineObjectLayerHasInstancePolyline(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-polyline'));

        // then
        self::assertInstanceOf(Polyline::class, $map->getObjectLayers()[0]->getDrawObjects()[0]);
    }

    /**
     * @depends testPolylineObjectLayerHasInstancePolyline
     */
    public function testPolylineHasCorrectMetadata(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-polyline'));

        // then
        /** @var Polyline $polyline */
        $polyline = $map->getObjectLayers()[0]->getDrawObjects()[0];
        self::assertSame(5, $polyline->getId());
        self::assertNull($polyline->getName());
        self::assertNull($polyline->getType());
        self::assertSame(66.1313, $polyline->getX());
        self::assertSame(77.603, $polyline->getY());
        self::assertSame(0.0, $polyline->getWidth());
        self::assertSame(0.0, $polyline->getHeight());

        self::assertSame('0,0 52.9725,-44.2', $polyline->getPoints());
    }

    public function testTextObjectLayerNotEmpty(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-text'));

        // then
        self::assertCount(1, $map->getObjectLayers());
    }

    /**
     * @depends testTextObjectLayerNotEmpty
     */
    public function testTextObjectLayerHasDrawObject(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-text'));

        // then
        self::assertCount(1, $map->getObjectLayers()[0]->getDrawObjects());
    }

    /**
     * @depends testTextObjectLayerHasDrawObject
     */
    public function testTextObjectLayerHasInstanceText(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-text'));

        // then
        self::assertInstanceOf(Text::class, $map->getObjectLayers()[0]->getDrawObjects()[0]);
    }

    /**
     * @depends testTextObjectLayerHasInstanceText
     */
    public function testTextHasCorrectMetadata(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-text'));

        // then
        /** @var Text $text */
        $text = $map->getObjectLayers()[0]->getDrawObjects()[0];
        self::assertSame(4, $text->getId());
        self::assertNull($text->getName());
        self::assertNull($text->getType());
        self::assertSame(16.6342, $text->getX());
        self::assertSame(60.4208, $text->getY());
        self::assertSame(89.5469, $text->getWidth());
        self::assertSame(18.8438, $text->getHeight());

        self::assertSame('sans-serif', $text->getFontFamily());
        self::assertSame(16, $text->getPixelSize());
        self::assertFalse($text->isWrap());
        self::assertSame('#000000', $text->getColor());
        self::assertFalse($text->isBold());
        self::assertFalse($text->isItalic());
        self::assertFalse($text->isUnderline());
        self::assertFalse($text->isStrikeOut());
        self::assertTrue($text->isKerning());
        self::assertSame('left', $text->getHAlign());
        self::assertSame('top', $text->getVAlign());
        self::assertEquals('Hello World', $text->getText());
    }

    public function testRectangleObjectLayerNotEmpty(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-rectangle'));

        // then
        self::assertCount(1, $map->getObjectLayers());
    }

    /**
     * @depends testRectangleObjectLayerNotEmpty
     */
    public function testRectangleObjectLayerHasDrawObject(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-rectangle'));

        // then
        self::assertCount(1, $map->getObjectLayers()[0]->getDrawObjects());
    }

    /**
     * @depends testRectangleObjectLayerHasDrawObject
     */
    public function testRectangleObjectLayerHasInstanceRectangle(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-rectangle'));

        // then
        self::assertInstanceOf(Rectangle::class, $map->getObjectLayers()[0]->getDrawObjects()[0]);
    }

    /**
     * @depends testRectangleObjectLayerHasInstanceRectangle
     */
    public function testRectangleHasCorrectMetadata(): void
    {
        // when
        $map = $this->parser->parse($this->getMapPath('object-rectangle'));

        // then
        /** @var Rectangle $rectangle */
        $rectangle = $map->getObjectLayers()[0]->getDrawObjects()[0];
        self::assertSame(4, $rectangle->getId());
        self::assertNull($rectangle->getName());
        self::assertNull($rectangle->getType());
        self::assertSame(28.6794, $rectangle->getX());
        self::assertSame(60.058, $rectangle->getY());
        self::assertSame(106.282, $rectangle->getWidth());
        self::assertSame(56.0091, $rectangle->getHeight());
    }
}
