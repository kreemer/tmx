<?php
/*
 * This file is part of the Tmx package.
 * (c) kreemer <kreemer@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tmx\EventSubscriber;


use JMS\Serializer\EventDispatcher\Event;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use Tmx\Map;

class MapEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return array(
            array(
                'event' => 'serializer.post_deserialize',
                'method' => 'onPostDeserialize',
                'class' => 'Tmx\\Map',
                'format' => 'xml',
            ),
        );
    }

    public function onPostDeserialize(ObjectEvent $event): void
    {
        if (!$event->getObject() instanceof Map) {
            return;
        }
        /** @var Map $map */
        $map = $event->getObject();
        foreach ($map->getLayers() as $layer) {
            $layer->setMap($map);
        }
    }
}