<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;
use Formularium\Factory\ElementFactory;
use Formularium\Factory\RenderableFactory;
use Formularium\HTMLNode;
use Nette\PhpGenerator\PhpNamespace;

/**
 * Abstract base class for frameworks. Each framework should have a class inheriting
 * from this class.
 */
abstract class Framework
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Options for rendering
     * @var array
     */
    protected $options = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getRenderable(Datatype $datatype, FrameworkComposer $composer = null): Renderable
    {
        return RenderableFactory::factory($datatype, $this, $composer);
    }

    public function getElement(string $name, FrameworkComposer $composer = null): Element
    {
        return ElementFactory::factory($name, $this, $composer);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    public function getOption(string $name, $value = null)
    {
        return $this->options[$name] ?? $value;
    }

    /**
     *
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function setOption(string $name, $value): self
    {
        $this->options[$name] = $value;
        return $this;
    }

    /**
     * Set a new option
     *
     * @param array $options
     * @return self
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Returns a string with the <head> HTML to generate standalone files.
     * This is used by the kitchensink generator.
     *
     * @param HTMLNode $head
     * @return void
     * @codeCoverageIgnore
     */
    public function htmlHead(HTMLNode &$head)
    {
    }

    /**
     * Returns a string with things to add to the footer of the page (such as scripts)
     * This is used by the kitchensink generator.
     *
     * @param HTMLNode $head
     * @return void
     * @codeCoverageIgnore
     */
    public function htmlFooter(HTMLNode &$head)
    {
    }

    /**
     * @param Model $m
     * @param HTMLNode[] $elements
     * @param string $previousCompose
     * @return string
     */
    public function editableCompose(Model $m, array $elements, string $previousCompose, FrameworkComposer $composer): string
    {
        return $previousCompose;
    }

    /**
     * @param Model $m
     * @param HTMLNode[] $elements
     * @param string $previousCompose
     * @return string
     */
    public function viewableCompose(Model $m, array $elements, string $previousCompose, FrameworkComposer $composer): string
    {
        return $previousCompose;
    }

    /**
     * Generates scaffolding for a new renderable. This can be overriden so frameworks change
     * the default template.
     *
     * @codeCoverageIgnore
     * @param Datatype $datatype The new datatype name.
     * @param string $baseNamespace The namespace for the new file.
     * @return PhpNamespace
     */
    public function generateRenderable(
        Datatype $datatype,
        string $baseNamespace
    ): PhpNamespace {
        $datatypeName = $datatype->getName();
        $frameworkName = $this->getName();

        $baseClass = '\\Formularium\\Renderable';
        $ns = "{$baseNamespace}\\{$frameworkName}\\Renderable";

        $namespace = new PhpNamespace($ns);
        $namespace->addUse('\\Formularium\\Field');
        $namespace->addUse('\\Formularium\\HTMLNode');

        $class = $namespace->addClass("Renderable_${datatypeName}")
            ->setExtends($baseClass);

        $viewable = $class->addMethod('viewable')
            ->setBody("return \$previous;\n")
            ->setReturnType('\\Formularium\\HTMLNode');
        $viewable->addParameter('value');
        $viewable->addParameter('field')->setType('\\Formularium\\Field');
        $viewable->addParameter('previous')->setType('\\Formularium\\HTMLNode');

        $editable = $class->addMethod('editable')
            ->setBody("return \$previous;\n")
            ->setReturnType('\\Formularium\\HTMLNode');
        $editable->addParameter('value');
        $editable->addParameter('field')->setType('\\Formularium\\Field');
        $editable->addParameter('previous')->setType('\\Formularium\\HTMLNode');
        
        return $namespace;
    }
}
