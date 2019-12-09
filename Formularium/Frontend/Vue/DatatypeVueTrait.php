<?php

namespace Formularium\Frontend\Vue;

use Formularium\Field;
use Formularium\HTMLElement;

trait DatatypeVueTrait
{
    abstract protected function _viewable($value, Field $field): HTMLElement;

    abstract protected function _editable($value, Field $field): HTMLElement;

    public function viewable($value, Field $field): string
    {
        return $this->_viewable($value, $field);
    }

    public function editable($value, Field $field): string
    {
        return $this->_editable($value, $field);
    }
}
