<?php

namespace ChartPdf\Charts\Line;

use ChartPdf\Charts\ScaleLinear;

/**
 * Line chart class
 */
class LineLinear extends Line
{
    /**
     * Set axis chart
     * @return void
     */
    protected function setAxisXchart(): void
    {
        $axis = $this->getAxisX();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $space = $this->getWidthAxisLabel();
        foreach ($axis as $axi) {
            $this->xPosition[$axi] = $xInit;
            $this->pdf->SetXY($xInit - ($space / 2), ($yInit + $this->marginTopAxisX));
            $this->pdf->Cell($space, 0, $axi, '0', 0, 'C');
            $this->setTickAxisX($xInit);
            $xInit += $space;
        }
    }

    /**
     * Set line horizontal x
     * @return void
     */
    protected function setLineAxisX(): void
    {
        $xInit = $this->getX();
        $yInit = $this->getY();
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
     * Return position x
     * @param string $xPoint X point
     * @return float
     */
    protected function getXPosition($xPoint): float
    {
        $axis = $this->getAxisX();
        $width = $this->getWidth();
        $xInit = $this->getX();
        $scaleBand = new ScaleLinear($axis, $width, $xInit);
        return $scaleBand->getPosition($xPoint);
    }
}
