<?php declare(strict_types=1);

namespace FormulariumTests\Framework\Vue;

use Formularium\Frontend\Vue\Vue2CodeClassTypescriptRenderer;

class Vue2CodeClassTypescriptRendererTest extends VueCodeRendererBaseTestCase
{
    public const RENDERER_CLASS = Vue2CodeClassTypescriptRenderer::class;

    public function testBase()
    {
        $vueStruct = $this->getBase(self::RENDERER_CLASS);
        $code = $vueStruct->vueCode->toScript($vueStruct->model, []);
        $expected = <<<EOF
import { Component, Prop, Vue } from "vue-property-decorator";

export default class TestModel extends Vue {
    someInteger = 10;

    get plusOne() { return this.someInteger + 1; }
};
EOF;
        $this->assertEquals(
            $this->prettier("<template><div></div></template><script>\n$expected\n</script>"),
            $this->prettier("<template><div></div></template><script>\n$code\n</script>")
        );
    }

    public function testProp()
    {
        $vueStruct = $this->getBase(self::RENDERER_CLASS);
        $vueStruct->vueCode->appendExtraProp(
            'someProp',
            [
                'name' => 'someProp',
                'type' => 'number',
                'required' => true,
                'default' => 30
            ]
        );
        $code = $vueStruct->vueCode->toScript($vueStruct->model, []);
        $expected = <<<EOF
import { Component, Prop, Vue } from "vue-property-decorator";

export default class TestModel extends Vue {
    someInteger = 10;

    @Prop({
        default: 30
    }) readonly someProp!;

    get plusOne() { return this.someInteger + 1; }
};
EOF;
        $this->assertEquals(
            $this->prettier("<template><div></div></template><script>\n$expected\n</script>"),
            $this->prettier("<template><div></div></template><script>\n$code\n</script>")
        );
    }
}
