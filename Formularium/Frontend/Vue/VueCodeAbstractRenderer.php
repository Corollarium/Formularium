<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\HTMLNode;
use Formularium\Model;

abstract class VueCodeAbstractRenderer
{
    /**
     * @var VueCode
     */
    protected $vueCode;

    public function __construct(VueCode $vueCode)
    {
        $this->vueCode = $vueCode;
    }

    /**
     * Generates the javascript code.
     *
     * @param Model $m
     * @param HTMLNode[] $elements
     * @return string
     */
    abstract public function toScript(Model $m, array $elements);

    /**
     * Generates the javascript code.
     *
     * @param Model $m
     * @param HTMLNode[] $elements
     * @return string
     */
    abstract public function toVariable(Model $m, array $elements);

    /**
     * Generates template data for rendering
     *
     * @param Model $m
     * @param HTMLNode[] $elements $elements
     * @return array
     */
    abstract public function getTemplateData(Model $m, array $elements): array;
}
