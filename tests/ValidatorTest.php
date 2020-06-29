<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Exception\Exception;
use Formularium\Validator;
use Formularium\ValidatorInterface;
use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase
{
    public function testFactory()
    {
        $r = Validator::factory('SameAs');
        $this->assertInstanceOf(ValidatorInterface::class, $r);
    }
    
    public function testFactoryFail()
    {
        $this->expectException(Exception::class);
        Validator::factory('stringasdf');
    }

    public function testValidatorGraphQL()
    {
        $r = Validator::factory('SameAs');
        $metadata = $r->getMetadata();
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
