<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;
use Formularium\Metadata;

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

    public function validate($value, Model $model = null)
    {
        throw new ValidatorException('Constant field.');
    }

    public function getSQLType(string $database = '', array $options = []): string
    {
        throw new ValidatorException('Constant field.');
    }

    public function getLaravelSQLType(string $name, array $options = []): string
    {
        throw new ValidatorException('Constant field.');
    }

    public function getMetadata(): Metadata
    {
        return new Metadata(
            $this->getName(),
            $this->getDocumentation(),
            []
        );
    }
}
