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
use JMS\Serializer\EventDispatcher\ObjectEvent;
use Tmx\TileSet;

class TileSetEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            [
                'event' => 'serializer.post_deserialize',
                'method' => 'onPostDeserialize',
                'class' => 'Tmx\\TileSet',
                'format' => 'xml',
            ],
        ];
    }

    public function onPostDeserialize(ObjectEvent $event): void
    {
        if (!$event->getObject() instanceof TileSet) {
            return;
        }

        if ($event->getContext()->hasAttribute('tileSet')) {
            $oldTileSet = $event->getContext()->getAttribute('tileSet');

            /** @var TileSet $tileSet */
            $tileSet = $event->getObject();

            $tileSet->setFirstGid($oldTileSet->getFirstGid());
            $tileSet->setSource($oldTileSet->getSource());
        }
    }
}
