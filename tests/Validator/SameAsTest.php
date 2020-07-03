<?php declare(strict_types=1);

use Formularium\DatatypeFactory;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorFactory;
use Formularium\Validator\SameAs;
use PHPUnit\Framework\TestCase;

class SameAsTest extends TestCase
{
    public function testNoModel()
    {
        $this->expectException(ValidatorException::class);
        $v = ValidatorFactory::class('SameAs')::validate(
            "b",
            [],
            DatatypeFactory::factory('string'),
            null
        );
    }
}
