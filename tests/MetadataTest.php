<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Exception\Exception;
use Formularium\Validator;
use Formularium\Validator\SameAs;
use Formularium\MetadataParameter;
use Formularium\ValidatorInterface;
use Formularium\Metadata;
use PHPUnit\Framework\TestCase;

final class MetadataTest extends TestCase
{
    public function testHasArgument()
    {
        $v = new Metadata(
            'name',
            'comment',
            [
                new MetadataParameter(
                    'subname',
                    'string',
                    'subcomment'
                )
            ]
        );
        $this->assertTrue($v->hasParameter('subname'));
        $this->assertFalse($v->hasParameter('subnsdfame'));
    }

    public function testArgument()
    {
        $v = new Metadata(
            'name',
            'comment',
            [
                new MetadataParameter(
                    'subname',
                    'string',
                    'subcomment'
                )
            ]
        );
        $this->assertNotNull($v->parameter('subname'));
        $this->assertNull($v->parameter('subnsdfame'));
    }
}
