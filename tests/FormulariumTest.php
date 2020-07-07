<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Formularium;
use PHPUnit\Framework\TestCase;

final class FormulariumTest extends TestCase
{
    public function testDatatypes()
    {
        $names = Formularium::getDatatypeNames();
        $this->assertIsArray($names);
        $this->assertContains('string', $names);
    }

    public function testValidatorGraphqlDirectives()
    {
        $names = Formularium::validatorGraphqlDirectives();
        $this->assertIsString($names);
        $this->assertContains('directive @Min(', $names);
        $this->assertNotContains('directive @required', $names);
    }

    public function testScalarGraphqlDirectives()
    {
        $names = Formularium::scalarGraphqlDirectives();
        $this->assertIsString($names);
        $this->assertContains('scalar @year(', $names);
    }
}
