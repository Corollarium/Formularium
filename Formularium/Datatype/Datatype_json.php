<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\DatatypeFactory;
use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Respect\Validation\Validator as V;

class Datatype_json extends Datatype_text
{
    public function __construct(string $typename = 'json', string $basetype = 'text')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $arr = [
            'version' => DatatypeFactory::factory('integer')->getRandom(),
            'data' => [
                'string' => DatatypeFactory::factory('string')->getRandom(),
                'float' => DatatypeFactory::factory('float')->getRandom(),
            ]
        ];
        return json_encode($arr);
    }

    public function getDefault()
    {
        return '{}';
    }

    public function validate($value, Model $model = null)
    {
        $value = (string)$value;
        if ($value == "[]") {
            return $value;
        }
        $json = json_decode($value, true);
        if ($json !== null && V::json()->validate($value)) {
            return $value;
        }
        throw new ValidatorException('Invalid json value');
    }
}
