#!/bin/bash

FRAMEWORK=$1
INHERIT=${2:-\\Formularium\\Datatype}

mkdir -p Formularium/Frontend/$FRAMEWORK/Renderable

FILENAME="Formularium/Frontend/$FRAMEWORK/Framework.php" 
if [ ! -f "$FILENAME" ]
then 
    cat > "$FILENAME" <<EOF
<?php

namespace Formularium\Frontend\\${FRAMEWORK};

class Framework extends \Formularium\Framework
{
    public function __construct($name = '{{$FRAMEWORK}}')
    {
        parent::__construct($name);
    }
}
EOF
fi

for datatype in `ls Formularium/Datatype/`
do
    RENDERABLENAME=$((sed 's|\.php$||i' <<< "$datatype") | sed 's/Datatype/Renderable/')
    FILENAME="Formularium/Frontend/$FRAMEWORK/Renderable/$RENDERABLENAME.php"

    if grep -Fxq "abstract class" "Formularium/Datatype/$datatype"
    then
        continue
    fi

    if [ ! -f "$FILENAME" ]
    then
        echo "Generating $FILENAME"
        cat > "$FILENAME" <<EOF
<?php

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

echo "Created ${FRAMEWORK}."