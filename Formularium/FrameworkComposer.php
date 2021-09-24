<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Factory\FrameworkFactory;
use Formularium\HTMLNode;

class FrameworkComposer
{
    /**
     * @var Framework[]
     */
    protected $frameworks = [];

    /**
     *
     * @var HTMLNode[]
     */
    protected $headerElements = [];

    /**
     *
     * @var HTMLNode[]
     */
    protected $footerElements = [];

    /**
     * @param Framework[]|string[] $frameworks
     */
    public function __construct(array $frameworks = [])
    {
        $this->setFrameworks($frameworks);
    }

    /**
     * @param Framework[]|string[] $frameworks
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
     * @param Framework[]|string[] $frameworks
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
        $this->frameworks[] = ($framework instanceof Framework ? $framework : FrameworkFactory::factory($framework));
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

    /**
     * Renders an element
     *
     * @param string $elementName
     * @param array $parameters
     * @return HTMLNode The element HTMLNode
     */
    public function nodeElement(string $elementName, array $parameters = []): HTMLNode
    {
        $node = new HTMLNode('');
        $found = false;
        foreach ($this->getFrameworks() as $framework) {
            try {
                $element = $framework->getElement($elementName, $this);
                $found = true;
                $node = $element->render($parameters, $node);
            } catch (ClassNotFoundException $e) {
                continue; // element default
            }
        }
        if (!$found) {
            throw new ClassNotFoundException("Element $elementName not found");
        }
        return $node;
    }

    /**
     * Renders an element to a string
     *
     * @param string $elementName
     * @param array $parameters
     * @return string The rendered HTML
     */
    public function element(string $elementName, array $parameters = []): string
    {
        return $this->nodeElement($elementName, $parameters)->getRenderHTML();
    }

    /**
     * Renders a Model with the loaded frameworks.
     *
     * @param Model $m
     * @param array $modelData Actual data for the fields to render. Can be empty.
     * @return HTMLNode[]
     */
    public function viewableNodes(Model $m, array $modelData): array
    {
        $elements = [];
        foreach ($m->getFields() as $field) {
            $value = $modelData[$field->getName()] ?? $field->getDataType()->getDefault(); // TODO: values?
            $html = new HTMLNode('');
            foreach ($this->getFrameworks() as $framework) {
                try {
                    $r = $framework->getRenderable($field->getDatatype(), $this);
                    $html = $r->viewable($value, $field, $html);
                } catch (ClassNotFoundException $e) {
                    continue; // renderable default
                }
            }
            $elements[$field->getName()] = $html;
        }
        return $elements;
    }

    /**
     * Renders a Model with the loaded frameworks.
     *
     * @param Model $m
     * @param array $modelData Actual data for the fields to render. Can be empty.
     * @return string
     */
    public function viewable(Model $m, array $modelData): string
    {
        $elements = array_merge(
            $this->headerElements,
            $this->viewableNodes($m, $modelData),
            $this->footerElements
        );
        $output = '';
        foreach ($this->getFrameworks() as $framework) {
            $output = $framework->viewableCompose($m, $elements, $output, $this);
        }
        return $output;
    }

    /**
     * Renders a Model as an editable form with the loaded frameworks.
     *
     * @param Model $m
     * @param array $modelData Actual data for the fields to render. Can be empty.
     * @return HTMLNode[]
     */
    public function editableNodes(Model $m, array $modelData): array
    {
        $elements = [];
        foreach ($m->getFields() as $field) {
            $value = $modelData[$field->getName()] ?? $field->getDataType()->getDefault(); // TODO: values?
            $html = new HTMLNode('');
            foreach ($this->getFrameworks() as $framework) {
                try {
                    $r = $framework->getRenderable($field->getDatatype(), $this);
                    $html = $r->editable($value, $field, $html);
                } catch (ClassNotFoundException $e) {
                    continue; // renderable default
                }
            }
            $elements[$field->getName()] = $html;
        }
        return $elements;
    }

    /**
     * Renders a Model as an editable form with the loaded frameworks.
     *
     * @param Model $m
     * @param array $modelData Actual data for the fields to render. Can be empty.
     * @return string
     */
    public function editable(Model $m, array $modelData): string
    {
        $elements = array_merge(
            $this->headerElements,
            $this->editableNodes($m, $modelData),
            $this->footerElements
        );

        $output = '';

        foreach ($this->getFrameworks() as $framework) {
            $output = $framework->editableCompose($m, $elements, $output, $this);
        }
        return $output;
    }

    /**
     * Get the value of footerElements
     * @return HTMLNode[]
     */
    public function getFooterElements(): array
    {
        return $this->footerElements;
    }

    /**
     * Set the value of footerElements
     *
     * @param HTMLNode[] $footerElements
     * @return  self
     */
    public function setFooterElements(array $footerElements): self
    {
        $this->footerElements = $footerElements;

        return $this;
    }

    /**
     * Appends an element to the footer
     *
     * @return self
     */
    public function appendFooterElement(HTMLNode $node): self
    {
        $this->footerElements[] = $node;
        return $this;
    }

    /**
     * Get the value of headerElements
     * @return HTMLNode[]
     */
    public function getHeaderElements(): array
    {
        return $this->headerElements;
    }

    /**
     * Set the value of headerElements
     *
     * @param HTMLNode[] $headerElements
     * @return  self
     */
    public function setHeaderElements(array $headerElements)
    {
        $this->headerElements = $headerElements;

        return $this;
    }

    /**
     * Appends an element to the footer
     *
     * @return self
     */
    public function appendHeaderElement(HTMLNode $node): self
    {
        $this->headerElements[] = $node;
        return $this;
    }
}
