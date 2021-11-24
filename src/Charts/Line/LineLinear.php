<?php

namespace ChartPdf\Charts\Line;

use ChartPdf\Charts\ScaleLinear;

/**
 * Line chart class
 */
class LineLinear extends Line
{
    /**
     * Set default scale x and y
     */
    protected function setDefaultScales(): void
    {
        parent::setDefaultScales();
        $axis = $this->getAxisX();
        $width = $this->getWidth();
        $xInit = $this->getX();
        $this->scaleX = new ScaleLinear($axis, $width, $xInit);
    }
}
