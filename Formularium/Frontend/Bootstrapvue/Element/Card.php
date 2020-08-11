<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrapvue\Element;

use Formularium\Element;
use Formularium\Frontend\HTML\Element\Card as HTMLCard;
use Formularium\HTMLNode;
use Formularium\Metadata;

class Card extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $atts = [
            'title' => $parameters[HTMLCard::TITLE] ?? '',
            'img-src' => $parameters[HTMLCard::IMAGE] ?? '',
            // img-alt
            'img-top' => true, // TODO: position
            'tag' => 'article',
            'class' => 'formularium-card' // TODO
        ];
        // TODO: link
        return new HTMLNode(
            'b-card',
            $atts,
            new HTMLNode(
                'b-card-text',
                [],
                $parameters[HTMLCard::CONTENT] ?? ''
            )
        );
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLCard::getMetadata();
        return $metadata;
    }
}
