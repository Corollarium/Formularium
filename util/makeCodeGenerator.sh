#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )/.." && pwd )"
FRAMEWORK=$1
DATATYPES=${2:-`ls $DIR/Formularium/Datatype/`}

mkdir -p $DIR/Formularium/CodeGenerator/$FRAMEWORK/DatatypeGenerator

FILENAME="$DIR/Formularium/CodeGenerator/$FRAMEWORK/CodeGenerator.php" 
if [ ! -f "$FILENAME" ]
then 
    cat > "$FILENAME" <<EOF
<?php declare(strict_types=1); 

namespace Formularium\CodeGenerator\\${FRAMEWORK};

use Formularium\Model;

class CodeGenerator extends \Formularium\CodeGenerator\CodeGenerator
{
    public function __construct(string \$name = '${FRAMEWORK}')
    {
        parent::__construct(\$name);
    }

    public function type(Model \$model): string 
    {
        return '';
    }
}
EOF
    echo "Created ${FRAMEWORK} class."
fi

for datatype in $DATATYPES
do
    RENDERABLENAME=$((sed 's|\.php$||i' <<< "$datatype") | sed 's/Datatype/DatatypeGenerator/')
    FILENAME="Formularium/CodeGenerator/$FRAMEWORK/DatatypeGenerator/$RENDERABLENAME.php"

    if grep -Fq "abstract class" "Formularium/Datatype/$datatype"
    then
        echo "Skipping abstract class $datatype"
        continue
    fi

    if [ ! -f "$FILENAME" ]
    then
        echo "Generating $FILENAME"
        cat > "$FILENAME" <<EOF
<?php declare(strict_types=1); 

namespace Formularium\CodeGenerator\\${FRAMEWORK}\DatatypeGenerator;

use Formularium\Field;
use Formularium\CodeGenerator\CodeGenerator;
use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\\${FRAMEWORK}\CodeGenerator as ${FRAMEWORK}CodeGenerator;

class ${RENDERABLENAME} implements DatatypeGenerator
{
    public function datatypeDeclaration(CodeGenerator \$generator)
    {
        /**
         * @var ${FRAMEWORK}CodeGenerator \$generator
         */
        return '';
    }

    public function field(CodeGenerator \$generator, Field \$field)
    {
        /**
         * @var ${FRAMEWORK}CodeGenerator \$generator
         */
        return '';
    }
}
EOF
   fi

done
