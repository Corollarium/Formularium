<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Factory\DatatypeFactory;
use PHPUnit\Framework\TestCase;

final class DatatypeTest extends TestCase
{
    public function testBase()
    {
        $d = DatatypeFactory::factory('string');
        $this->assertEquals('string', $d->getName());
        $this->assertEquals('string', $d->getBasetype());

        $d = DatatypeFactory::factory('color');
        $this->assertEquals('color', $d->getName());
        $this->assertEquals('string', $d->getBasetype());
    }

    public function testGraphql()
    {
        $d = DatatypeFactory::factory('integer');
        $this->assertEquals('Int', $d->getGraphqlType());
        $this->assertEquals('some', $d->getGraphqlField('some'));
    }
}
