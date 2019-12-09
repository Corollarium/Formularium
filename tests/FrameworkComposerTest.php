<?php

declare(strict_types=1);

use Formularium\Exception\Exception;
use Formularium\FrameworkComposer;
use PHPUnit\Framework\TestCase;

final class FrameworkComposerTest extends TestCase
{
    public function testFactory()
    {
        FrameworkComposer::set(["HTML"]);
        $this->assertIsArray(FrameworkComposer::get());
        $this->assertEquals(1, count(FrameworkComposer::get()));
        $this->assertInstanceOf(Formularium\Frontend\HTML\Framework::class, FrameworkComposer::get()[0]);
    }

    public function testFactoryFail()
    {
        $this->expectException(Exception::class);
        $f = FrameworkComposer::set(["asdfas"]);
    }
}
