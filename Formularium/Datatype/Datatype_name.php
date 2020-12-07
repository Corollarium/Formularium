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

    /**
     * Returns a random valid value for this datatype, considering the validators
     *
     * @param array \$validators
     * @throws Exception If cannot generate a random value.
     * @return mixed
     */
    public function getRandom(array $validators = [])
    {
        return static::faker()->name;
    }

    public function getDocumentation(): string
    {
        return 'Just a plain string, but that expects a name. Generates good random names.';
    }
}
