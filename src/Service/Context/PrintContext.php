<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service\Context;

class PrintContext
{
    private ?bool $visible = null;
    private ?float $opacity = null;
    private ?string $tintColor = null;

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(?bool $visible): PrintContext
    {
        $this->visible = $visible;

        return $this;
    }

    public function getOpacity(): ?float
    {
        return $this->opacity;
    }

    public function setOpacity(?float $opacity): PrintContext
    {
        $this->opacity = $opacity;

        return $this;
    }

    public function getTintColor(): ?string
    {
        return $this->tintColor;
    }

    public function setTintColor(?string $tintColor): PrintContext
    {
        $this->tintColor = $tintColor;

        return $this;
    }
}
