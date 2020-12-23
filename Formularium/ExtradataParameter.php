<?php declare(strict_types=1);

namespace Formularium;

/**
 * Allowed arguments
 */
final class ExtradataParameter
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var mixed
     */
    public $value;

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}
