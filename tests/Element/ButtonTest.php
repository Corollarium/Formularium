<?php declare(strict_types=1);

namespace FormulariumTests\Element;

use Formularium\Element;
use Formularium\FrameworkComposer;
use Formularium\Frontend\Blade\Framework;

class ButtonTest extends \PHPUnit\Framework\TestCase
{
    public function testButton()
    {
        $composer = FrameworkComposer::create(['HTML']);
        $string = $composer->element('Button', [Element::LABEL => 'Submit']);
        $this->assertStringContainsString('<button', $string);
    }
}
