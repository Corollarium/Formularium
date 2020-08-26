<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\Exception;

/**
 * Class to store extra user parameters
 */
final class Extradata
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var ExtradataParameter[]
     */
    public $args = [];

    public static function getFromData(string $name = null, array $data) : Extradata
    {
        if (!$name) {
            $name = $data['name'] ?? null;
        }
        if (!$name) {
            throw new Exception("Missing name in fields");
        }
        return new Extradata($name, $data ?? []);
    }

    public function __construct(string $name, array $args = [])
    {
        $this->name = $name;
        foreach ($args as $n => $d) {
            $this->args[] = ($d instanceof ExtradataParameter) ? $d : new ExtradataParameter($d['name'], $d['value']);
        }
    }

    public function appendParameter(ExtradataParameter $p): self
    {
        $this->args[] = $p;
        return $this;
    }

    public function hasParameter(string $name): bool
    {
        foreach ($this->args as $a) {
            if ($a->name === $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * Undocumented function
     *
     * @param string $name The parameter name
     * @param Mixed $default
     * @return Mixed
     */
    public function value(string $name, $default = null)
    {
        foreach ($this->args as $a) {
            if ($a->name === $name) {
                return $a->value;
            }
        }
        return $default;
    }
    /**
     * Undocumented function
     *
     * @param string $name
     * @return ExtradataParameter|null
     */
    public function parameter(string $name): ?ExtradataParameter
    {
        foreach ($this->args as $a) {
            if ($a->name === $name) {
                return $a;
            }
        }
        return null;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
}
