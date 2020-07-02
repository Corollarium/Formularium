<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\ValidatorException;

/**
 * Abstract base classe to validate data in composition to the validation in
 * datatypes.
 */
final class ValidatorMetadata
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $comment;

    /**
     * @var ValidatorArgs[]
     */
    public $args;

    public function __construct(string $name, string $comment, array $args = [])
    {
        $this->name = $name;
        $this->comment = $comment;
        $this->args = $args;
    }

    public function toGraphql(): string
    {
        $args = array_map(
            function (ValidatorArgs $a) {
                return $a->toGraphql();
            },
            $this->args
        );

        $argString = '';
        if ($args) {
            $argString = "(" . join("\n", $args) . "\n)";
        }
        return <<< EOF
"""
{$this->comment}
"""
directive @{$this->name}{$argString} on FIELD_DEFINITION

EOF;
    }

    public function hasArgument(string $name): bool
    {
        foreach ($this->args as $a) {
            if ($a->name === $name) {
                return true;
            }
        }
        return false;
    }

    public function argument(string $name): ?ValidatorArgs
    {
        foreach ($this->args as $a) {
            if ($a->name === $name) {
                return $a;
            }
        }
        return null;
    }
}
