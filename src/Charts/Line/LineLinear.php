<?php

namespace ChartPdf\Charts\Line;

use ChartPdf\Charts\ScaleLinear;

/**
 * Line chart class
 */
class LineLinear extends Line
{
    /**
     * Set vertical grid
     * @return void
     */
    protected function setGridVertical(): void
    {
        if ($this->verticalGrid === false) {
            return;
        }
        $space = $this->getSpaceAxisY();
        $axis = $this->getAxisX();
        $height = $this->getHeight() - $space;
        $yInit = $this->getY();
        foreach ($axis as $axi) {
            $xInit = $this->getXPosition($axi);
            $this->pdf->Line($xInit, $yInit, $xInit, ($yInit - $height));
        }
    }

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
