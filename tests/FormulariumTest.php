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

    public function testGraphqlDirectives()
    {
        $names = Formularium::graphqlDirectives();
        $this->assertIsString($names);
        $this->assertContains('directive @min(', $names);
        $this->assertNotContains('directive @required', $names);
    }
}
