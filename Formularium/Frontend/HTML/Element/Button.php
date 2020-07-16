<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Button extends Element
{
    const COLOR = 'color';
    const COLOR_PRIMARY = 'primary';
    const COLOR_LINK = 'link';
    const COLOR_INFO = 'info';
    const COLOR_SUCCESS = 'success';
    const COLOR_WARNING = 'warning';
    const COLOR_ERROR = 'error';
    
    const TYPE = 'type';

    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $node = new HTMLNode('button');

        $node->setAttributes([
            'type' => $parameters[self::TYPE] ?? 'button',
            'class' => '',
        ]);

        $node->setContent($parameters[self::LABEL] ?? '');

        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($parameters[$v] ?? false) {
                $node->setAttribute($v, $v);
            }
        }

        return $node;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Button',
            'Creates a button',
            [
                new MetadataParameter(
                    static::TYPE,
                    'string',
                    'Button type, like "submit", "reset" or "button" . Default: "button"'
                ),
                new MetadataParameter(
                    static::READONLY,
                    'boolean',
                    'Is it readonly?'
                ),
                new MetadataParameter(
                    static::DISABLED,
                    'boolean',
                    'Is it disabled?'
                )
            ]
        );
    }
}
