<?php

namespace Formularium;

use Formularium\Exception\Exception;
use Formularium\Frontend\HTML\HTMLElement;

class FrameworkComposer
{
    /**
     * @var Framework[]
     */
    protected static $frameworks = [];

    public static function get(): array
    {
        return static::$frameworks;
    }

    public static function set(array $frameworks = [])
    {
        static::$frameworks = [];
        foreach ($frameworks as $f) {
            static::append($f);
        }
    }

    public static function append($framework)
    {
        static::$frameworks[] = ($framework instanceof Framework ? $framework : Framework::factory($framework));
    }

    public static function htmlHead()
    {
        $head = [];
        foreach (static::get() as $framework) {
            $head[] = $framework->htmlHead();
        }
        return join("\n", $head);
    }

    public static function viewable(Model $m)
    {
        $elements = [];
        foreach ($m->getFields() as $field) {
            $values = '';  // TODO: values?
            $html = new HTMLElement('');
            foreach (static::get() as $framework) {
                $r = $framework->getRenderable($field->getDatatype());
                $x = $r->viewable($values, $field, $html);
                $html = $x;
            }
            $elements[$field->getName()] = $html->__toString();
        }
        $output = '';
        foreach (static::get() as $framework) {
            $output = $framework->viewableCompose($m, $elements, $output);
        }
        return $output;
    }

    public static function editable(Model $m)
    {
        $data = [];
        foreach ($m->getFields() as $field) {
            $values = '';  // TODO: values?
            $html = new HTMLElement('');
            foreach (static::get() as $framework) {
                $r = $framework->getRenderable($field->getDatatype());
                $html = $r->editable($values, $field, $html);
            }
            $elements[$field->getName()] = $html->__toString();
        }
        $output = '';
        foreach (static::get() as $framework) {
            $output = $framework->editableCompose($m, $elements, $output);
        }
        return $output;
    }
}
