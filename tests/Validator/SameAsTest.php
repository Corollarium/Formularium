<?php declare(strict_types=1);

use Formularium\Factory\DatatypeFactory;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\Factory\ValidatorFactory;
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
            null
        );
    }
}
