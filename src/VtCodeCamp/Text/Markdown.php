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

    private $html;

    public function __construct($text, $html = null)
    {
        $this->text = (string)$text;
        $this->html = $html;
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

    public function arraySerialize()
    {
        return array(
            'text'  => $this->renderText(),
            'html'  => $this->renderHtml(),
        );
    }

    public static function arrayDeserialize($array)
    {
        $text = $array['text'];
        $html = null;
        if (isset($array['html'])) {
            $html = $array['html'];
        }
        return new Markdown($text, $html);
    }
}
