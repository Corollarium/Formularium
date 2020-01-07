<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

class Datatype_timezone extends \Formularium\Datatype\Datatype_choice
{
    public function __construct(string $typename = 'timezone', string $basetype = 'choice')
    {
        parent::__construct($typename, $basetype);
        $l = timezone_identifiers_list();
        $this->choices = array_combine($l, $l);
    }
}
