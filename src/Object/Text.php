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

class Text extends DrawObject
{
    private string $fontFamily = 'sans-serif';
    private int $pixelSize = 16;
    private bool $wrap = false;
    private string $color = '#000000';
    private bool $bold = false;
    private bool $italic = false;
    private bool $underline = false;
    private bool $strikeOut = false;
    private bool $kerning = true;
    private string $hAlign = 'left';
    private string $vAlign = 'top';

    private string $text = '';

    public function getFontFamily(): string
    {
        return $this->fontFamily;
    }

    public function setFontFamily(string $fontFamily): Text
    {
        $this->fontFamily = $fontFamily;

        return $this;
    }

    public function getPixelSize(): int
    {
        return $this->pixelSize;
    }

    public function setPixelSize(int $pixelSize): Text
    {
        $this->pixelSize = $pixelSize;

        return $this;
    }

    public function isWrap(): bool
    {
        return $this->wrap;
    }

    public function setWrap(bool $wrap): Text
    {
        $this->wrap = $wrap;

        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): Text
    {
        $this->color = $color;

        return $this;
    }

    public function isBold(): bool
    {
        return $this->bold;
    }

    public function setBold(bool $bold): Text
    {
        $this->bold = $bold;

        return $this;
    }

    public function isItalic(): bool
    {
        return $this->italic;
    }

    public function setItalic(bool $italic): Text
    {
        $this->italic = $italic;

        return $this;
    }

    public function isUnderline(): bool
    {
        return $this->underline;
    }

    public function setUnderline(bool $underline): Text
    {
        $this->underline = $underline;

        return $this;
    }

    public function isStrikeOut(): bool
    {
        return $this->strikeOut;
    }

    public function setStrikeOut(bool $strikeOut): Text
    {
        $this->strikeOut = $strikeOut;

        return $this;
    }

    public function isKerning(): bool
    {
        return $this->kerning;
    }

    public function setKerning(bool $kerning): Text
    {
        $this->kerning = $kerning;

        return $this;
    }

    public function getHAlign(): string
    {
        return $this->hAlign;
    }

    public function setHAlign(string $hAlign): Text
    {
        $this->hAlign = $hAlign;

        return $this;
    }

    public function getVAlign(): string
    {
        return $this->vAlign;
    }

    public function setVAlign(string $vAlign): Text
    {
        $this->vAlign = $vAlign;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Text
    {
        $this->text = $text;

        return $this;
    }
}
