<?php declare(strict_types=1);

namespace Formularium\Frontend\Bootstrap\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\Frontend\HTML\Element\Card as HTMLCard;

class Card extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $base = HTMLNode::factory(
            'div',
            [
                'class' => 'formularium-card card'
            ]
        );

        if ($parameters[HTMLCard::IMAGE] ?? false) {
            $image = HTMLNode::factory(
                'img',
                [
                    'class' => 'card-img-top',
                    'src' => $parameters[HTMLCard::IMAGE],
                    'alt' => '' // TODO
                ]
            );
            $base->appendContent($image);
        }

        $body = HTMLNode::factory(
            'div',
            [
                'class' => 'card-body'
            ]
        );
        $base->appendContent($body);

        // title
        if ($parameters[HTMLCard::TITLE] ?? false) {
            $titleData = null;
            if ($parameters[HTMLCard::LINK] ?? false) {
                $titleData = HTMLNode::factory(
                    'a',
                    [ 'href' => $parameters[HTMLCard::LINK] ],
                    $parameters[HTMLCard::TITLE]
                );
            } else {
                $titleData = $parameters[HTMLCard::TITLE];
            }
            $title = HTMLNode::factory(
                'h5',
                [
                    'class' => 'card-title'
                ],
                $titleData
            );
            $body->appendContent($title);
        }

        if ($parameters[HTMLCard::CONTENT] ?? false) {
            $content = HTMLNode::factory(
                'div',
                [
                    'class' => 'card-text'
                ],
                $parameters[HTMLCard::CONTENT]
            );
            $body->appendContent($content);
        }
        return $base;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLCard::getMetadata();
        return $metadata;
    }
}
