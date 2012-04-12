<?php

namespace VtCodeCamp\Text;

use VtCodeCamp\Text,
    dflydev\markdown\MarkdownExtraParser;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Text
 */
class Markdown implements Text
{
    /**
     * @var string
     */
    private $text;

    private $html = null;

    public function __construct($text)
    {
        $this->text = (string)$text;
    }

    /**
     * Render a textual representation
     * 
     * @return string
     */
    public function renderText()
    {
        return $this->text;
    }

    /**
     * Render an HTML representation
     * 
     * @return string
     */
    public function renderHtml()
    {
        if (null === $this->html) {
            $parser = new MarkdownExtraParser();
            $this->html = $parser->transformMarkdown($this->text);
        }
        return $this->html;
    }
}
