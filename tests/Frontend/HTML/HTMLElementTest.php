<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Formularium\Frontend\HTML\HTMLElement;

final class HTMLElementTest extends TestCase
{
    public function testTag()
    {
        $html = new HTMLElement('div');
        $htmldata = '<div></div>';
        $this->assertEquals($htmldata, $html->getRenderHTML());

        $html = new HTMLElement('img');
        $htmldata = '<img>';
        $this->assertEquals($htmldata, $html->getRenderHTML());
    }

    public function testAttributes()
    {
        $html = new HTMLElement('div', array('id'=>'testID'));
        $htmldata = '<div id="testID"></div>';
        $this->assertEquals($htmldata, $html->getRenderHTML());

        $html = new HTMLElement('div', array('id'=>'testID', 'class'=>'testClass'));
        $htmldata = '<div id="testID" class="testClass"></div>';
        $this->assertEquals($htmldata, $html->getRenderHTML());

        $classes = array('testClass1','testClass2');
        $html = new HTMLElement('div', array('id'=>'testID', 'class'=> $classes));
        $htmldata1 = '<div id="testID" class="testClass1 testClass2"></div>';
        $this->assertEquals($htmldata1, $html->getRenderHTML());

        // Overwrite the attribute value
        $html->setAttribute('class', 'testClass');
        $this->assertEquals($htmldata, $html->getRenderHTML());

        // Dont overwrite the attribute values
        $html->addAttributes(array('class' => $classes));
        $htmldata2 = '<div id="testID" class="testClass testClass1 testClass2"></div>';
        $this->assertEquals($htmldata2, $html->getRenderHTML());

        // ADD new atribute value
        $html->addAttribute('title', "this is a title");
        $htmldata2 = '<div id="testID" class="testClass testClass1 testClass2" title="this is a title"></div>';
        $this->assertEquals($htmldata2, $html->getRenderHTML());
    }

    public function testContent()
    {
        $texto = "Hello World!";

        $html = new HTMLElement('div', array(), $texto);
        $htmldata = '<div>' . $texto .'</div>';
        $this->assertEquals($htmldata, $html->getRenderHTML());

        $html2 = new HTMLElement('div', array(), $html);
        $htmldata = '<div><div>' . $texto .'</div></div>';
        $this->assertEquals($htmldata, $html2->getRenderHTML());

        $html3 = new HTMLElement('body', array(), $html2);
        $htmldata = '<body><div><div>' . $texto .'</div></div></body>';
        $this->assertEquals($htmldata, $html3->getRenderHTML());

        $html = new HTMLElement('div', array(), array($texto, $html2));
        $htmldata = '<div>' . $texto . '<div><div>' . $texto .'</div></div></div>';
        $this->assertEquals($htmldata, $html->getRenderHTML());

        $img = '<img src="test.jpg">';
        $html->setContent(new HTMLElement('img', array('src' => 'test.jpg')), false);
        $htmldata = '<div>' . $texto . '<div><div>' . $texto . '</div></div>' . $img . '</div>';
        $this->assertEquals($htmldata, $html->getRenderHTML());

        $img = '<img src="test.jpg">';
        $html->setContent(new HTMLElement('img', array('src' => 'test.jpg')));
        $htmldata = '<div>' . $img . '</div>';
        $this->assertEquals($htmldata, $html->getRenderHTML());
    }

    public function testGet()
    {
        $img = new HTMLElement('img', array('src' => 'test.jpg'));
        $a = new HTMLElement('a', array('href' => 'teste.html'), array($img));
        $div = new HTMLElement('div', array('id' => 'principal'), array($a));

        $b = new HTMLElement('b', array('id' => 'idb', 'class' => array('negrito', 'c2')), 'Texto em negrito');
        $span = new HTMLElement('span', array(), array('Texto sem negrito ', $b));
        $div2 = new HTMLElement('div', array('class' => array('c1', 'c2')), array($span));

        $div->addContent($div2);

        $ret = $div->get('div');
        $this->assertEquals(2, count($ret));
        $this->assertEquals($div, $ret[0]);
        $this->assertEquals($div2, $ret[1]);

        $ret = $div->get('#idb');
        $this->assertEquals(1, count($ret));
        $this->assertEquals($b, $ret[0]);

        $ret = $div->get('.c1');
        $this->assertEquals(1, count($ret));
        $this->assertEquals($div2, $ret[0]);

        $ret = $div->getElements('img', 'src', 'test.jpg');
        $this->assertEquals(1, count($ret));
        $this->assertEquals($img, $ret[0]);

        $ret = $div->get('href=teste.html');
        $this->assertEquals(1, count($ret));
        $this->assertEquals($a, $ret[0]);

        $this->assertEquals($div->get('b.c2'), $div->get('b#idb'));

        $ret = $div->getElements('', 'href', '');
        $this->assertEquals(1, count($ret));
        $this->assertEquals($a, $ret[0]);

        $ret = $div->get('h1');
        $this->assertTrue(empty($ret));

        $ret = $div->getElements('', '', 'principal');
        $this->assertTrue(empty($ret));

        $ret = $div->getElements('', 'title', '');
        $this->assertTrue(empty($ret));
    }

    public function testRaw()
    {
        $e = new HTMLElement(
            'div',
            array('id' => '32')
        );
        $e->addContent('&nbsp;', true);
        $html = $e->getRenderHTML();
        $this->assertEquals('<div id="32">&nbsp;</div>', $html);
    }


    public function testClear()
    {
        $e = new HTMLElement(
            'div',
            array('id' => '32')
        );
        $e->addContent('&nbsp;', true);
        $e->clearContent();
        $html = $e->getRenderHTML();
        $this->assertEquals('<div id="32"></div>', $html);
    }
}
