<?php declare(strict_types=1);

namespace Formularium\Code;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\Model;

class Graphql
{
    public Model $model;
    
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Generates a GraphQL query for this model.
     *
     * @param array $params User supplied list of parameters, which may be used
     * to control behavior (like recursion).
     * @return string
     */
    public function generate(array $params = []): string
    {
        $defs = [];
        foreach ($this->model->getFields() as $field) {
            /**
             * @var Field $field
             */
            $defs[] = $this->datatype->getGraphqlField($field->getName(), $params);
        }
        return join("\n", $defs);
    }
}
