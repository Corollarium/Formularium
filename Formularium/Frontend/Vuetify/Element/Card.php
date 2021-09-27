<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuetify\Element;

use Formularium\Element;
use Formularium\Frontend\HTML\Element\Card as HTMLCard;
use Formularium\HTMLNode;
use Formularium\Metadata;

class Card extends VuetifyElement
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $atts = [
            'class' => 'formularium-card'
        ];

        $contents = $previous->getContent();

        if ($parameters[HTMLCard::IMAGE] ?? '') {
            $contents[] = new HTMLNode(
                'v-img',
                [
                    'src' => $parameters[HTMLCard::IMAGE] ?? '',
                ]
            );
        }

        if ($parameters[HTMLCard::TITLE] ?? '') {
            $contents[] = new HTMLNode(
                'v-card-title',
                [],
                $parameters[HTMLCard::TITLE] ?? ''
            );
        }

        if ($parameters[HTMLCard::CONTENT] ?? '') {
            $contents[] = new HTMLNode(
                'v-card-text',
                [],
                $parameters[HTMLCard::CONTENT] ?? ''
            );
        }

        return new HTMLNode(
            'v-card',
            $atts,
            $contents
        );
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLCard::getMetadata();
        return $metadata;
    }
}
