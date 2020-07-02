<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Exception\Exception;
use Formularium\Validator;
use Formularium\Validator\SameAs;
use Formularium\ValidatorArgs;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;
use PHPUnit\Framework\TestCase;

final class ValidatorMetadataTest extends TestCase
{
    public function testHasArgument()
    {
        $v = new ValidatorMetadata(
            'name',
            'comment',
            [
                new ValidatorArgs(
                    'subname',
                    'string',
                    'subcomment'
                )
            ]
        );
        $this->assertTrue($v->hasArgument('subname'));
        $this->assertFalse($v->hasArgument('subnsdfame'));
    }

    public function testArgument()
    {
        $v = new ValidatorMetadata(
            'name',
            'comment',
            [
                new ValidatorArgs(
                    'subname',
                    'string',
                    'subcomment'
                )
            ]
        );
        $this->assertNotNull($v->argument('subname'));
        $this->assertNull($v->argument('subnsdfame'));
    }
}
