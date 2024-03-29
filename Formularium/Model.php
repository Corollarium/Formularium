<?php declare(strict_types=1);

namespace Formularium;

use Formularium\Exception\Exception;
use Formularium\Exception\NoRandomException;
use Formularium\Factory\ValidatorFactory;

/**
 * Model class, representing a whole object.
 */
class Model
{
    use ExtradataTrait;

    /**
     * @var string
     */
    public $name;

    /**
     * @var Field[]
     */
    public $fields = [];

    /**
     * @var array
     */
    public $renderable = [];

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
    public function __construct(string $name = '')
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
     * @return Field[]
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

    /**
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function appendRenderable(string $name, $value): self
    {
        $this->renderable[$name] = $value;
        return $this;
    }

    public function getField(string $name): Field
    {
        return $this->fields[$name];
    }

    /**
     * Returns the first field matching a function.
     *
     * @param callable $function. Receives a Field as argument.
     * @return Field
     */
    public function firstField(callable $function): ?Field
    {
        foreach ($this->getFields() as $f) {
            if ($function($f)) {
                return $f;
            }
        }
        return null;
    }

    /**
     * filter operation for fields that return true for callable.
     *
     * @param callable $function. Receives a Field as argument.
     * @return Field[]
     */
    public function filterField(callable $function): array
    {
        return array_filter(
            $this->fields,
            $function
        );
    }

    /**
     * @param callable $function
     * @return array
     */
    public function mapFields(callable $function): array
    {
        $data = [];
        foreach ($this->fields as $field) {
            $data[] = $function($field);
        }
        return $data;
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
                /**
                 * @var string $validatorName
                 */
                // special case
                if ($validatorName === Datatype::REQUIRED) {
                    continue;
                }

                try {
                    $validate[$name] = ValidatorFactory::class($validatorName)::validate(
                        $validate[$name],
                        $options,
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
                    /**
                     * @var string $validatorName
                     */
                    if ($validatorName === Datatype::REQUIRED) {
                        if (!array_key_exists($name, $validate)
                            && !array_key_exists($name, $errors)
                        ) {
                            $errors[$name] = "Field $name is missing";
                        }
                        continue;
                    }

                    try {
                        ValidatorFactory::class($validatorName)::validate(
                            null,
                            $options,
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
            function (Field $f) {
                return [
                    'datatype' => $f->getDatatype()->getName(),
                    'validators' => $f->getValidators(),
                    'renderable' => $f->getRenderables(),
                    'extradata' => $f->getExtradataSerialize()
                ];
            },
            $this->fields
        );
        $model = [
            'name' => $this->name,
            'renderable' => $this->renderable,
            'extradata' => $this->getExtradataSerialize(),
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

    /**
     * Renders a readonly view of the model with given data.
     *
     * @param FrameworkComposer $composer
     * @param array $modelData Actual data for the fields to render. Can be empty.
     * @param string[]|callable $restrictFields If present, restrict rendered fields. Can either
     * be an array of strings (field names) or a callback which is called for each field.
     * Callable signature: (Field $field, Model $m): boolean
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
     * @param string[]|callable $restrictFields If present, restrict rendered fields. Can either
     * be an array of strings (field names) or a callback which is called for each field.
     * If a list of strings, only process the field names present in that list.
     * If it's a callable, it may fill `$data` with a random value
     * (you can call `$field->getDatatype()->getRandom()` for the default). The entire $data
     * array is provided (note it should be a reference in the callable parameter!) so you
     * can use a different key than `$field->getName()` or fill more than one value.
     * Callable signature: (Field $field, Model $m, array &$data): void
     * @return array An associative array field name => data.
     */
    public function getRandom($restrictFields = null): array
    {
        $data = [];

        foreach ($this->fields as $field) {
            /**
             * @var Field $field
             */
            if (is_array($restrictFields) && !in_array($field->getName(), $restrictFields)) {
                continue;
            } elseif (is_callable($restrictFields)) {
                try {
                    $restrictFields($field, $this, $data);
                } catch (NoRandomException $e) {
                    // pass
                }
            } else {
                $data[$field->getName()] = $field->getDatatype()->getRandom();
            }
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
            $d = $f->getDatatype()->getDefault();
            if ($d === '' || $d === null) {
                $d = $f->getRenderable(RenderableParameter::DEFAULTVALUE, null);
            }
            $data[$f->getName()] = $d;
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
                throw new Exception('Model renderable must be an array');
            }
            $this->renderable = $data['renderable'];
        }
        if (array_key_exists('extradata', $data)) {
            if (!is_array($data['extradata'])) {
                throw new Exception('Model extradata must be an array');
            }
            foreach ($data['extradata'] as $mData) {
                $this->extradata[] = new Extradata($mData['name'], $mData['args']);
            }
        }
    }
}
