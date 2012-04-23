<?php

namespace VtCodeCampTest\Text;

use VtCodeCamp\Text\Markdown;

class MarkdownTest extends \PHPUnit_Framework_TestCase
{
    public function testRenderText()
    {
        $text = 'A test of [Markdown](http://daringfireball.net/projects/markdown/)';
        $markdown = new Markdown($text);
        $this->assertEquals($text, $markdown->renderText());
    }

    public function testRenderHtml()
    {
        $text = 'A test of [Markdown](http://daringfireball.net/projects/markdown/)';
        $html = '<p>A test of <a href="http://daringfireball.net/projects/markdown/">Markdown</a></p>' . PHP_EOL;
        $markdown = new Markdown($text);
        $this->assertEquals($html, $markdown->renderHtml());
    }
}
