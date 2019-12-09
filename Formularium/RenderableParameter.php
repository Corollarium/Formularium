<?php

namespace Formularium;

interface RenderableParameter
{
    const COMMENT = 'comment'; // a comment to be printed
    const DEFAULTVALUE = 'default'; // a default value (filled only if the thing does not exist)
    const DISABLED = 'disabled'; // render, but make it disabled
    const HIDDEN = 'hidden'; // render, but make it hidden
    const LABEL = 'label'; // the label if you want to change it.
    // const MAX_VALUE = 'maxvalue';
    // const MAX_LENGTH = 'maxlength';
    // const MIN_VALUE = 'minvalue';
    // const MIN_LENGTH = 'minlength';
    const NAME = 'name'; // overrides the html "name" attribute. If you want to do something really special with this data
    const PLACEHOLDER = 'placeholder'; // used to fill html's placeholder field
    const READONLY = 'readonly';
    const REQUIRED = 'required'; // must be filled
    const UNIQUE = 'unique'; // must be a unique value in database (no other value can be equal)
}
