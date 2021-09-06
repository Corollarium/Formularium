<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\GraphQL\DatatypeGenerator;

use Formularium\CodeGenerator\GraphQL\GraphQLDatatypeGenerator;

class DatatypeGenerator_float extends GraphQLDatatypeGenerator
{
    public function getBasetype(): string
    {
        return 'Float';
    }
}
