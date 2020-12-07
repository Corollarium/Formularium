<?php declare(strict_types=1);
namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Model;

class Datatype_name extends Datatype_string
{
    public function __construct(string $typename = 'name', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $validators = [])
    {
        return static::faker()->name;
    }

    public function getDocumentation(): string
    {
        return 'Just a plain string, but that expects a name. Generates good random names.';
    }
}
