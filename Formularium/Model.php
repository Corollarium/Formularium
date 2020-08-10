<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\Exception;

/**
 * Model class, representing a whole object.
 */
class Model
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Field[]
     */
    protected $fields = [];

    /**
     * @var array
     */
    protected $renderable = [];

    /**
     * Model data being processed.
     * @var array
     */
    protected $_data = [];

    /**
     * Model data being processed.
     * @var string[]|callable|null
     */
    protected $_restrictFields = null;

    /**
     *
     * @param string $name
     * @throws Exception
     */
    protected function __construct(string $name = '')
    {
        $this->name = $name;
    }

    /**
     * Loads model from JSON file.
     *
     * @param array $struct
     * @return Model
     */
    public static function fromStruct(array $struct): Model
    {
        $m = new self('');
        $m->parseStruct($struct);
        return $m;
    }

    /**
     * Loads model from JSON file.
     *
     * @param string $name The JSON filename.
     * @return Model
     */
    public static function fromJSONFile(string $name): Model
    {
        $json = file_get_contents($name); // TODO: path
        if ($json === false) {
            throw new Exception('File not found');
        }
        return static::fromJSON($json);
    }

    /**
     * Loads model from JSON string
     *
     * @param string $json The JSON string.
     * @return Model
     */
    public static function fromJSON(string $json): Model
    {
        $data = \json_decode($json, true);
        if ($data === null) {
            throw new Exception('Invalid JSON format');
        }
        $m = new self('');
        $m->parseStruct($data);
        return $m;
    }

    /**
     * @param string $name
     * @param array[]|Field[] $fields
     * @return Model
     */
    public static function create(string $name, array $fields = []): Model
    {
        $m = new self($name);
        foreach ($fields as $fieldName => $fieldData) {
            if ($fieldData instanceof Field) {
                $m->fields[$fieldData->getName()] = $fieldData;
            } else {
                $m->fields[$fieldName] = Field::getFromData($fieldName, $fieldData);
            }
        }
        return $m;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAllFields(): array
    {
        return $this->fields;
    }

    /**
     * @param string[]|callable $restrictFields If present, restrict rendered fields. Can either
     * be an array of strings (field names) or a callback which is called for each field.
     * @return array
     */
    public function getFields($restrictFields = null): array
    {
        if ($restrictFields === null) {
            $restrictFields = $this->_restrictFields;
        }
        if ($restrictFields === null) {
            return $this->fields;
        }
        
        $fields = [];
        foreach ($this->fields as $field) {
            /**
             * @var Field $field
             */
            if (is_array($restrictFields) && !in_array($field->getName(), $restrictFields)) {
                continue;
            } elseif (is_callable($restrictFields) && !$restrictFields($field, $this)) {
                continue;
            }
            $fields[$field->getName()] = $field;
        }
        return $fields;
    }

    public function getData(): array
    {
        return $this->_data;
    }

    public function getRenderables(): array
    {
        return $this->renderable;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getRenderable(string $name, $default)
    {
        return $this->renderable[$name] ?? $default;
    }

    public function getField(string $name): Field
    {
        return $this->fields[$name];
    }

    /**
     * filter operation for fields that return true for callable.
     *
     * @param callable $function
     * @return Field[]
     */
    public function filterField(callable $function): array
    {
        return array_filter(
            $this->fields,
            $function
        );
    }

    public function appendField(Field $f): self
    {
        $this->fields[$f->getName()] = $f;
        return $this;
    }

    /**
     * @param Field[] $fields
     * @return self
     */
    public function appendFields(array $fields): self
    {
        foreach ($fields as $f) {
            $this->fields[$f->getName()] = $f;
        }
        return $this;
    }

    /**
     * Validates a set of data against this model.
     *
     * @param array $data A field name => data array.
     * @return array
     */
    public function validate(array $data): array
    {
        $this->_data = $data;
        $validate = [];
        $errors = [];

        // validate data
        foreach ($data as $name => $d) {
            // expected?
            if (!array_key_exists($name, $this->fields)) {
                $errors[$name] = "Field $name does not exist in this model";
                continue;
            }

            // call the datatype validator
            $field = $this->fields[$name];
            try {
                $validate[$name] = $field->getDatatype()->validate($d, $this);
            } catch (Exception $e) {
                $errors[$name] = $e->getMessage();
            }

            // call class validators.
            foreach ($field->getValidators() as $validatorName => $options) {
                // special case
                if ($validatorName === Datatype::REQUIRED) {
                    continue;
                }

                try {
                    $validate[$name] = ValidatorFactory::class($validatorName)::validate(
                        $validate[$name],
                        $options,
                        $field->getDatatype(),
                        $this
                    );
                } catch (Exception $e) {
                    $errors[$name] = $e->getMessage();
                }
            }
        }

        // now validate fields, since you may have some that were not in data.
        foreach ($this->fields as $name => $field) {
            // if in field list but not in data
            if (!array_key_exists($name, $data)) {
                // call class validators.
                foreach ($field->getValidators() as $validatorName => $options) {
                    if ($validatorName === Datatype::REQUIRED) {
                        if (!array_key_exists($name, $validate)
                            && !array_key_exists($name, $errors)
                        ) {
                            $errors[$name] = "Field $name is missing";
                        }
                        continue;
                    }

                    try {
                        $v = ValidatorFactory::class($validatorName)::validate(
                            null,
                            $options,
                            $field->getDatatype(),
                            $this
                        );
                    } catch (Exception $e) {
                        $errors[$name] = $e->getMessage();
                    }
                }
            }
        }
        $this->_data = [];
        return ['validated' => $validate, 'errors' => $errors];
    }

    /**
     * Serializes this model to JSON.
     *
     * @return array
     */
    public function serialize(): array
    {
        $fields = array_map(
            function ($f) {
                return [
                    'datatype' => $f->getDatatype()->getName(),
                    'validators' => $f->getValidators(),
                    'renderable' => $f->getRenderables()
                ];
            },
            $this->fields
        );
        $model = [
            'name' => $this->name,
            'renderable' => $this->renderable,
            'fields' => $fields
        ];
        return $model;
    }

    public function toJSON(): string
    {
        $t = json_encode($this->serialize());
        if (!$t) {
            throw new Exception('Cannot serialize');
        }
        return $t;
    }

    public function toGraphqlQuery(): string
    {
        $defs = [];
        foreach ($this->getFields() as $field) {
            /**
             * @var Field $field
             */
            $defs[] = $field->toGraphqlQuery();
        }
        return join("\n", $defs);
    }

    /**
     * Generates a Graphql Type definition for this model.
     *
     * @return string
     */
    public function toGraphqlTypeDefinition(): string
    {
        $defs = [];
        foreach ($this->getFields() as $field) {
            /**
             * @var Field $field
             */
            $defs[] = $field->toGraphqlTypeDefinition();
        }
        $renderables = $this->getRenderables();
        $r = array_map(
            function ($name, $value) {
                $v = $value;
                if (is_string($value)) {
                    $v = '"' . str_replace('"', '\\"', $value) . '"';
                }
                return ' ' . $name . ': ' . $v;
            },
            array_keys($renderables),
            $renderables
        );

        return 'type ' . $this->getName() .
            ($this->renderable ? join("\n", $r) : '') .
            " {\n  " .
            str_replace("\n", "\n  ", join("", $defs)) .
            "\n}\n\n";
    }

    /**
     * Renders a readonly view of the model with given data.
     *
     * @param FrameworkComposer $composer
     * @param array $modelData Actual data for the fields to render. Can be empty.
     * @param string[]|callable $restrictFields If present, restrict rendered fields. Can either
     * be an array of strings (field names) or a callback which is called for each field.
     * Callable signature: (Field $field, Model $m, array $modelData): boolean
     * @return HTMLNode[]
     */
    public function viewableNodes(FrameworkComposer $composer, array $modelData, $restrictFields = null): array
    {
        $this->_data = $modelData;
        $this->_restrictFields = $restrictFields;
        $r = $composer->viewableNodes($this, $modelData);
        $this->_data = [];
        $this->_restrictFields = null;
        return $r;
    }

    /**
     * Renders a readonly view of the model with given data.
     *
     * @param FrameworkComposer $composer
     * @param array $modelData Actual data for the fields to render. Can be empty.
     * @param string[]|callable $restrictFields If present, restrict rendered fields. Can either
     * be an array of strings (field names) or a callback which is called for each field.
     * Callable signature: (Field $field, Model $m, array $modelData): boolean
     * @return string
     */
    public function viewable(FrameworkComposer $composer, array $modelData, $restrictFields = null): string
    {
        $this->_data = $modelData;
        $this->_restrictFields = $restrictFields;
        $r = $composer->viewable($this, $modelData);
        $this->_data = [];
        $this->_restrictFields = null;
        return $r;
    }

    /**
     * Renders a form view of the model with given data.
     *
     * @param FrameworkComposer $composer
     * @param array $modelData
     * @param string[]|callable $restrictFields If present, restrict rendered fields. Can either
     * be an array of strings (field names) or a callback which is called for each field.
     * Callable signature: (Field $field, Model $m, array $modelData): boolean
     * @return HTMLNode[]
     */
    public function editableNodes(FrameworkComposer $composer, array $modelData = [], $restrictFields = null): array
    {
        $this->_data = $modelData;
        $this->_restrictFields = $restrictFields;
        $r = $composer->editableNodes($this, $modelData);
        $this->_data = [];
        $this->_restrictFields = null;
        return $r;
    }

    /**
     * Renders a form view of the model with given data.
     *
     * @param FrameworkComposer $composer
     * @param array $modelData
     * @param string[]|callable $restrictFields If present, restrict rendered fields. Can either
     * be an array of strings (field names) or a callback which is called for each field.
     * Callable signature: (Field $field, Model $m, array $modelData): boolean
     * @return string
     */
    public function editable(FrameworkComposer $composer, array $modelData = [], $restrictFields = null): string
    {
        $this->_data = $modelData;
        $this->_restrictFields = $restrictFields;
        $r = $composer->editable($this, $modelData);
        $this->_data = [];
        $this->_restrictFields = null;
        return $r;
    }

    /**
     * Generates random data for this model
     *
     * @return array An associative array field name => data.
     */
    public function getRandom(): array
    {
        $data = [];
        foreach ($this->getFields() as $f) {
            $data[$f->getName()] = $f->getDatatype()->getRandom();
        }
        return $data;
    }

    /**
     * Returns an array with the default values of each field
     *
     * @return array Field name => value
     */
    public function getDefault(): array
    {
        $data = [];
        foreach ($this->getFields() as $f) {
            $data[$f->getName()] = $f->getDatatype()->getDefault();
        }
        return $data;
    }

    /**
     * Parses struct
     *
     * @param array $data
     * @throws Exception
     * @return void
     */
    protected function parseStruct(array $data)
    {
        if (!array_key_exists('name', $data)) {
            throw new Exception('Missing name in model');
        }
        if (!array_key_exists('fields', $data)) {
            throw new Exception('Missing fields in model');
        }
        $this->name = $data['name'];
        foreach ($data['fields'] as $fieldName => $fieldData) {
            $this->fields[$fieldName] = Field::getFromData($fieldName, $fieldData);
        }
        if (array_key_exists('renderable', $data)) {
            if (!is_array($data['renderable'])) {
                throw new Exception('Model extension must be an array');
            }
            $this->renderable = $data['renderable'];
        }
    }
}
