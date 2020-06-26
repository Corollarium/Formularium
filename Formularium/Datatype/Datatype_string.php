<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;

class Datatype_string extends \Formularium\Datatype
{
    const MIN_LENGTH = "minLength";
    const MAX_LENGTH = "maxLength";
    const SAME_AS = "sameAs";

    /**
     *  @var integer
     */
    protected $MAX_STRING_SIZE = 1024;

    public function __construct(string $typename = 'string', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN_LENGTH] ?? 5;
        $max = $params[static::MAX_LENGTH] ?? 15;
        return static::getRandomString($min, $max);
    }

    public function validate($value, array $validators = [], Model $model = null)
    {
        // avoid invalid encoding attack
        $data = iconv("UTF-8", "UTF-8//IGNORE", (string)$value);
        if ($data === false) {
            throw new \Formularium\Exception\ValidatorException('Invalid encoding in string.');
        }
        $text = preg_replace('/<[^>]*>/', '', $data);

        if (array_key_exists(self::MIN_LENGTH, $validators)) {
            if (mb_strlen($text) < $validators[self::MIN_LENGTH]) {
                throw new \Formularium\Exception\ValidatorException('String is too short.');
            }
        }
        $maxlength = $validators[self::MAX_LENGTH] ?? $this->MAX_STRING_SIZE;
        if (mb_strlen($text) > $maxlength) {
            throw new \Formularium\Exception\ValidatorException('String is too long.');
        }

        $same = $validators[self::SAME_AS] ?? null;
        if ($same) {
            if (!$model) {
                throw new \Formularium\Exception\ValidatorException('Same as requires a model.');
            }
            $modelData = $model->getData();
            if (!array_key_exists($same, $modelData)) {
                throw new \Formularium\Exception\ValidatorException('Same as field not found.');
            }
            if ($modelData[$same] !== $value) {
                throw new \Formularium\Exception\ValidatorException('Field does not match ' . $same);
            }
        }

        return $text;
    }

    public static function getValidatorMetadata(): array
    {
        return array_merge(
            parent::getValidatorMetadata(),
            [
                self::MIN_LENGTH => [
                    'comment' => "Minimum length for the string.",
                    'args' => [
                        [
                            'name' => 'value',
                            'type' => 'Integer',
                            'comment' => 'The length'
                        ]
                    ]
                ],
                self::MAX_LENGTH => [
                    'comment' => "Maximum length for the string.",
                    'args' => [
                        [
                            'name' => 'value',
                            'type' => 'Integer',
                            'comment' => 'The length'
                        ]
                    ]
                ],
                self::SAME_AS => [
                    'comment' => "Must match the same value from another field.",
                    'args' => [
                        [
                            'name' => 'field',
                            'type' => 'String',
                            'comment' => 'The field name to match to.'
                        ]
                    ]
                ]
            ]
        );
    }
}
