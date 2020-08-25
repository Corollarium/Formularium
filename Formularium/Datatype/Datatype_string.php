<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use Formularium\Validator\MaxLength;
use Formularium\Validator\MinLength;

class Datatype_string extends \Formularium\Datatype
{
    const MIN_LENGTH = "minLength";
    const MAX_LENGTH = "maxLength";

    /**
     *  @var integer
     */
    protected $MIN_STRING_LENGTH = 0;

    /**
     *  @var integer
     */
    protected $MAX_STRING_LENGTH = 256;

    public function __construct(string $typename = 'string', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN_LENGTH]['value'] ?? $this->MIN_STRING_LENGTH;
        $max = $params[static::MAX_LENGTH]['value'] ?? $this->MAX_STRING_LENGTH;
        return static::getRandomString($min, $max);
    }

    public function validate($value, Model $model = null)
    {
        if (!is_string($value)) {
            throw new ValidatorException('Invalid domain value');
        }

        // avoid invalid encoding attack
        $data = iconv("UTF-8", "UTF-8//IGNORE", (string)$value);
        if ($data === false) {
            throw new \Formularium\Exception\ValidatorException('Invalid encoding in string.');
        }
        $text = preg_replace('/<[^>]*>/', '', $data);

        $value = MinLength::validate($value, ['value' => $this->MIN_STRING_LENGTH]);
        $value = MaxLength::validate($value, ['value' => $this->MAX_STRING_LENGTH]);

        return $text;
    }

    public function getGraphqlType(): string
    {
        return 'String';
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'VARCHAR(' . $this->MAX_STRING_LENGTH . ')';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "string('$name', {$this->MAX_STRING_LENGTH})";
    }

    public function getDocumentation(): string
    {
        return "Strings in UTF-8 and sanitized, up to {$this->MAX_STRING_LENGTH} characters (which might be more than its bytes).";
    }
}
