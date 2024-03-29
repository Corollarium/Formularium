<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\Model;

class Datatype_uuid extends Datatype_string
{
    const UUID_REGEX = '^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$';

    public function __construct(string $typename = 'uuid', string $basetype = 'string')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        // From http://rogerstringer.com/2013/11/15/generate-uuids-php/
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    public function validate($value, Model $model = null)
    {
        if ($value === '' || preg_match('/' . self::UUID_REGEX . '/i', (string)$value)) {
            return $value;
        }
        throw new Exception('Invalid uuid value: ' . $value);
    }
    
    public function getLaravelSQLType(string $name, array $options = []): string
    {
        return "uuid('$name')";
    }

    public function getDocumentation(): string
    {
        return 'Datatype for uuid values.';
    }
}
