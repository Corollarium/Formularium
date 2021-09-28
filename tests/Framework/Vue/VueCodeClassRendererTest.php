<?php declare(strict_types=1);

namespace FormulariumTests\Framework\Vue;

use Formularium\Element;
use Formularium\FrameworkComposer;
use Formularium\Frontend\Blade\Framework;
use Formularium\Frontend\Vue\VueCode;
use Formularium\Frontend\Vue\VueCodeClassRenderer;

class VueCodeClassRendererTest extends VueCodeRendererBaseTestCase
{
    public function testBase()
    {
        $vueStruct = $this->getBase(VueCodeClassRenderer::class);
        $code = $vueStruct->vueCode->toScript($vueStruct->model, []);
        $expected = <<<EOF
import { Component, Prop, Vue } from "vue-property-decorator";

export default class TestModel extends Vue {
    someInteger = 10;

    get plusOne() { return this.someInteger + 1; }
};
EOF;
        echo $this->prettier("<template><div></div></template><script>\n$code\n</script>"),
        $this->assertEquals(
            $this->prettier("<template><div></div></template><script>\n$expected\n</script>"),
            $this->prettier("<template><div></div></template><script>\n$code\n</script>")
        );
    }
}
