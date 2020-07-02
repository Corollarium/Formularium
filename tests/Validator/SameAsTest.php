<?php declare(strict_types=1);

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Validator;
use Formularium\Validator\NotIn;
use PHPUnit\Framework\TestCase;

class SameAsTest extends TestCase
{
    public function testNoModel()
    {
        $this->expectException(ValidatorException::class);
        $v = Validator::class('SameAs')::validate(
            "b",
            [],
            Datatype::factory('string'),
            null
        );
    }
}
