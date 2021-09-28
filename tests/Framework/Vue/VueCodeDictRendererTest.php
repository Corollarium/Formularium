<?php declare(strict_types=1);

namespace FormulariumTests\Framework\Vue;

use Formularium\Element;
use Formularium\FrameworkComposer;
use Formularium\Frontend\Blade\Framework;
use Formularium\Frontend\Vue\VueCode;
use Formularium\Frontend\Vue\VueCodeClassRenderer;
use Formularium\Frontend\Vue\VueCodeDictRenderer;

class VueCodeDictRendererTest extends VueCodeRendererBaseTestCase
{
    public function testBase()
    {
        $vueStruct = $this->getBase(VueCodeDictRenderer::class);
        $code = $vueStruct->vueCode->toScript($vueStruct->model, []);
        $expected = <<<EOF
export default {
    data() {
        return {
            someInteger: 10
        };
    },
    computed: {
        plusOne() { return this.someInteger + 1; }
    },
    props: {},
    methods: {},
};
EOF;
        echo $this->prettier("<template><div></div></template><script>\n$code\n</script>"),
        $this->assertEquals(
            $this->prettier("<template><div></div></template><script>\n$expected\n</script>"),
            $this->prettier("<template><div></div></template><script>\n$code\n</script>")
        );
    }
}
