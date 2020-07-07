<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;
use Formularium\FrameworkComposer;
use PHPUnit\Framework\TestCase;

final class FrameworkComposerTest extends TestCase
{
    public function testFactory()
    {
        $f = FrameworkComposer::create(["HTML"]);
        $this->assertIsArray($f->getFrameworks());
        $this->assertEquals(1, count($f->getFrameworks()));
        $this->assertInstanceOf(\Formularium\Frontend\HTML\Framework::class, $f->getFrameworks()[0]);
        $this->assertInstanceOf(\Formularium\Frontend\HTML\Framework::class, $f->getByName('HTML'));
        $this->assertNull($f->getByName('cvbcbv'));
    }

    public function testFactoryFail()
    {
        $this->expectException(ClassNotFoundException::class);
        $f = (new FrameworkComposer())->setFrameworks(["asdfas"]);
    }
}
