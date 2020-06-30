<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Exception\Exception;
use Formularium\Validator;
use Formularium\Validator\SameAs;
use Formularium\ValidatorInterface;
use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase
{
    public function testFactory()
    {
        $r = Validator::class('SameAs');
        $this->assertEquals(SameAs::class, $r);
    }
    
    public function testFactoryFail()
    {
        $this->expectException(Exception::class);
        Validator::class('stringasdf');
    }

    public function testValidatorGraphQL()
    {
        $metadata = Validator::class('SameAs')::getMetadata();
        $graphql = $metadata->toGraphql();
        $expected = <<<EOF
"""
Must be the same as a target field.
"""
directive @SameAs(
    """
    Target field
    """
    target: String
) on FIELD_DEFINITION

EOF;
        $this->assertEquals($expected, $graphql);
    }
}
