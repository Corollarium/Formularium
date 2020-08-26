<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\Exception;

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

    public static function getFromData(string $name = null, array $data) : Metadata
    {
        if (!$name) {
            $name = $data['name'] ?? null;
        }
        if (!$name) {
            throw new Exception("Missing name in fields");
        }
        return new Metadata($name, $data['comment'] ?? '', $data['args'] ?? []);
    }

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

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of comment
     *
     * @return  string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @param  string  $comment
     *
     * @return  self
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;

        return $this;
    }
}
