<?php declare(strict_types=1);

namespace Formularium;

/**
 * Allowed arguments
 */
final class MetadataParameter
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

    public function toMarkdown(): string
    {
        return <<<EOF
### {$this->name} ({$this->type})

{$this->comment}

EOF;
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
