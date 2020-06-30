<?php declare(strict_types=1);

namespace Formularium;

/**
 * Abstract base classe to validate data in composition to the validation in
 * datatypes.
 */
final class ValidatorArgs
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $comment;

    public function __construct(string $name, string $type, string $comment)
    {
        $this->name = $name;
        $this->type = $type;
        $this->comment = $comment;
    }

    public function toGraphql(): string
    {
        return <<<EOF

    """
    {$this->comment}
    """
    {$this->name}: {$this->type}
EOF;
    }
}
