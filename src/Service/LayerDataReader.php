<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service;

use RuntimeException;
use Tmx\LayerData;
use Tmx\Service\LayerData\CompressionInterface;
use Tmx\Service\LayerData\DataParserInterface;

/**
 * Service class for reading the encoded and/or compressed data.
 *
 * This service class provides methods, to parse encoded and / or compressed layer data.
 *
 * @see https://doc.mapeditor.org/en/stable/reference/tmx-map-format/#data Documentation
 */
class LayerDataReader
{
    /**
     * All DataParserInterface objects, which can be used by this reader.
     *
     * @var DataParserInterface[]
     */
    private array $parsers = [];

    /**
     * All the compression algorithms, which can be used by this reader.
     *
     * @var CompressionInterface[]
     */
    private array $compressions = [];

    /**
     * LayerDataReader constructor.
     *
     * @param array $parsers      List of {@see DataParserInterface} which can be used to read the data
     * @param array $compressions List of {@see CompressionInterface} which can be used to decompress the data
     */
    public function __construct(array $parsers, array $compressions)
    {
        $this->parsers = $parsers;
        $this->compressions = $compressions;
    }

    /**
     * Method reads an encoded and / or compressed layer data.
     *
     * This method reads the encoded and / or compressed layer data and returns it as 2 dimensional array,
     * where the first dimension represents the tile in the x axis and the second dimension is the tile in
     * the y axis.
     *
     * @param LayerData $layerData The layer data which should be read
     *
     * @throws RuntimeException
     * @throws ReaderException
     */
    public function readLayerData(LayerData $layerData): array
    {
        if (null === $layerData->getLayer() || null === $layerData->getLayer()->getMap()) {
            throw new RuntimeException('Could not extract map from layerData');
        }

        $parser = $this->getResponsibleParser($layerData);
        $compression = $this->getResponsibleCompression($layerData);

        if (null === $parser) {
            throw new ReaderException('Could not find parser for LayerData');
        }

        if (null === $compression) {
            throw new ReaderException('Could not find compression for LayerData');
        }

        if (!$layerData->getLayer()->getMap()->isInfiniteMap()) {
            $parsedData = $parser->getData($layerData);
            $uncompressed = $compression->unpackData($parsedData);

            return $parser->postCompress(
                $uncompressed,
                $layerData->getLayer()->getMap()->getWidth(),
                $layerData->getLayer()->getMap()->getHeight()
            );
        }

        $returnArray = [];

        $width = MapService::getCalculatedWidth($layerData->getLayer()->getMap());
        $height = MapService::getCalculatedHeight($layerData->getLayer()->getMap());

        for ($i = 0; $i < $height; ++$i) {
            for ($u = 0; $u < $width; ++$u) {
                $returnArray[$i][$u] = 0;
            }
        }

        $offsetX = MapService::getInfiniteMapOffsetX($layerData->getLayer()->getMap());
        $offsetY = MapService::getInfiniteMapOffsetY($layerData->getLayer()->getMap());
        foreach ($layerData->getChunks() as $chunk) {
            $parsedData = $parser->getData($chunk);
            $uncompressed = $compression->unpackData($parsedData);

            $array = $parser->postCompress(
                $uncompressed,
                $chunk->getWidth(),
                $chunk->getHeight()
            );

            foreach ($array as $lineNumber => $line) {
                foreach ($line as $columnNumber => $value) {
                    $returnArray[$chunk->getY() + $lineNumber + $offsetY][$chunk->getX() + $columnNumber + $offsetX] = $value;
                }
            }
        }

        return $returnArray;
    }

    private function getResponsibleParser($layerData): ?DataParserInterface
    {
        $responsibleParser = null;
        foreach ($this->parsers as $parser) {
            if (!$parser->isResponsible($layerData)) {
                continue;
            }
            $responsibleParser = $parser;
        }

        return $responsibleParser;
    }

    private function getResponsibleCompression($layerData): ?CompressionInterface
    {
        $responsibleCompression = null;
        foreach ($this->compressions as $compression) {
            if (!$compression->isResponsible($layerData)) {
                continue;
            }
            $responsibleCompression = $compression;
        }

        return $responsibleCompression;
    }
}
