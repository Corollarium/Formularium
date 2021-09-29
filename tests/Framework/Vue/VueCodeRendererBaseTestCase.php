<?php declare(strict_types=1);

namespace FormulariumTests\Framework\Vue;

use Exception;
use Formularium\Datatype;
use Formularium\Field;
use Formularium\Frontend\Vue\VueCode;
use Formularium\Model;
use Formularium\RenderableParameter;

class VueCodeRendererBaseTestCase extends \PHPUnit\Framework\TestCase
{
    public function getBase(string $renderer): VueStruct
    {
        $vueCode = new VueCode($renderer);
        $vueCode->appendComputed(
            'plusOne',
            'return this.someInteger + 1'
        );

        $model = new Model('TestModel');
        $model->appendFields(
            [
                new Field(
                    'someInteger',
                    'integer',
                    [
                        RenderableParameter::DEFAULTVALUE => 10
                    ],
                    [
                        Min::class => [
                            'value' => 4
                        ],
                        Max::class => [
                            'value' => 30
                        ],
                        Datatype::REQUIRED => [
                            'value' => true
                        ],
                    ],
                )
            ]
        );

        return new VueStruct($vueCode, $model);
    }

    protected function prettier(string $code): string
    {
        $basepath = __DIR__ . '/../../..';
        $command = "cd $basepath && yarn --silent prettier --parser vue --stdin-filepath test.vue ";

        $descriptorspec = array(
            0 => array("pipe", "r"), //input pipe
            1 => array("pipe", "w"), //output pipe
            2 => array("pipe", "w"), //error pipe
        );
        $output = '';
        //calling script with max execution time 15 second
        $process = proc_open("$command", $descriptorspec, $pipes);
        if (is_resource($process)) {
            fwrite($pipes[0], $code);
            fclose($pipes[0]);
            $output = stream_get_contents($pipes[1]); //getting output of the script
            fclose($pipes[1]);
            $error = stream_get_contents($pipes[2]); //getting output of the script
        } else {
            throw new Exception("cannot run prettier");
        }
        proc_close($process);
        return $output;
    }
}
