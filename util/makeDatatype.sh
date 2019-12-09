#!/bin/bash

DATATYPE=$1
INHERIT=${2:-\\Formularium\\Datatype}

FILENAME="Formularium/Datatype/Datatype_${DATATYPE,,}.php" 
if [ ! -f "$FILENAME" ]
then 
    cat > "$FILENAME" <<EOF
<?php

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Exception\ValidatorException;

class Datatype_${DATATYPE,,} extends \Formularium\Datatype
{
    public function __construct(\$typename = '${DATATYPE,,}', \$basetype = '${DATATYPE,,}')
    {
        parent::__construct(\$typename, \$basetype);
    }

    public function getRandom(array \$params = [])
    {
        throw new ValidatorException('Not implemented');
    }

    public function validate(\$value, Field \$f)
    {
        throw new ValidatorException('Not implemented');
    }
}
EOF
fi


FILENAME="tests/Datatype/${DATATYPE}Test.php"
if [ ! -f "$FILENAME" ]
then 
    cat > "$FILENAME" <<EOF
<?php

require_once('DatatypeBaseTestCase.php');

use Formularium\Datatype;

class Datatype${DATATYPE}_TestCase extends DatatypeBaseTestCase
{

    /**
     * @return DataType
     */
    public function getDataType(): \Formularium\Datatype
    {
        return \Formularium\Datatype::factory('${DATATYPE,,}');
    }

    /**
     * @return array
     */
    public function getValidValues()
    {
        return [
            [
                'value' => '', // TODO
                'expected' => '' // TODO
                // optional: 'validators' => []
            ]
        ];
    }

    /**
     * @return array
     */
    public function getInvalidValues()
    {
        return [
            [
                'value' => '', // TODO
                // optional: 'validators' => []
            ]
        ];
    }
}
EOF
fi


echo "Created ${DATATYPE}."