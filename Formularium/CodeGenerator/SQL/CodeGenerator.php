<?php declare(strict_types=1);

namespace Formularium\CodeGenerator\SQL;

use Formularium\DatabaseEnum;
use Formularium\Model;

class CodeGenerator extends \Formularium\CodeGenerator\CodeGenerator
{
    /**
     * The database type
     *
     * @var string
     */
    public $database = DatabaseEnum::MYSQL;

    public function __construct(string $name = 'SQL')
    {
        parent::__construct($name);
    }

    /**
     * @param string $database See DatabaseEnum
     * @return self
     */
    public function setDatabase(string $database): self
    {
        $this->database = $database;
        return $this;
    }

    public function type(Model $model): string
    {
        $fields = implode(",\n", $this->fields($model));
        $indices = '';
        return <<<EOD
CREATE TABLE {$model->getName()} (
$fields
$indices
)
EOD;
    }

    public function typeFilename(Model $model): string
    {
        return $model->getName() . '.sql';
    }
}
