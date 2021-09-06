<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\GraphQL\DatatypeGenerator;

use Formularium\CodeGenerator\GraphQL\GraphQLDatatypeGenerator;

class DatatypeGenerator_bool extends GraphQLDatatypeGenerator
{
    protected function getDatatypeBasename(): string
    {
        return 'Boolean';
    }
    
    public function getBasetype(): string
    {
        return 'Boolean';
    }
}
