<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Factory\DatatypeFactory;
use Formularium\Exception\Exception;
use Formularium\Factory\FrameworkFactory;
use Formularium\Factory\RenderableFactory;
use Formularium\Renderable;
use PHPUnit\Framework\TestCase;

final class RenderableTest extends TestCase
{
    public function testFactory()
    {
        $r = RenderableFactory::factory('string', FrameworkFactory::factory('HTML'));
        $this->assertInstanceOf(Renderable::class, $r);
    }
    
    public function testFactoryTypes()
    {
        $r = RenderableFactory::factory(DatatypeFactory::factory('string'), FrameworkFactory::factory('HTML'));
        $this->assertInstanceOf(Renderable::class, $r);
    }
    
    public function testFactoryFail()
    {
        $this->expectException(Exception::class);
        RenderableFactory::factory('stringasdf', FrameworkFactory::factory('HTML'));
    }
}
