<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

class Datatype_pagination extends \Formularium\Datatype\Datatype_constant
{
    public function __construct(string $typename = 'pagination', string $basetype = 'constant')
    {
        parent::__construct($typename, $basetype);
    }
}
