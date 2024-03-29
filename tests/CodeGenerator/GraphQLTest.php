<?php declare(strict_types=1);

namespace FormulariumTests\CodeGenerator;

use Formularium\Model;
use Formularium\CodeGenerator\GraphQL\CodeGenerator as GraphQLCodeGenerator;
use Formularium\CodeGenerator\GraphQL\DatatypeGenerator\DatatypeGenerator_language;
use Formularium\Datatype;

final class GraphQLTest extends BaseCase
{
    public function testBase()
    {
        $model = $this->getBaseModel();

        $codeGenerator = new GraphQLCodeGenerator();
        $fields = $codeGenerator->type($model);

        $this->assertStringContainsString('myAlpha: Alpha!', $fields);
        $this->assertStringContainsString('myBool: Boolean', $fields);
        $this->assertStringContainsString('myBoolean: Boolean', $fields);
        $this->assertStringContainsString('myInt: Int', $fields);
        $this->assertStringContainsString('myDescriptionText: Text', $fields);
        $this->assertStringContainsString('myIpv4: Ipv4', $fields);

        $t = preg_replace('/\s+/', ' ', $fields); // remove multiple white space
        $this->assertStringContainsString('@renderable( label: "My Alpha" ', $t);
    }

    public function testEnum()
    {
        $codeGenerator = new GraphQLCodeGenerator();
        $dg = new DatatypeGenerator_language();
        $declaration = $dg->datatypeDeclaration($codeGenerator);
        $this->assertStringStartsWith("enum Language {\n  aa\n  ab", $declaration);
        $this->assertStringEndsWith("zu\n}", $declaration);
        $model = $this->getBaseModel();
        $fields = $codeGenerator->type($model);
    }

    public function testExhaustive()
    {
        $model = $this->getExhaustiveModel();

        $codeGenerator = new GraphQLCodeGenerator();
        $fields = $codeGenerator->type($model);
        $this->assertNotNull($fields); // If it didn't explode we're happy here
    }
}
