<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\ValidatorException;

/**
 * Abstract base classe to validate data in composition to the validation in
 * datatypes.
 */
class ValidatorMetadata
{
    public $name;

    public $comment;

    /**
     * @var ValidatorArgs[]
     */
    public $args;

    public function __construct(string $name, string $comment, array $args = [])
    {
        $this->name = $name;
        $this->comment = $comment;
        $this->args = args;
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
            $argString = "(\n" . join("\n", $args) . ')';
        }
        return <<< EOF
"""
{$this->comment}
"""
directive @{$this->name}{$argString} on FIELD_DEFINITION
  
EOF;
    }
}
