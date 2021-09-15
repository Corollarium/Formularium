<?php declare(strict_types=1);

namespace FormulariumTests\CodeGenerator;

use Formularium\CodeGenerator\DatatypeGenerator;
use Formularium\CodeGenerator\Typescript\DatatypeGenerator\DatatypeGenerator_language;
use Formularium\Frontend\HTML\Renderable;
use Formularium\Model;
use Formularium\CodeGenerator\Typescript\CodeGenerator as TypescriptCodeGenerator;

final class TypescriptTest extends BaseCase
{
    public function testBase()
    {
        $model = $this->getBaseModel();
        $codeGenerator = new TypescriptCodeGenerator();
        $fields = $codeGenerator->type($model);
        $this->assertStringContainsString('myAlpha: alpha', $fields);
        $this->assertStringContainsString('myBool: boolean', $fields);
        $this->assertStringContainsString('myBoolean: boolean', $fields);
        $this->assertStringContainsString('myInt: integer', $fields);
        $this->assertStringContainsString('myDescriptionText: text', $fields);
        $this->assertStringContainsString('myIpv4: ipv4', $fields);
    }

    public function testEnum()
    {
        $codeGenerator = new TypescriptCodeGenerator();
        $dg = new DatatypeGenerator_language();
        $declaration = $dg->datatypeDeclaration($codeGenerator);
        $this->assertStringStartsWith("enum language {\n  aa\n  ab", $declaration);
        $this->assertStringEndsWith("zu\n}", $declaration);
        $model = $this->getBaseModel();
        $fields = $codeGenerator->type($model);
    }
}
