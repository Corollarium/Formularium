<?php

namespace Formularium\Datatype;

use Formularium\Field;

class Datatype_string extends \Formularium\Datatype
{
    const MIN_LENGTH = "min_length";
    const MAX_LENGTH = "max_length";
    protected $MAX_STRING_SIZE = 1024;

    public function __construct($typename = 'string', $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN_LENGTH] ?? 5;
        $max = $params[static::MAX_LENGTH] ?? 15;
        return static::getRandomString($min, $max);
    }

    public function validate($value, Field $f)
    {
        // avoid invalid encoding attack
        $data = iconv("UTF-8", "UTF-8//IGNORE", $value);
        $text = preg_replace('/<[^>]*>/', '', $data);

        $validators = $f->getValidators();
        if (array_key_exists(self::MIN_LENGTH, $validators)) {
            if (mb_strlen($text) < $validators[self::MIN_LENGTH]) {
                throw new \Formularium\Exception\ValidatorException('String is too short.');
            }
        }
        if (array_key_exists(self::MAX_LENGTH, $validators)) {
            if (mb_strlen($text) > $validators[self::MAX_LENGTH]) {
                throw new \Formularium\Exception\ValidatorException('String is too long.');
            }
        }
        
        // TODO: cut if > MAX_STRING_SIZE

        return $text;
    }
}
