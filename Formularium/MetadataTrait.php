<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\Exception;
use Formularium\Factory\DatatypeFactory;

trait MetadataTrait
{
    /**
     * @var Metadata[]
     */
    protected $metadata;

    /**
     * All metadata objects. Yeah, that's a horrible plural, I know.
     *
     * @return Metadata[]
     */
    public function getMetadatas(): array
    {
        return $this->metadata;
    }

    /**
     * @param string $name
     * @return Metadata
     */
    public function getMetadata(string $name)
    {
        foreach ($this->metadata as $m) {
            if ($m->getName() === $name) {
                return $m;
            }
        }
        return null;
    }

    public function appendMetadata(Metadata $m): self
    {
        $this->metadata[] = $m;
        return $this;
    }
}
