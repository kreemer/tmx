<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\EventSubscriber;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;

class TileEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            [
                'event' => 'serializer.pre_deserialize',
                'method' => 'onPreDeserialize',
                'class' => 'Tmx\\Tile',
                'format' => 'xml',
            ],
        ];
    }

    public function onPreDeserialize(PreDeserializeEvent $event): void
    {
        /** @var \SimpleXMLElement $data */
        $data = $event->getData();
        if (isset($data->attributes()['terrain'])) {
            $terrainIdList = (string) $data->attributes()['terrain'];
            $terrainId = explode(',', $terrainIdList);

            $array = [
                'topLeftTerrainId' => $terrainId[0],
                'topRightTerrainId' => $terrainId[1],
                'bottomLeftTerrainId' => $terrainId[2],
                'bottomRightTerrainId' => $terrainId[3],
            ];
            if (isset($terrainId[0]) && '' !== $terrainId[0]) {
                $data->attributes()->addAttribute('topLeftTerrainId', $terrainId[0]);
            }

            if (isset($terrainId[1]) && '' !== $terrainId[1]) {
                $data->attributes()->addAttribute('topRightTerrainId', $terrainId[1]);
            }

            if (isset($terrainId[2]) && '' !== $terrainId[2]) {
                $data->attributes()->addAttribute('bottomLeftTerrainId', $terrainId[2]);
            }

            if (isset($terrainId[3]) && '' !== $terrainId[3]) {
                $data->attributes()->addAttribute('bottomRightTerrainId', $terrainId[3]);
            }
        }
    }
}
