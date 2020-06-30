<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

class Datatype_file extends \Formularium\Datatype
{
    public function __construct(string $typename = 'file', string $basetype = 'file')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return '';
    }

    /**
     *
     * @param string $value The path to the file to be validated. Might be a temporary path.
     * @param Model $model
     * @return mixed
     */
    public function validate($value, Model $model = null)
    {
        if (!file_exists($value)) {
            throw new ValidatorException('File not found.');
        }
        return $value;
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        throw new ValidatorException('File field.');
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        throw new ValidatorException('File field.');
    }
}
