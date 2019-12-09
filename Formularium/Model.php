<?php

namespace Formularium;

use Formularium\Exception\Exception;
use Formularium\Framework;

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
    protected function __construct(string $name = '', $framework = 'HTML')
    {
        $this->name = $name;
    }

    public static function fromStruct(array $struct, $framework = 'HTML') : Model
    {
        $m = new static('', $framework);
        $m->parseStruct($struct);
        return $m;
    }

    public static function fromJSONFile(string $name, $framework = 'HTML') : Model
    {
        $json = file_get_contents($name); // TODO: path
        if ($json === false) {
            throw new Exception('File not found');
        }
        return static::fromJSON($json, $framework);
    }

    public static function fromJSON(string $json, $framework = 'HTML') : Model
    {
        $data = \json_decode($json, true);
        $m = new static('', $framework);
        $m->parseStruct($data);
        return $m;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFramework(): Framework
    {
        return $this->framework;
    }

    public function getFields() : array
    {
        return $this->fields;
    }

    protected function validate($data): array
    {
        $validate = [];
        foreach ($data as $name => $d) {
            if (!array_key_exists($name, $this->fields)) {
                $validate[$name] = [
                    "Field $name does not exist in this model"
                ];
                continue;
            }
            $field = $this->fields[$name];
            $v = $field->getDatatype()->validate($d, $field);
            if ($v) {
                $validate[$name] = $v;
            }
        }
        return $validate;
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
     * @param string $file
     * @throws Exception
     * @return void
     */
    protected function parseStruct($data)
    {
        if ($data === null) {
            throw new Exception('Invalid JSON format');
        }
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
