<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx;

/**
 * Represents the data of a layer.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#data Documentation
 */
class LayerData implements DataInterface
{
    /**
     * The encoding used to encode the tile layer data.
     *
     * @see LayerData::getEncoding()
     * @see LayerData::setEncoding()
     */
    private ?string $encoding = null;

    /**
     * The compression used to compress the tile layer data.
     *
     * @see LayerData::getCompression()
     * @see LayerData::setCompression()
     */
    private ?string $compression = null;

    /**
     * The actual data of this data layer.
     *
     * @see LayerData::getData()
     * @see LayerData::setData()
     */
    private ?string $data = null;

    /**
     * If map is infinite, this holds all the chunks of the layer.
     *
     * @var Chunk[]
     *
     * @see LayerData::getChunks()
     * @see LayerData::addChunk()
     * @see LayerData::removeChunk()
     */
    private array $chunks = [];

    /**
     * To which layer does this data layer belong.
     *
     * @see LayerData::getLayer()
     * @see LayerData::setLayer()
     */
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
