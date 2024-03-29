<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\ValidatorFactory;
use HaydenPierce\ClassFinder\ClassFinder;

/**
 * Abstract base class for frameworks. Each framework should have a class inheriting
 * from this class.
 */
final class Formularium
{
    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
        // empty
    }

    public static function scalarGraphqlDirectives(): string
    {
        $classes = DatatypeFactory::getNames();
        $graphql = [];
        foreach ($classes as $className => $name) {
            $escapedClassName = str_replace("\\", "\\\\", $className);
            $graphql[] = "scalar $name @scalar(class: \"{$escapedClassName}\")";
        }

        return '
# File generated by Formularium.
# Do not edit this file directly.

' . join("\n\n", $graphql);
    }

    public static function validatorGraphqlDirectives(): string
    {
        $classes = ValidatorFactory::getNames();
        $graphql = [];
        foreach ($classes as $className => $name) {
            $graphql[] = $className::getMetadata()->toGraphql();
        }

        return '
# File generated by Formularium.
# Do not edit this file directly.

' . join("\n", $graphql);
    }
}
