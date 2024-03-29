<?php declare(strict_types=1);

namespace Formularium\Datatype;

class Datatype_text extends Datatype_string
{
    protected $MAX_STRING_LENGTH = 1024000;

    public function __construct(string $typename = 'text', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return static::faker()->text(); // TODO: params
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "text('$name')";
    }

    public function getDocumentation(): string
    {
        return "Long text in UTF-8 and sanitized, up to {$this->MAX_STRING_LENGTH} characters (which might be more than its bytes).";
    }
}
