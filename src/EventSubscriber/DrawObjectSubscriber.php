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

class DrawObjectSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            [
                'event' => 'serializer.pre_deserialize',
                'method' => 'onPreDeserialize',
                'class' => 'Tmx\\DrawObject',
                'format' => 'xml',
            ],
        ];
    }

    public function onPreDeserialize(PreDeserializeEvent $event): void
    {
        /** @var \SimpleXMLElement $data */
        $data = $event->getData();

        $type = $this->enumerateDrawObjectType($data);
        $data->addAttribute('objecttype', $type);
        switch ($type) {
            case 'polygon':
            case 'polyline':
                $data->addAttribute('polypoints', $data->children()[0]->attributes()['points']);
                break;
            case 'text':
                $data->addAttribute('text', (string) $data->children()[0]);
                break;
        }
    }

    private function enumerateDrawObjectType(\SimpleXMLElement $element): string
    {
        if (1 === $element->children()->count()) {
            $name = $element->children()[0]->getName();
            switch ($name) {
                case 'ellipse':
                    return 'ellipse';
                case 'point':
                    return 'point';
                case 'polygon':
                    return 'polygon';
                case 'polyline':
                    return 'polyline';
                case 'text':
                    return 'text';
            }
        }

        return 'rectangle';
    }
}
