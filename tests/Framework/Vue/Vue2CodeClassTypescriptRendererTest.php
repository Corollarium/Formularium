<?php declare(strict_types=1);

namespace FormulariumTests\Framework\Vue;

use Formularium\Frontend\Vue\Vue2CodeClassTypescriptRenderer;
use Formularium\Frontend\Vue\VueCode\Prop;

class Vue2CodeClassTypescriptRendererTest extends VueCodeRendererBaseTestCase
{
    public const RENDERER_CLASS = Vue2CodeClassTypescriptRenderer::class;

    public function testBase()
    {
        $vueStruct = $this->getBase(self::RENDERER_CLASS);
        $code = $vueStruct->vueCode->toScript($vueStruct->model, []);
        $expected = <<<EOF
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class TestModel extends Vue {
  someInteger = 10;

  get plusOne() { return this.someInteger + 1; }
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
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class TestModel extends Vue {
    @Prop({
        "default": 30
    }) readonly someProp!: number;

    someInteger = 10;

    get plusOne() { return this.someInteger + 1; }
};
EOF;
        $this->assertVueCodeEquals($expected, $code);
    }

    public function testProp()
    {
        $vueStruct = $this->getBaseAsProp(self::RENDERER_CLASS);
        $code = $vueStruct->vueCode->toScript($vueStruct->model, []);
        $expected = <<<EOF
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class TestModel extends Vue {
    @Prop({
        "default": 10
    }) readonly someInteger: integer;

    get plusOne() { return this.someInteger + 1; }
};
EOF;
        $this->assertVueCodeEquals($expected, $code);
    }
}
