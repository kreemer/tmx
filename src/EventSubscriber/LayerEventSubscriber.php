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
use Tmx\Layer;
use Tmx\Map;

class LayerEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return array(
            array(
                'event' => 'serializer.post_deserialize',
                'method' => 'onPostDeserialize',
                'class' => 'Tmx\\Layer',
                'format' => 'xml',
            ),
        );
    }

    public function onPostDeserialize(ObjectEvent $event): void
    {
        if (!$event->getObject() instanceof Layer) {
            return;
        }
        /** @var Layer $layer */
        $layer = $event->getObject();
        $layer->getLayerData()->setLayer($layer);
    }
}