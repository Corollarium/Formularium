<?php

declare(strict_types=1);

use Formularium\Exception\Exception;
use Formularium\Framework;
use PHPUnit\Framework\TestCase;

final class FrameworkTest extends TestCase
{
    public function testFactoryFail()
    {
        $this->expectException(Exception::class);
        Framework::factory("nanana");
    }

    public function testFactory()
    {
        $f = Framework::factory("HTML");
        $this->assertEquals('HTML', $f->getName());
    }
}
