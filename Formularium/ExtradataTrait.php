<?php declare(strict_types=1);

namespace Formularium;

trait ExtradataTrait
{
    /**
     * @var Extradata[]
     */
    protected $extradata = [];

    public function setExtradata(array $data): self
    {
        $this->extradata = [];
        foreach ($data as $d) {
            $this->extradata[] = ($d instanceof Extradata) ? $d : Extradata::getFromData(null, $d);
        }
        return $this;
    }

    /**
     * All extradata objects. Yeah, that's a horrible plural, I know.
     *
     * @return Extradata[]
     */
    public function getExtradatas(): array
    {
        return $this->extradata;
    }

    public function getExtradataSerialize(): array
    {
        return array_map(
            function (Extradata $e) {
                return [
                    'name' => $e->getName(),
                    'args' => array_map(
                        function (ExtradataParameter $a) {
                            return [
                                'name' => $a->name,
                                'value' => $a->value
                            ];
                        },
                        $e->args
                    )
                ];
            },
            $this->extradata
        );
    }

    /**
     * @param string $name
     * @return Extradata|null
     */
    public function getExtradata(string $name): ?Extradata
    {
        foreach ($this->extradata as $m) {
            if ($m->getName() === $name) {
                return $m;
            }
        }
        return null;
    }

    /**
     * @param string $name
     * @param string $parameter
     * @param Mixed $default
     * @return Mixed
     */
    public function getExtradataValue(string $name, string $parameter, $default = null)
    {
        $e = $this->getExtradata($name);
        if (!$e) {
            return $default;
        }
        return $e->value($parameter, $default);
    }

    public function appendExtradata(Extradata $m): self
    {
        $this->extradata[] = $m;
        return $this;
    }

    public function removeExtraData(string $name): self
    {
        foreach ($this->extradata as $k => $m) {
            if ($m->getName() === $name) {
                unset($this->extradata[$k]);
                break;
            }
        }
        return $this;
    }
}
