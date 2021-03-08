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

class LayerDataReader
{
    /**
     * @var array<DataParserInterface>
     */
    private $parsers;

    /**
     * @var array<CompressionInterface>
     */
    private $compressions;

    public function __construct(array $parsers, array $compressions)
    {
        $this->parsers = $parsers;
        $this->compressions = $compressions;
    }

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
