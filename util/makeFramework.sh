#!/bin/bash

FRAMEWORK=$1
DATATYPES=${2:-`ls Formularium/Datatype/`}

mkdir -p Formularium/Frontend/$FRAMEWORK/Renderable

FILENAME="Formularium/Frontend/$FRAMEWORK/Framework.php" 
if [ ! -f "$FILENAME" ]
then 
    cat > "$FILENAME" <<EOF
<?php declare(strict_types=1); 

namespace Formularium\Frontend\\${FRAMEWORK};

class Framework extends \Formularium\Framework
{
    public function __construct(string \$name = '${FRAMEWORK}')
    {
        parent::__construct(\$name);
    }
}
EOF
    echo "Created ${FRAMEWORK} class."
fi

for datatype in $DATATYPES
do
    if [ ! -f "Formularium/Datatype/$FILENAME" ]
    then
        echo "Cannot find Formularium/Datatype/$datatype. Try using the full filename: Datatype_xxx.php"
        continue;
    fi
    RENDERABLENAME=$((sed 's|\.php$||i' <<< "$datatype") | sed 's/Datatype/Renderable/')
    FILENAME="Formularium/Frontend/$FRAMEWORK/Renderable/$RENDERABLENAME.php"

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

namespace Formularium\Frontend\\${FRAMEWORK}\Renderable;

use Formularium\Field;
use Formularium\HTMLElement;

class ${RENDERABLENAME} extends \Formularium\Renderable
{
    public function viewable(\$value, Field \$field, HTMLElement \$previous): HTMLElement
    {
        return \$previous;
    }
    public function editable(\$value, Field \$field, HTMLElement \$previous): HTMLElement
    {
        return \$previous;
    }
}
EOF
   fi

done
