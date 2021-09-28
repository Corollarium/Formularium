<?php declare(strict_types=1);

namespace FormulariumTests\Framework\Vue;

use Formularium\Frontend\Vue\VueCode;
use Formularium\Model;

class VueStruct
{
    /**
     * @var VueCode
     */
    public $vueCode;

    /**
     * @var Model
     */
    public $Model;

    public function __construct(VueCode $vueCode, Model $model)
    {
        $this->vueCode = $vueCode;
        $this->model = $model;
    }
}
