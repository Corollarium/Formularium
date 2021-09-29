<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue\VueCode;

use Formularium\Datatype;
use Formularium\Frontend\Vue\VueCode;

use function Safe\json_encode;

class Prop
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string|Datatype
     */
    public $type = '';

    /**
     * @var bool
     */
    public $required;

    /**
     * @var mixed
     */
    public $default;

    /**
     * @param string $name
     * @param string|Datatype $type
     * @param bool $required
     * @param mixed $default
     */
    public function __construct(string $name, $type = '', bool $required = false, $default = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->required = $required;
        $this->default = $default;
    }

    public function toStruct(): string
    {
        $t = VueCode::mapTypeToJS($this->type);
        return "\"{$this->name}\": {\n".
            "  type: {$t}" .
            ($this->required ?? false ? ", required: true" : '') .
            ($this->default ?? false ? ", default: " . $this->default : '') .
            " } ";
    }

    public function typeAsString(): string
    {
        if (is_string($this->type)) {
            return $this->type;
        } else {
            return $this->type->getName();
        }
    }

    public function toDecorator(): string
    {
        $t = VueCode::mapTypeToJS($this->type);
        $options = [];
        if ($this->default) {
            $options["default"] =  $this->default;
        }
        return "@Prop(" .
             ($options ? json_encode($options, JSON_PRETTY_PRINT) : '{}') .
            ') readonly ' .
            $this->name .
            ($this->required ? '!' : '') .
            ': ' .
            $this->typeAsString() . ";\n";
    }

    public function toBind(): string
    {
        return 'v-bind:' . $this->name . '="model.' . $this->name . '"';
    }
}
