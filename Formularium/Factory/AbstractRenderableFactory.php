<?php declare(strict_types=1);

namespace Formularium\Factory;

/**
 * You cannot override a trait property, so this is a dummy abstract class to allow that on
 * RenderableFactory.
 */
abstract class AbstractRenderableFactory
{
    use NamespaceTrait;
}
