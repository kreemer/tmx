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
    private ?string $compression;

    private string $data;

    private ?Layer $layer;

    public function __construct(string $data, string $encoding = null, string $compression = null)
    {
        $this->data = $data;
        $this->encoding = $encoding;
        $this->compression = $compression;
    }

    public function getEncoding(): ?string
    {
        return $this->encoding;
    }

    public function setEncoding(?string $encoding): LayerData
    {
        $this->encoding = $encoding;

        return $this;
    }

    public function getCompression(): ?string
    {
        return $this->compression;
    }

    public function setCompression(?string $compression): LayerData
    {
        $this->compression = $compression;

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
        if ('csv' == $this->getEncoding()) {
            $returnArray = $this->getDataFromCsv();
        } elseif ('base64' == $this->getEncoding()) {
            $returnArray = $this->getDataFromBase64();
        } else {
            throw new \RuntimeException('Unsupported encoding');
        }

        return $returnArray;
    }

    private function getDataFromCsv(): array
    {
        $returnArray = [];

        $lines = explode(PHP_EOL, $this->getData());
        foreach ($lines as $key => $line) {
            if (empty($line)) {
                continue;
            }
            $lineData = preg_split('@,@', $line, 0, PREG_SPLIT_NO_EMPTY);
            $returnArray[] = $lineData;
        }

        return $returnArray;
    }

    private function getUncompressedData(): string
    {
        $data = base64_decode($this->getData());
        switch ($this->getCompression()) {
            case 'zlib':
                if (!function_exists('zlib_decode')) {
                    throw new \RuntimeException('ext-zlib has to be enabled to parse zlib compression');
                }
                return zlib_decode($data);

                // no break
            case 'zstd':
                if (!function_exists('zstd_uncompress')) {
                    throw new \RuntimeException('ext-zstd has to be enabled to parse zlib compression');
                }
                return zstd_uncompress($data);
        }

        return $data;
    }

    private function getDataFromBase64(): array
    {
        $returnArray = [];
        if (null === $this->getLayer() || null === $this->getLayer()->getMap()) {
            throw new \RuntimeException('Could not aklsjdf');
        }
        $amountTiles = $this->getLayer()->getMap()->getWidth() * $this->layer->getMap()->getHeight();

        $data = $this->getUncompressedData();

        $dump = unpack('V' . $amountTiles . 'int', $data);

        $lineArray = [];
        $i = 0;
        foreach ($dump as $value) {
            $lineArray[] = $value;

            ++$i;
            if ($i == $this->getLayer()->getMap()->getWidth()) {
                $returnArray[] = $lineArray;
                $lineArray = [];
                $i = 0;
            }
        }

        return $returnArray;
    }

    public function getLayer(): ?Layer
    {
        return $this->layer;
    }

    public function setLayer(?Layer $layer): LayerData
    {
        $this->layer = $layer;

        return $this;
    }
}
