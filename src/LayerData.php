<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

class LayerData implements DataInterface
{
    private ?string $encoding = null;
    private ?string $compression = null;

    private ?string $data = null;

    private array $chunks = [];
    private ?Layer $layer;

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

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): LayerData
    {
        $this->data = $data;

        return $this;
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

    /**
     * @return array<Chunk>
     */
    public function getChunks(): array
    {
        return $this->chunks;
    }

    public function addChunk(Chunk $chunk): self
    {
        $this->chunks[] = $chunk;

        return $this;
    }

    public function removeChunk(Chunk $chunk): self
    {
        if (in_array($chunk, $this->chunks)) {
            $this->chunks = array_diff($this->chunks, [$chunk]);
        }

        return $this;
    }
}
