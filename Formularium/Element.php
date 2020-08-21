<?php declare(strict_types=1);

namespace Formularium;

use Formularium\HTMLNode;

/**
 * Abstract base classe to render HTML elements such as buttons.
 */
abstract class Element implements RenderableParameter
{
    /**
     * extra attributes added directly to the base element.
     */
    const ATTRIBUTES = 'attributes';

    /**
     * @var Framework
     */
    protected $framework;

    /**
     * @var FrameworkComposer
     */
    protected $composer;

    public function __construct(Framework $framework, FrameworkComposer $composer = null)
    {
        $this->framework = $framework;
        $this->composer = $composer;
    }

    public function getName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    /**
     * Renders a form editable version of this Element
     *
     * @param array $parameters
     * @param HTMLNode $previous
     * @return HTMLNode The HTML rendered.
     */
    abstract public function render(array $parameters, HTMLNode $previous): HTMLNode;

    /**
     * Documents this validator.
     *
     * @return Metadata
     */
    abstract public static function getMetadata(): Metadata;
}
