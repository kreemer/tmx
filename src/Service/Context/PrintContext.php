<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service\Context;


use Tmx\Layer;
use Tmx\Printable;

class PrintContext
{
    private ?bool $visible = null;
    private ?float $opacity = null;
    private ?string $tintColor = null;

    /**
     * @return bool|null
     */
    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    /**
     * @param bool|null $visible
     * @return PrintContext
     */
    public function setVisible(?bool $visible): PrintContext
    {
        $this->visible = $visible;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getOpacity(): ?float
    {
        return $this->opacity;
    }

    /**
     * @param float|null $opacity
     * @return PrintContext
     */
    public function setOpacity(?float $opacity): PrintContext
    {
        $this->opacity = $opacity;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTintColor(): ?string
    {
        return $this->tintColor;
    }

    /**
     * @param string|null $tintColor
     * @return PrintContext
     */
    public function setTintColor(?string $tintColor): PrintContext
    {
        $this->tintColor = $tintColor;
        return $this;
    }



}