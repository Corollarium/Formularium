<?php

namespace Formularium;

use Formularium\Exception\Exception;
use Formularium\Frontend\HTML\HTMLElement;

abstract class Framework
{
    /**
     * @var string
     */
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function factory(string $framework = ''): Framework
    {
        $class = "\\Formularium\\Frontend\\$framework\\Framework";
        if (!class_exists($class)) {
            throw new Exception("Invalid framework $framework");
        }
        return new $class();
    }

    public function getRenderable(Datatype $datatype): Renderable
    {
        return Renderable::factory($datatype, $this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns a string with the <head> HTML to generate standalone files.
     * This is used by the kitchensink generator.
     *
     * @return string
     */
    public function htmlHead(): string
    {
        return '';
    }

    /**
     * @param Model $m
     * @param HTMLElement[] $elements
     * @param string $previousCompose
     * @return string
     */
    public function editableCompose(Model $m, array $elements, string $previousCompose): string
    {
        return $previousCompose;
    }

    /**
     * @param Model $m
     * @param HTMLElement[] $elements
     * @param string $previousCompose
     * @return string
     */
    public function viewableCompose(Model $m, array $elements, string $previousCompose): string
    {
        return $previousCompose;
    }
}
