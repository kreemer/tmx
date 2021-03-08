<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Service\LayerData;

use Tmx\DataInterface;
use Tmx\LayerData;
use Tmx\Service\ReaderException;

class Base64DataParser implements DataParserInterface
{
    public function getData(DataInterface $dataInterface): string
    {
        return base64_decode($dataInterface->getData());
    }

    public function postCompress(string $data, int $width = null, int $height = null): array
    {
        $returnArray = [];
        if (null === $width && null === $height) {
            throw new ReaderException('Could not extract map from layerData');
        }
        $dump = unpack('V' . $width * $height . 'int', $data);
        $lineArray = [];
        $i = 0;
        foreach ($dump as $value) {
            $lineArray[] = $value;
            ++$i;
            if ($i == $width) {
                $returnArray[] = $lineArray;
                $lineArray = [];
                $i = 0;
            }
        }

        return $returnArray;
    }

    public function isResponsible(LayerData $layerData): bool
    {
        return 'base64' === $layerData->getEncoding();
    }
}
