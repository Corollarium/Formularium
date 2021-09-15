<?php declare(strict_types=1);

namespace FormulariumTests\CodeGenerator;

use Formularium\Frontend\HTML\Renderable;
use Formularium\Model;
use Formularium\CodeGenerator\LaravelEloquent\CodeGenerator as LaravelEloquentCodeGenerator;

final class LaravelEloquentTest extends BaseCase
{
    public function testBase()
    {
        $model = $this->getBaseModel();

        $codeGenerator = new LaravelEloquentCodeGenerator();
        $fields = $codeGenerator->type($model);
        $this->assertStringContainsString('$table->string(\'myAlpha\', 256);', $fields);
        $this->assertStringContainsString('$table->boolean(\'myBool\')->nullable()', $fields);
        $this->assertStringContainsString('$table->boolean(\'myBoolean\')', $fields);
        $this->assertStringContainsString('$table->integer(\'myInt\')->nullable()', $fields);
        $this->assertStringContainsString('$table->text(\'myDescriptionText\')', $fields);
        $this->assertStringContainsString('$table->string(\'myIpv4\', 15)', $fields);
    }

    public function testExhaustive()
    {
        $model = $this->getExhaustiveModel();

        $codeGenerator = new LaravelEloquentCodeGenerator();
        $fields = $codeGenerator->type($model);
        $this->assertNotNull($fields); // If it didn't explode we're happy here
    }
}
