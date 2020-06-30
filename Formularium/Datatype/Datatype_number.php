<?php declare(strict_types=1);

namespace Formularium\Datatype;

abstract class Datatype_number extends \Formularium\Datatype
{
    public const MIN = "min";
    public const MAX = "max";

    public function __construct(string $typename = 'number', string $basetype = 'number')
    {
        parent::__construct($typename, $basetype);
    }

    public static function getValidatorMetadata(): array
    {
        return array_merge(
            parent::getValidatorMetadata(),
            [
                // TODO: min, max?
            ]
        );
    }
}
