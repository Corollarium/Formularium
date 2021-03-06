<?php declare(strict_types=1);

namespace Formularium;

/**
 * These are parameters passed to Renderable through Field::renderable.
 */
interface RenderableParameter
{
    const COMMENT = 'comment'; // a comment to be printed
    const DEFAULTVALUE = 'default'; // a default value (filled only if the thing does not exist)
    const DISABLED = 'disabled'; // render, but make it disabled
    const HIDDEN = 'hidden'; // render, but make it hidden
    const ICON = 'icon';
    const ICON_PACK = 'icon-pack';
    const LABEL = 'label'; // the label if you want to change it.
    const NAME = 'name'; // overrides the html "name" attribute. If you want to do something really special with this data
    const PLACEHOLDER = 'placeholder'; // used to fill html's placeholder field
    const READONLY = 'readonly';
    const SIZE = 'size';
    const SIZE_LARGE = 'size_large';
    const SIZE_NORMAL = 'size_normal';
    const SIZE_SMALL = 'size_large';
    const TITLE = 'title';
    const VIEWABLE_TAG = 'viewable_tag'; // HTML tag to use (or equivalent in framework). Default is 'span'.
}
