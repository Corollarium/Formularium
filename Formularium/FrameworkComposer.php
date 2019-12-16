<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
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
     * @return void
     */
    public static function set(array $frameworks = [])
    {
        static::$frameworks = [];
        foreach ($frameworks as $f) {
            static::append($f);
        }
    }

    /**
     * Appends a framework to the queue
     *
     * @param string|Framework $framework
     * @return void
     */
    public static function append($framework)
    {
        static::$frameworks[] = ($framework instanceof Framework ? $framework : Framework::factory($framework));
    }

    /**
     * Returns the html <head> contents for all frameworks.
     *
     * @return string
     */
    public static function htmlHead(): string
    {
        $head = new HTMLElement('');
        foreach (static::get() as $framework) {
            $framework->htmlHead($head);
        }
        return $head->getRenderHTML();
    }

    public static function htmlFooter(): string
    {
        $footer = new HTMLElement('');
        foreach (static::get() as $framework) {
            $framework->htmlFooter($footer);
        }
        return $footer->getRenderHTML();
    }

    /**
     * Renders a Model with the loaded frameworks.
     *
     * @param Model $m
     * @return string
     */
    public static function viewable(Model $m, array $modelData): string
    {
        $elements = [];
        foreach ($m->getFields() as $field) {
            $value = $modelData[$field->getName()] ?? $field->getDataType()->getDefault(); // TODO: values?
            $html = new HTMLElement('');
            foreach (static::get() as $framework) {
                try {
                    $r = $framework->getRenderable($field->getDatatype());
                    $x = $r->viewable($value, $field, $html);
                    $html = $x;
                } catch (ClassNotFoundException $e) {
                    continue; // renderable default
                }
            }
            $elements[$field->getName()] = $html;
        }
        $output = '';
        foreach (static::get() as $framework) {
            $output = $framework->viewableCompose($m, $elements, $output);
        }
        return $output;
    }

    public static function editable(Model $m, array $modelData): string
    {
        $elements = [];
        foreach ($m->getFields() as $field) {
            $value = $modelData[$field->getName()] ?? $field->getDataType()->getDefault(); // TODO: values?
            $html = new HTMLElement('');
            foreach (static::get() as $framework) {
                try {
                    $r = $framework->getRenderable($field->getDatatype());
                    $html = $r->editable($value, $field, $html);
                } catch (ClassNotFoundException $e) {
                    continue; // renderable default
                }
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
