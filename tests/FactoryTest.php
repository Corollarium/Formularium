<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\FrameworkFactory;
use Formularium\Factory\ValidatorFactory;
use HaydenPierce\ClassFinder\ClassFinder;
use PHPUnit\Framework\TestCase;

final class FactoryTest extends TestCase
{
    public function testDatatypes()
    {
        $names = DatatypeFactory::getNames();
        $this->assertIsArray($names);
        $this->assertContains('string', $names);
    }
    
    public function testFrameworks()
    {
        $names = FrameworkFactory::getNames();
        $this->assertIsArray($names);
        $this->assertContains('Bulma', $names);
    }

    public function testValidators()
    {
        $names = ValidatorFactory::getNames();
        $this->assertIsArray($names);
        $this->assertContains('MinLength', $names);
    }
}
