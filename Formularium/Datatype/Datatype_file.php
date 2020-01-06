<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

class Datatype_file extends \Formularium\Datatype
{
    const MAX_SIZE = 'MAX_SIZE';

    public function __construct(string $typename = 'file', string $basetype = 'file')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return '';
    }

    public function validate($value, Field $field, Model $model = null)
    {
        $max_size = $field->getValidator(self::MAX_SIZE, 0);
        if ($max_size) {
            // TODO
        }
        return $value;
    }
}
