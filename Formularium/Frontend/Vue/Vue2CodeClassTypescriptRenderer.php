<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\Datatype;
use Formularium\Datatype\Datatype_bool;
use Formularium\Datatype\Datatype_number;
use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\Frontend\Vue\VueCode\Computed;
use Formularium\Frontend\Vue\VueCode\Prop;
use Formularium\HTMLNode;
use Formularium\Model;

use function Safe\json_encode;

class Vue2CodeClassTypescriptRenderer extends VueCodeAbstractRenderer
{
    /**
     * Generates valid JS code for the props.
     *
     * @param array $props
     * @return string
     */
    protected function serializeProps(array $props): string
    {
        $s = array_map(function ($p) {
            return "'{$p['name']}': { 'type': {$p['type']}" . ($p['required'] ?? false ? ", 'required': true" : '') . " } ";
        }, $props);
        return "{\n        " . implode(",\n        ", $s) . "\n    }";
    }

    public function getTemplateData(Model $m, array $elements): array
    {
        // get the props array with all js data
        $props = $this->vueCode->props($m);
        // get only props names
        $propsNames = array_map(
            function (Prop $p) {
                return $p->name;
            },
            $props
        );
        /**
         * @var array $propsNames
         */
        $propsNames = array_combine($propsNames, $propsNames);

        // get data, and avoid anything that is already declared in props
        $data = [];
        foreach (array_merge($m->getDefault(), $m->getData(), $this->vueCode->extraData) as $k => $v) {
            if (array_key_exists($k, $propsNames)) {
                continue;
            }
            if ($v === '') {
                $v = $m->getDefault()[$k] ?: '""';
            }
            $data[$k] = $v;
        }
        $classData = [];
        foreach ($data as $k => $v) {
            $classData[] = "$k = $v;";
        }

        $templateData = [
            'classData' => implode("\n", $classData),
            'propsCode' => implode(
                "\n",
                array_map(
                    function (Prop $p) {
                        return $p->toDecorator();
                    },
                    $props
                )
            ),
            'propsBind' => implode(
                ' ',
                array_map(
                    function (Prop $p) {
                        return $p->toBind();
                    },
                    $props
                )
            ),
            'imports' => implode(
                "\n",
                array_map(function ($key, $value) {
                    return "import $key from \"$value\";";
                }, array_keys($this->vueCode->imports), $this->vueCode->imports)
            ),
            'computedCode' => implode(
                "\n",
                array_map(
                    function (Computed $c) {
                        return $c->toGetter();
                    },
                    $this->vueCode->computed
                )
            ),
            'otherData' => implode(
                ",\n",
                expandJS($this->vueCode->other)
            ),
            'methodsCode' => implode(
                "\n",
                array_map(function ($key, $value) {
                    return "$key { $value }";
                }, array_keys($this->vueCode->methods), $this->vueCode->methods)
            ),
            'componentOptions' => ''
        ];

        // TODO: fill with components.
        // $componentOptions = array_filter([
        //     'components' => [
        //     ],
        // ]);
        // if ($componentOptions) {
        //     $templateData['componentOptions'] = '(' . json_encode($componentOptions) . ')';
        // }

        if ($templateData['otherData']) {
            $templateData['otherData'] .= ",\n";
        }

        return $templateData;
    }

    protected function fillTemplate(string $template, array $data, Model $m): string
    {
        foreach ($data as $name => $value) {
            $template = str_replace(
                '{{' . $name . '}}',
                $value,
                $template
            );
        }

        $template = str_replace(
            '{{modelName}}',
            $m->getName(),
            $template
        );
        $template = str_replace(
            '{{modelNameLower}}',
            mb_strtolower($m->getName()),
            $template
        );
        return $template;
    }

    /**
     * Generates the javascript code.
     *
     * @param Model $m
     * @param HTMLNode[] $elements
     * @return string
     */
    public function toScript(Model $m, array $elements)
    {
        $templateData = $this->getTemplateData($m, $elements);

        $viewableTemplate = <<<EOF
import { Component, Prop, Vue } from "vue-property-decorator";
{{imports}}

@Component{{componentOptions}}
export default class {{className}} extends Vue {
    {{propsCode}}

    {{otherData}}

    {{classData}}

    {{computedCode}}

    {{methodsCode}}
};
EOF;

        $templateData['className'] = $m->getName(); // TODO

        return $this->fillTemplate(
            $viewableTemplate,
            $templateData,
            $m
        );
    }


    /**
     * Generates the javascript code.
     *
     * @param Model $m
     * @param HTMLNode[] $elements
     * @return string
     */
    public function toVariable(Model $m, array $elements)
    {
        $templateData = $this->getTemplateData($m, $elements);

        $viewableTemplate = <<<EOF
    {{otherData}}
    data() {
        return {{jsonData}};
    },
    computed: { {{computedCode}} },
    props: {{propsCode}},
    methods: { {{methodsCode}} }
EOF;

        return $this->fillTemplate(
            $viewableTemplate,
            $templateData,
            $m
        );
    }
}
