<?php

namespace VtCodeCamp;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Text
 */
interface Text
{
    /**
     * Render a textual representation
     * 
     * @return string
     */
    public function renderText();

    /**
     * Render an HTML representation
     * 
     * @return string
     */
    public function renderHtml();
}
