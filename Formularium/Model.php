<?php

namespace Formularium;

use Formularium\Exception\Exception;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Validates a set of data against this model.
     *
     * @param array $data A field name => data array.
     * @return array
     */
    protected function validate(array $data): array
    {
        $validate = [];
        $errors = [];
        foreach ($data as $name => $d) {
            if (!array_key_exists($name, $this->fields)) {
                $errors[$name] = [
                    "Field $name does not exist in this model"
                ];
                continue;
            }
            $field = $this->fields[$name];
            try {
                $validate[$name] = $field->getDatatype()->validate($d, $field);
            } catch (Exception $e) {
                $errors[$name] = $e->getMessage();
            }
        }
        return ['validated' => $validate, 'errors' => $errors];
    }

    public function viewable(): string
    {
        return FrameworkComposer::viewable($this);
    }

    public function editable(): string
    {
        return FrameworkComposer::editable($this);
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
    }
}
