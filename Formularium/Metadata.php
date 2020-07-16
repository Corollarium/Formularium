<?php declare(strict_types=1);

namespace Formularium;

/**
 * Class to store information about a validator, datatype, renderable or element
 * and its parameters.
 */
final class Metadata
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
     * @var MetadataParameter[]
     */
    public $args;

    public function __construct(string $name, string $comment, array $args = [])
    {
        $this->name = $name;
        $this->comment = $comment;
        $this->args = $args;
    }

    public function appendParameter(MetadataParameter $p): self
    {
        $this->args[] = $p;
        return $this;
    }

    public function toMarkdown(): string
    {
        $args = array_map(
            function (MetadataParameter $a) {
                return $a->toMarkdown();
            },
            $this->args
        );

        $argString = '';
        if (!empty($args)) {
            $argString = join("\n", $args);
        }

        return <<<EOF
## {$this->name}

{$this->comment}

$argString

EOF;
    }

    public function toGraphql(): string
    {
        $args = array_map(
            function (MetadataParameter $a) {
                return $a->toGraphql();
            },
            $this->args
        );

        $argString = '';
        if (!empty($args)) {
            $argString = "(" . join("\n", $args) . "\n)";
        }
        return <<< EOF
"""
{$this->comment}
"""
directive @{$this->name}{$argString} on FIELD_DEFINITION

EOF;
    }

    public function hasParameter(string $name): bool
    {
        foreach ($this->args as $a) {
            if ($a->name === $name) {
                return true;
            }
        }
        return false;
    }

    public function parameter(string $name): ?MetadataParameter
    {
        foreach ($this->args as $a) {
            if ($a->name === $name) {
                return $a;
            }
        }
        return null;
    }
}
