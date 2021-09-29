<?php declare(strict_types=1);

namespace FormulariumTests\Framework\Vue;

use Formularium\Element;
use Formularium\FrameworkComposer;
use Formularium\Frontend\Blade\Framework;
use Formularium\Frontend\Vue\Vue2CodeDictRenderer;
use Formularium\Frontend\Vue\VueCode;
use Formularium\Frontend\Vue\VueCode\Prop;
use Formularium\Frontend\Vue\VueCodeClassRenderer;
use Formularium\Frontend\Vue\VueCodeDictRenderer;

class Vue2CodeDictRendererTest extends VueCodeRendererBaseTestCase
{
    public const RENDERER_CLASS = Vue2CodeDictRenderer::class;

    public function testBase()
    {
        $vueStruct = $this->getBase(self::RENDERER_CLASS);
        $code = $vueStruct->vueCode->toScript($vueStruct->model, []);
        $expected = <<<EOF
export default {
    data() {
        return {
            "someInteger": 10
        };
    },
    computed: {
        plusOne() { return this.someInteger + 1; }
    },
    props: { },
    methods: { }
};
EOF;
        $this->assertVueCodeEquals($expected, $code);
    }

    public function testExtraProp()
    {
        $vueStruct = $this->getBase(self::RENDERER_CLASS);
        $vueStruct->vueCode->appendExtraProp(
            new Prop(
                'someProp',
                'number',
                true,
                30
            )
        );
        $code = $vueStruct->vueCode->toScript($vueStruct->model, []);
        $expected = <<<EOF
export default {
    data() {
        return {
            "someInteger": 10
        };
    },
    computed: {
        plusOne() { return this.someInteger + 1; }
    },
    props: {
        "someProp": {
            type: Number,
            required: true,
            default: 30
        }
    },
    methods: { }
};
EOF;
        $this->assertVueCodeEquals($expected, $code);
    }

    public function testProp()
    {
        $this->markTestSkipped();
        $vueStruct = $this->getBase(self::RENDERER_CLASS);
        $code = $vueStruct->vueCode->toScript($vueStruct->model, []);
        $expected = <<<EOF
export default {
    computed: {
        plusOne() { return this.someInteger + 1; }
    },
    props: {
        someInteger: {
            type: Number,
            required: true,
            default: 30
        }
    },
    methods: {},
};
EOF;
        $this->assertVueCodeEquals($expected, $code);
    }
}
