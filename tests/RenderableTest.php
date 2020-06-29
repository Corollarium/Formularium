<?php declare(strict_types=1); 

namespace FormulariumTests;

use Formularium\Datatype;
use Formularium\Exception\Exception;
use Formularium\Frontend\Bulma\Framework;
use Formularium\Renderable;
use PHPUnit\Framework\TestCase;

final class RenderableTest extends TestCase
{
    public function testFactory()
    {
        $r = Renderable::factory('string', Framework::factory('HTML'));
        $this->assertInstanceOf(Renderable::class, $r);
    }
    
    public function testFactoryTypes()
    {
        $r = Renderable::factory(Datatype::factory('string'), Framework::factory('HTML'));
        $this->assertInstanceOf(Renderable::class, $r);
    }
    
    public function testFactoryFail()
    {
        $this->expectException(Exception::class);
        Renderable::factory('stringasdf', Framework::factory('HTML'));
    }
}
