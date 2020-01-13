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

    public function getDefault(array $params = [])
    {
        return [
            "total" => 1,
            "current_page" => 1,
            "per_page" => 20
        ];
    }
}
