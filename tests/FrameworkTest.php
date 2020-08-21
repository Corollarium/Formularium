<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Factory\FrameworkFactory;
use PHPUnit\Framework\TestCase;

final class FrameworkTest extends TestCase
{
    public function testFactoryFail()
    {
        $this->expectException(ClassNotFoundException::class);
        FrameworkFactory::factory("nanana");
    }

    public function testFactory()
    {
        $f = FrameworkFactory::factory("HTML");
        $this->assertEquals('HTML', $f->getName());
    }
}
