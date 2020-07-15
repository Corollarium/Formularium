<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\HTMLNode;

class FrameworkComposer
{
    /**
     * @var Framework[]
     */
    protected $frameworks = [];

    /**
     * @param Framework[] $frameworks
     */
    public function __construct(array $frameworks = [])
    {
        $this->setFrameworks($frameworks);
    }

    /**
     * @param Framework[] $frameworks
     */
    public static function create(array $frameworks = []): FrameworkComposer
    {
        return new self($frameworks);
    }

    /**
     *
     * @return Framework[]
     */
    public function getFrameworks(): array
    {
        return $this->frameworks;
    }

    /**
     *
     * @return Framework|null
     */
    public function getByName(string $name): ?Framework
    {
        foreach ($this->frameworks as $f) {
            if ($f->getName() === $name) {
                return $f;
            }
        }
        return null;
    }

    /**
     * @param Framework[] $frameworks
     * @return void
     */
    public function setFrameworks(array $frameworks = [])
    {
        $this->frameworks = [];
        foreach ($frameworks as $f) {
            $this->append($f);
        }
    }

    /**
     * Appends a framework to the queue
     *
     * @param string|Framework $framework
     * @return void
     */
    public function append($framework)
    {
        $this->frameworks[] = ($framework instanceof Framework ? $framework : Framework::factory($framework));
    }

    /**
     * Returns the html <head> contents for all frameworks.
     *
     * @return string
     */
    public function htmlHead(): string
    {
        $head = new HTMLNode('');
        foreach ($this->getFrameworks() as $framework) {
            $framework->htmlHead($head);
        }
        return $head->getRenderHTML();
    }

    public function htmlFooter(): string
    {
        $footer = new HTMLNode('');
        foreach ($this->getFrameworks() as $framework) {
            $framework->htmlFooter($footer);
        }
        return $footer->getRenderHTML();
    }

    public function element(string $elementName, array $parameters = []): string
    {
        $node = new HTMLNode('');
        foreach ($this->getFrameworks() as $framework) {
            try {
                $element = Element::factory($elementName, $framework);
                $node = $element->render($parameters, $node);
            } catch (ClassNotFoundException $e) {
                continue; // renderable default
            }
        }
        return $node->getRenderHTML();
    }

    /**
     * Renders a Model with the loaded frameworks.
     *
     * @param Model $m
     * @return string
     */
    public function viewable(Model $m, array $modelData): string
    {
        $elements = [];
        foreach ($m->getFields() as $field) {
            $value = $modelData[$field->getName()] ?? $field->getDataType()->getDefault(); // TODO: values?
            $html = new HTMLNode('');
            foreach ($this->getFrameworks() as $framework) {
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
        foreach ($this->getFrameworks() as $framework) {
            $output = $framework->viewableCompose($m, $elements, $output);
        }
        return $output;
    }

    public function editable(Model $m, array $modelData): string
    {
        $elements = [];
        foreach ($m->getFields() as $field) {
            $value = $modelData[$field->getName()] ?? $field->getDataType()->getDefault(); // TODO: values?
            $html = new HTMLNode('');
            foreach ($this->getFrameworks() as $framework) {
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
        foreach ($this->getFrameworks() as $framework) {
            $output = $framework->editableCompose($m, $elements, $output);
        }
        return $output;
    }
}
