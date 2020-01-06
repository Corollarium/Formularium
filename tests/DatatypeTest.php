<?php declare(strict_types=1);

declare(strict_types=1);

use Formularium\Datatype;
use Formularium\Datatype\Datatype_integer;
use Formularium\Exception\Exception;
use Formularium\Model;
use PHPUnit\Framework\TestCase;

final class DatatypeTest extends TestCase
{
    public function testBase()
    {
        $d = Datatype::factory('string');
        $this->assertEquals('string', $d->getName());
        $this->assertEquals('string', $d->getBasetype());

        $d = Datatype::factory('color');
        $this->assertEquals('color', $d->getName());
        $this->assertEquals('string', $d->getBasetype());
    }
}
