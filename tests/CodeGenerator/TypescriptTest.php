<?php declare(strict_types=1);

namespace FormulariumTests\CodeGenerator;

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
}
