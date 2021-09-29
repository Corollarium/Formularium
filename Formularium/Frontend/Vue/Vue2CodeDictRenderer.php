<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue;

use Formularium\Datatype;
use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\Frontend\Vue\VueCode\Computed;
use Formularium\Frontend\Vue\VueCode\Prop;
use Formularium\HTMLNode;
use Formularium\Model;
use Formularium\RenderableParameter;

use function Safe\json_encode;

class Vue2CodeDictRenderer extends VueCodeAbstractRenderer
{
    /**
     * Generates template data for rendering
     *
     * @param Model $m
     * @param HTMLNode[] $elements $elements
     * @return array
     */
    public function getTemplateData(Model $m, array $elements): array
    {
        // get the props array with all js data
        $props = $this->vueCode->props($m);
        // get only props names
        $propsNames = array_map(
            function ($p) {
                return $p->name;
            },
            $props
        );
        /**
         * @var array $propsNames
         */
        $propsNames = array_combine($propsNames, $propsNames);
        // get the binding
        $propsBind = array_map(
            function (Prop $p) {
                return $p->toBind();
            },
            $props
        );

        // get data, and avoid anything that is already declared in props
        $data = [];
        foreach (array_merge($m->getDefault(), $m->getData(), $this->vueCode->extraData) as $k => $v) {
            if (array_key_exists($k, $propsNames)) {
                continue;
            }
            $data[$k] = $v;
        }
        // ensure it's a dict even if empty
        if ($data === []) {
            $jsonData = '{}';
        } else {
            $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        }

        $templateData = [
            'jsonData' => $jsonData,
            'propsCode' => implode(
                "\n",
                array_map(function (Prop $p) {
                    return $p->toStruct();
                }, $props)
            ),
            'propsBind' => implode(' ', $propsBind),
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
                        return $c->toStruct();
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
                    return "$key { $value },";
                }, array_keys($this->vueCode->methods), $this->vueCode->methods)
            ),
        ];
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
{{imports}}

export default {
    {{otherData}}
    data() {
        return {{jsonData}};
    },
    computed: { {{computedCode}} },
    props: { {{propsCode}} },
    methods: { {{methodsCode}} }
};
EOF;

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
    public function toClassScript(Model $m, array $elements)
    {
        $templateData = $this->getTemplateData($m, $elements);

        $viewableTemplate = <<<EOF
{{imports}}

@Component({ components: { } })
export default class {{name}} extends Vue {
    {{otherData}}
    data() {
        return {{jsonData}};
    },
    computed: { {{computedCode}} },

    @Prop({})

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
