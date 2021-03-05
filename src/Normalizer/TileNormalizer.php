<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\Normalizer;

use Symfony\Component\Serializer\Encoder\NormalizationAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Tmx\Animation;
use Tmx\Tile;

class TileNormalizer implements NormalizerInterface, DenormalizerInterface, NormalizationAwareInterface, DenormalizerAwareInterface
{
    use NormalizerAwareTrait;
    use DenormalizerAwareTrait;

    public function normalize($object, string $format = null, array $context = []): array
    {
        /* @var Tile $object */
        return [
            'id' => $this->normalizer->normalize($object->getId(), $format, $context),
            'type' => $this->normalizer->normalize($object->getType(), $format, $context),
            'probability' => $this->normalizer->normalize($object->getProbability(), $format, $context),
            'animation' => $this->normalizer->normalize($object->getAnimation(), $format, $context),
            'terrain' => implode(
                ',', [
                    $object->getTopLeftTerrainId(),
                    $object->getTopRightTerrainId(),
                    $object->getBottomLeftTerrainId(),
                    $object->getBottomRightTerrainId(),
                ]
            ),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Tile;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $tile = new Tile();
        $tile->setId($data['@id'] ?? null)
            ->setProbability($data['@probability'] ?? 1.0)
            ->setType($data['@type'] ?? null)
            ->setAnimation(isset($data['animation']) ? $this->denormalizer->denormalize($data['animation'], Animation::class, $format, $context) : null);

        if (isset($data['@terrain'])) {
            $terrainIdList = explode(',', $data['@terrain']);

            if (4 === count($terrainIdList)) {
                $tile->setTopLeftTerrainId(is_numeric($terrainIdList[0]) ? intval($terrainIdList[0]) : null)
                    ->setTopRightTerrainId(is_numeric($terrainIdList[1]) ? intval($terrainIdList[1]) : null)
                    ->setBottomLeftTerrainId(is_numeric($terrainIdList[2]) ? intval($terrainIdList[2]) : null)
                    ->setBottomRightTerrainId(is_numeric($terrainIdList[3]) ? intval($terrainIdList[3]) : null);
            }
        }

        return $tile;
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return Tile::class === $type;
    }
}
