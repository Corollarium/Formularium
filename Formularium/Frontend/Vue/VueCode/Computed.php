<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue\VueCode;

class Computed
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $type = null;

    public function __construct(string $name, string $type = '', string $code = '')
    {
        $this->name = $name;
        $this->code = $code;
        $this->type = $type;
    }

    public function toGetter(): string
    {
        return "get {$this->name}() { $this->code }";
    }

    public function toStruct(): string
    {
        return "{$this->name}() { $this->code }";
    }
}
