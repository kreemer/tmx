<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class LayerData
{
    private ?string $encoding;

    private string $data;

    public function getEncoding(): ?string
    {
        return $this->encoding;
    }

    public function setEncoding(?string $encoding): LayerData
    {
        $this->encoding = $encoding;

        return $this;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): LayerData
    {
        $this->data = $data;

        return $this;
    }

    public function getDataMap(): array
    {
        $returnArray = [];
        if ('csv' == $this->getEncoding()) {
            $lines = explode(PHP_EOL, $this->getData());
            foreach ($lines as $key => $line) {
                if (empty($line)) {
                    continue;
                }
                $lineData = preg_split('@,@', $line, 0, PREG_SPLIT_NO_EMPTY);
                $returnArray[] = $lineData;
            }
        }

        return $returnArray;
    }
}
