<?php declare(strict_types=1);

namespace Formularium\Frontend\Vuetify\Element;

use Formularium\Element;
use Formularium\Exception\Exception;
use Formularium\HTMLNode;
use Formularium\Frontend\HTML\Element\Button as HTMLButton;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Button extends VuetifyElement
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $previous->setTag('v-btn');

        $this->color($parameters, $previous);

        $size = $parameters[self::SIZE] ?? '';
        switch ($size) {
            case self::SIZE_LARGE:
                $previous->addAttribute('large');
                break;
            case self::SIZE_SMALL:
                $previous->addAttribute('small');
                break;
        }

        if ($parameters[self::ICON] ?? '') {
            $previous->addContent('<v-icon>' . $parameters[self::ICON] . '</v-icon>');
        }

        return $previous;
    }

    public static function getMetadata(): Metadata
    {
        $metadata = HTMLButton::getMetadata();
        $metadata->appendParameter(
            new MetadataParameter(
                HTMLButton::COLOR,
                'string',
                'Button color. Supports all vuetify colors. Default: primary.'
            )
        );
        return $metadata;
    }
}
