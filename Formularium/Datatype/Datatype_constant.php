<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

/**
 * Constant field. For injection of HTML. Any data is rejected
 */
class Datatype_constant extends \Formularium\Datatype
{
    public function __construct(string $typename = 'constant', string $basetype = 'constant')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        throw new ValidatorException('Constant field.');
    }

    public function validate($value, Field $field, Model $model = null)
    {
        throw new ValidatorException('Constant field.');
    }
}