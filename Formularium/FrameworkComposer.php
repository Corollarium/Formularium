<?php

namespace Formularium;

use Formularium\HTMLElement;

class FrameworkComposer
{
    /**
     * @var Framework[]
     */
    protected static $frameworks = [];

    /**
     *
     * @return Framework[]
     */
    public static function get(): array
    {
        return static::$frameworks;
    }

    /**
     * @param Framework[] $frameworks
     */
    public static function set(array $frameworks = [])
    {
        static::$frameworks = [];
        foreach ($frameworks as $f) {
            static::append($f);
        }
        return __CLASS__;
    }

    /**
     * Appends a framework to the queue
     *
     * @param string|Framework $framework
     */
    public static function append($framework)
    {
        static::$frameworks[] = ($framework instanceof Framework ? $framework : Framework::factory($framework));
        return __CLASS__;
    }

    /**
     * Returns the html <head> contents for all frameworks.
     *
     * @return string
     */
    public static function htmlHead(): string
    {
        $head = [];
        foreach (static::get() as $framework) {
            $head[] = $framework->htmlHead();
        }
        return join("\n", $head);
    }

    public static function htmlFooter(): string
    {
        $head = [];
        foreach (static::get() as $framework) {
            $head[] = $framework->htmlFooter();
        }
        return join("\n", $head);
    }

    /**
     * Renders a Model with the loaded frameworks.
     *
     * @param Model $m
     * @return string
     */
    public static function viewable(Model $m): string
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
            $elements[$field->getName()] = $html;
        }
        $output = '';
        foreach (static::get() as $framework) {
            $output = $framework->viewableCompose($m, $elements, $output);
        }
        return $output;
    }

    public static function editable(Model $m): string
    {
        $elements = [];
        foreach ($m->getFields() as $field) {
            $values = '';  // TODO: values?
            $html = new HTMLElement('');
            foreach (static::get() as $framework) {
                $r = $framework->getRenderable($field->getDatatype());
                $html = $r->editable($values, $field, $html);
            }
            $elements[$field->getName()] = $html;
        }
        $output = '';
        foreach (static::get() as $framework) {
            $output = $framework->editableCompose($m, $elements, $output);
        }
        return $output;
    }
}
