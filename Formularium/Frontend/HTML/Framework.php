<?php

namespace Formularium\Frontend\HTML;

class Framework extends \Formularium\Framework
{
    protected static $viewableContainerTag = 'div';
    protected static $editableContainerTag = 'div';

    public function __construct(string $name = 'HTML')
    {
        parent::__construct($name);
    }

    public static function getViewableContainerTag(): string
    {
        return static::$viewableContainerTag;
    }
    
    /**
     * @param string $tag
     * @return void
     */
    public static function setViewableContainerTag(string $tag)
    {
        static::$viewableContainerTag = $tag;
    }

    public static function getEditableContainerTag(): string
    {
        return static::$editableContainerTag;
    }
    
    /**
     * @param string $tag
     * @return void
     */
    public static function setEditableContainerTag(string $tag)
    {
        static::$editableContainerTag = $tag;
    }

    /**
     * Static counter to generate unique ids.
     *
     * @return integer
     */
    public static function counter(): int
    {
        static $counter = 0;
        return $counter++;
    }

    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return join('', array_map(function ($e) {
            return $e->__toString();
        }, $elements));
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return join('', array_map(function ($e) {
            return $e->__toString();
        }, $elements));
    }
}
