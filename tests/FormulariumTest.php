<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Formularium;
use PHPUnit\Framework\TestCase;

final class FormulariumTest extends TestCase
{
    public function testValidatorGraphqlDirectives()
    {
        $names = Formularium::validatorGraphqlDirectives();
        $this->assertIsString($names);
        $this->assertStringContainsString('directive @Min(', $names);
        $this->assertStringNotContainsString('directive @required', $names);
    }

    public function testScalarGraphqlDirectives()
    {
        $names = Formularium::scalarGraphqlDirectives();
        $this->assertIsString($names);
        $this->assertStringContainsString('scalar year @scalar(', $names);
    }
}
