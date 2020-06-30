<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;

class Datatype_string extends \Formularium\Datatype
{
    const MIN_LENGTH = "minLength";
    const MAX_LENGTH = "maxLength";

    /**
     *  @var integer
     */
    protected $MAX_STRING_SIZE = 256;

    public function __construct(string $typename = 'string', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        $min = $params[static::MIN_LENGTH]['value'] ?? 5;
        $max = $params[static::MAX_LENGTH]['value'] ?? 15;
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

        return $text;
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        return 'VARCHAR(' . $this->MAX_STRING_SIZE . ')';
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "string('$name', {$this->MAX_STRING_SIZE})";
    }
}
