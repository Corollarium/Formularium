<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\Exception;
use Formularium\HTMLElement;

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
     * @param HTMLElement $head
     * @return void
     */
    public function htmlHead(HTMLElement &$head)
    {
    }

    /**
     * Returns a string with things to add to the footer of the page (such as scripts)
     * This is used by the kitchensink generator.
     *
     * @param HTMLElement $head
     * @return void
     */
    public function htmlFooter(HTMLElement &$head)
    {
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
