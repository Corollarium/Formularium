<?php declare(strict_types=1);

namespace FormulariumTests\CodeGenerator;

use Formularium\Frontend\HTML\Renderable;
use Formularium\Model;
use Formularium\CodeGenerator\SQL\CodeGenerator as SQLCodeGenerator;
use Formularium\DatabaseEnum;

final class SQLTest extends BaseCase
{
    public function testBase()
    {
        $model = $this->getBaseModel();

        $codeGenerator = new SQLCodeGenerator();
        $codeGenerator->setDatabase(DatabaseEnum::MYSQL);
        $fields = $codeGenerator->type($model);
        $this->assertStringContainsString('myAlpha VARCHAR(256) NOT NULL,', $fields);
        $this->assertStringContainsString('myBool BOOLEAN,', $fields);
        $this->assertStringContainsString('myBoolean BOOLEAN,', $fields);
        $this->assertStringContainsString('myInt INT,', $fields);
        $this->assertStringContainsString('myDescriptionText TEXT,', $fields);
        $this->assertStringContainsString('myIpv4 VARCHAR(15)', $fields);
    }

    public function testExhaustive()
    {
        $model = $this->getExhaustiveModel();

        $codeGenerator = new SQLCodeGenerator();
        $fields = $codeGenerator->type($model);
        $this->assertNotNull($fields); // If it didn't explode we're happy here
    }
}
