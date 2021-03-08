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
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use Tmx\GroupContainer;
use Tmx\Map;

class MapEventSubscriber implements EventSubscriberInterface
{
    private int $layerOrder = 0;

    public static function getSubscribedEvents(): array
    {
        return [
            [
                'event' => 'serializer.pre_deserialize',
                'method' => 'onPreDeserialize',
                'class' => 'Tmx\\Map',
                'format' => 'xml',
            ],
            [
                'event' => 'serializer.post_deserialize',
                'method' => 'onPostDeserialize',
                'class' => 'Tmx\\Map',
                'format' => 'xml',
            ],
        ];
    }

    public function onPreDeserialize(PreDeserializeEvent $event): void
    {
        /** @var \SimpleXMLElement $data */
        $data = $event->getData();

        foreach ($data->children() as $child) {
            $this->searchLayer($child);
        }
    }

    private function searchLayer(\SimpleXMLElement $element): void
    {
        if ('layer' === $element->getName()) {
            $element->addAttribute('order', (string) $this->layerOrder);
            ++$this->layerOrder;
        } elseif ('group' === $element->getName()) {
            foreach ($element->children() as $child) {
                $this->searchLayer($child);
            }
        }
    }

    public function onPostDeserialize(ObjectEvent $event): void
    {
        if (!$event->getObject() instanceof Map) {
            return;
        }
        /** @var Map $map */
        $map = $event->getObject();
        $this->initializeMapWithinGroup($map, $map);
    }

    private function initializeMapWithinGroup(GroupContainer $group, Map $map)
    {
        foreach ($group->getLayers() as $layer) {
            $layer->setMap($map);
        }
        foreach ($group->getGroups() as $group) {
            $this->initializeMapWithinGroup($group, $map);
        }
    }
}
