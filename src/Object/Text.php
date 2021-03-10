<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Object;

use Tmx\DrawObject;

/**
 * Representation of a text inside a object layer.
 *
 * This class represents a text inside an object layer.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#text Documentation
 */
class Text extends DrawObject
{
    /**
     * The font family used (defaults to “sans-serif”).
     *
     * @see Text::getFontFamily()
     * @see Text::setFontFamily()
     */
    private string $fontFamily = 'sans-serif';

    /**
     * The size of the font in pixels (not using points, because other sizes in the TMX format are also using pixels) (defaults to 16).
     *
     * @see Text::getPixelSize()
     * @see Text::setPixelSize()
     */
    private int $pixelSize = 16;

    /**
     * Whether word wrapping is enabled (1) or disabled (0). (defaults to 0).
     *
     * @see Text::isWrap()
     * @see Text::setWrap()
     */
    private bool $wrap = false;

    /**
     * Color of the text in #AARRGGBB or #RRGGBB format (defaults to #000000).
     *
     * @see Text::getColor()
     * @see Text::setColor()
     */
    private string $color = '#000000';

    /**
     * Whether the font is bold (1) or not (0). (defaults to 0).
     *
     * @see Text::isBold()
     * @see Text::setBold()
     */
    private bool $bold = false;

    /**
     * Whether the font is italic (1) or not (0). (defaults to 0).
     *
     * @see Text::isItalic()
     * @see Text::setItalic()
     */
    private bool $italic = false;

    /**
     * Whether a line should be drawn below the text (1) or not (0). (defaults to 0).
     *
     * @see Text::isUnderline()
     * @see Text::setUnderline()
     */
    private bool $underline = false;

    /**
     * Whether a line should be drawn through the text (1) or not (0). (defaults to 0).
     *
     * @see Text::isStrikeOut()
     * @see Text::setStrikeOut()
     */
    private bool $strikeOut = false;

    /**
     * Whether kerning should be used while rendering the text (1) or not (0). (defaults to 1).
     *
     * @see Text::isKerning()
     * @see Text::setKerning()
     */
    private bool $kerning = true;

    /**
     * Horizontal alignment of the text within the object (left, center, right or justify, defaults to left) (since Tiled 1.2.1).
     *
     * @see Text::getHAlign()
     * @see Text::setHAlign()
     */
    private string $hAlign = 'left';

    /**
     * Vertical alignment of the text within the object (top , center or bottom, defaults to top).
     *
     * @see Text::getVAlign()
     * @see Text::setVAlign()
     */
    private string $vAlign = 'top';

    /**
     * Contains the actual text as character data.
     *
     * @see Text::getText()
     * @see Text::setText()
     */
    private string $text = '';

    /**
     * @see Text::$fontFamily
     */
    public function getFontFamily(): string
    {
        return $this->fontFamily;
    }

    /**
     * @see Text::$fontFamily
     */
    public function setFontFamily(string $fontFamily): Text
    {
        $this->fontFamily = $fontFamily;

        return $this;
    }

    /**
     * @see Text::$pixelSize
     */
    public function getPixelSize(): int
    {
        return $this->pixelSize;
    }

    /**
     * @see Text::$pixelSize
     */
    public function setPixelSize(int $pixelSize): Text
    {
        $this->pixelSize = $pixelSize;

        return $this;
    }

    /**
     * @see Text::$wrap
     */
    public function isWrap(): bool
    {
        return $this->wrap;
    }

    /**
     * @see Text::$wrap
     */
    public function setWrap(bool $wrap): Text
    {
        $this->wrap = $wrap;

        return $this;
    }

    /**
     * @see Text::$color
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @see Text::$color
     */
    public function setColor(string $color): Text
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @see Text::$bold
     */
    public function isBold(): bool
    {
        return $this->bold;
    }

    /**
     * @see Text::$bold
     */
    public function setBold(bool $bold): Text
    {
        $this->bold = $bold;

        return $this;
    }

    /**
     * @see Text::$italic
     */
    public function isItalic(): bool
    {
        return $this->italic;
    }

    /**
     * @see Text::$italic
     */
    public function setItalic(bool $italic): Text
    {
        $this->italic = $italic;

        return $this;
    }

    /**
     * @see Text::$underline
     */
    public function isUnderline(): bool
    {
        return $this->underline;
    }

    /**
     * @see Text::$underline
     */
    public function setUnderline(bool $underline): Text
    {
        $this->underline = $underline;

        return $this;
    }

    /**
     * @see Text::$strikeOut
     */
    public function isStrikeOut(): bool
    {
        return $this->strikeOut;
    }

    /**
     * @see Text::$strikeOut
     */
    public function setStrikeOut(bool $strikeOut): Text
    {
        $this->strikeOut = $strikeOut;

        return $this;
    }

    /**
     * @see Text::$kerning
     */
    public function isKerning(): bool
    {
        return $this->kerning;
    }

    /**
     * @see Text::$kerning
     */
    public function setKerning(bool $kerning): Text
    {
        $this->kerning = $kerning;

        return $this;
    }

    /**
     * @see Text::$hAlign
     */
    public function getHAlign(): string
    {
        return $this->hAlign;
    }

    /**
     * @see Text::$hAlign
     */
    public function setHAlign(string $hAlign): Text
    {
        $this->hAlign = $hAlign;

        return $this;
    }

    /**
     * @see Text::$vAlign
     */
    public function getVAlign(): string
    {
        return $this->vAlign;
    }

    /**
     * @see Text::$vAlign
     */
    public function setVAlign(string $vAlign): Text
    {
        $this->vAlign = $vAlign;

        return $this;
    }

    /**
     * @see Text::$text
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @see Text::$text
     */
    public function setText(string $text): Text
    {
        $this->text = $text;

        return $this;
    }
}
