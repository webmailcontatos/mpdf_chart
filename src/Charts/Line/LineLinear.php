<?php

namespace ChartPdf\Charts\Line;

use ChartPdf\Charts\ScaleLinear;

/**
 * Line chart class
 */
class LineLinear extends Line
{

    /**
     * Set line horizontal x
     * @return void
     */
    protected function setLineAxisX(): void
    {
        $xInit = $this->getX();
        $yInit = $this->getYPosition(0);
        $width = $this->getWidth();
        $space = $this->getWidthAxisLabel();
        $this->pdf->Line($xInit, $yInit, (($xInit + $width) - $space), $yInit);
    }

    /**
     * Return width line on axis x
     * @return float
     */
    protected function getLineWidthAxisX(): float
    {
        $space = $this->getWidthAxisLabel();
        $xInit = $this->getX();
        $width = $this->getWidth();
        return ($xInit + $width) - $space;
    }

    /**
     * Set vertical grid
     * @return void
     */
    protected function setGridVertical(): void
    {
        if ($this->verticalGrid === false) {
            return;
        }
        $spaceY = $this->getSpaceAxisY();
        $axis = $this->getAxisX();
        $height = $this->getHeight() - $spaceY;
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
