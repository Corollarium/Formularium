<?php declare(strict_types=1);

namespace Formularium;

/**
 * Abstract base class for frameworks. Each framework should have a class inheriting
 * from this class.
 */
class Formularium
{
    /**
     * Returns a list of datatype class names
     *
     * @return array
     */
    public static function getDatatypeNames(): array
    {
        $datatypes = array_map(
            function ($x) {
                return str_replace('Datatype_', '', str_replace('.php', '', $x));
            },
            array_diff(scandir(__DIR__ . '/Datatype/'), array('.', '..'))
        );
    
        // TODO: avoid abstract classes
        $datatypes = array_filter(
            $datatypes,
            function ($t) {
                return ($t !== 'number' && $t !== 'choice' && $t !== 'association');
            }
        );

        return $datatypes;
    }

    public static function getDatatypeValidators(array $extraDatatypes = []): array
    {
        $datatypes = self::getDatatypeNames();

        $validators = [];

        foreach ($datatypes as $name) {
            $datatype = Datatype::factory($name);
            $validators = array_merge($validators, $datatype->getValidatorMetadata());
        }
        foreach ($extraDatatypes as $name) {
            $datatype = Datatype::factory($name);
            $validators = array_merge($validators, $datatype->getValidatorMetadata());
        }
        return $validators;
    }

    public static function graphqlDirectives(array $extraDatatypes = []): string
    {
        $validators = static::getDatatypeValidators($extraDatatypes);

        foreach ($validators as $name => $v) {
            $args = array_map(
                function ($a) {
                    return <<<EOF
    """
    {$a['comment']}
    """
    {$a['name']}: {$a['type']}

EOF;
                },
                $v['args']
            );

            $argString = '';
            if ($args) {
                $argString = "(\n" . join("\n", $args) . ')';
            }
            $graphql[$name] = <<< EOF
"""
{$v['comment']}
"""
directive @{$name}{$argString} on FIELD_DEFINITION

EOF;
        }

        unset($graphql['required']); // ! already does this


        return '
# File generated by Formularium.
# Do not edit this file directly.

' . join("\n", $graphql);
    }
}
