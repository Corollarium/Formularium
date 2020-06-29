<?php declare(strict_types=1);

namespace FormulariumTests;

use Formularium\Exception\ClassNotFoundException;
use Formularium\Exception\Exception;
use Formularium\Framework;
use PHPUnit\Framework\TestCase;

final class FrameworkTest extends TestCase
{
    public function testFactoryFail()
    {
        $this->expectException(ClassNotFoundException::class);
        Framework::factory("nanana");
    }

    public function testFactory()
    {
        $f = Framework::factory("HTML");
        $this->assertEquals('HTML', $f->getName());
    }
}
