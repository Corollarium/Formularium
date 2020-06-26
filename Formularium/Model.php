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
    protected $fields;

    /**
     * @var array
     */
    protected $extensions;

    /**
     * Model data being processed.
     * @var array
     */
    protected $_data = [];

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

    public static function create(string $name): Model
    {
        $m = new self($name);
        return $m;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getData(): array
    {
        return $this->_data;
    }

    public function getExtensions(): array
    {
        return $this->extensions;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getExtension(string $name, $default)
    {
        return $this->extensions[$name] ?? $default;
    }

    public function getField(string $name): Field
    {
        return $this->fields[$name];
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
                $validate[$name] = $field->getDatatype()->validate($d, $field->getValidators(), $this);
            } catch (Exception $e) {
                $errors[$name] = $e->getMessage();
            }

            // call class validators.
            foreach ($field->getValidators() as $validatorName => $_) {
                if (mb_strpos($validatorName, '\\') === false) {
                    continue;
                }
                try {
                    $v = Validator::factory($validatorName);
                    $validate[$name] = $v->validate($validate[$name], $field->getValidators(), $this);
                } catch (Exception $e) {
                    $errors[$name] = $e->getMessage();
                }
            }
        }

        foreach ($this->fields as $name => $field) {
            // check REQUIRED.
            if (($field->getValidators()[Datatype::REQUIRED] ?? false)
                && !array_key_exists($name, $validate)
                && !array_key_exists($name, $errors)
            ) {
                $errors[$name] = "Field $name is missing";
            }

            // if in field list but not in data
            if (!array_key_exists($name, $data)) {
                // call class validators.
                foreach ($field->getValidators() as $validatorName => $_) {
                    if (mb_strpos($validatorName, '\\') === false) {
                        continue;
                    }
                    try {
                        $v = Validator::factory($validatorName);
                        $v->validate(null, $field->getValidators(), $this);
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
                    'extensions' => $f->getExtensions()
                ];
            },
            $this->fields
        );
        $model = [
            'name' => $this->name,
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
     * @param array $modelData
     * @return string
     */
    public function viewable(array $modelData): string
    {
        $this->_data = $modelData;
        $r = FrameworkComposer::viewable($this, $modelData);
        $this->_data = [];
        return $r;
    }

    /**
     * Renders a form view of the model with given data.
     *
     * @param array $modelData
     * @return string
     */
    public function editable(array $modelData = []): string
    {
        return FrameworkComposer::editable($this, $modelData);
    }

    public function getRandom(): array
    {
        $data = [];
        foreach ($this->fields as $f) {
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
        foreach ($this->fields as $f) {
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
        if (array_key_exists('extensions', $data)) {
            if (!is_array($data['extensions'])) {
                throw new Exception('Model extension must be an array');
            }
            $this->extensions = $data['extensions'];
        }
    }
}
