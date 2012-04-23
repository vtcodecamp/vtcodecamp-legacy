<?php

namespace VtCodeCamp;

use VtCodeCamp\ArraySerializable;

/**
 * @category    VtCodeCamp
 * @package     VtCodeCamp_Text
 */
interface Text extends ArraySerializable
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
