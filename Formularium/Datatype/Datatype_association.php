<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;

abstract class Datatype_association extends \Formularium\Datatype
{
    public const MULTIPLE = "MULTIPLE";

    public function __construct(string $typename = 'association', string $basetype = 'association')
    {
        parent::__construct($typename, $basetype);
    }

    public function getDefault()
    {
        return 0;
    }

    public function getRandom(array $params = [])
    {
        throw new ValidatorException('Implementation defined');
    }

    public function validate($value, Field $f)
    {
        throw new ValidatorException('Invalid boolean value');
    }
}
