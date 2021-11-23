<?php

namespace ChartPdf\Charts;

use ChartPdf\Charts\Line\DataLine;

/**
 * Scale chart class
 */
class Base extends Chart
{
    /**
     * Margin top axis x
     * @var float|integer
     */
    protected float $marginTopAxisX = 4;

    /**
     * Tick size axis y and x
     * @var float|integer
     */
    protected float $tickSize = 2;
    /**
     * Width chart
     * @var float
     */
    protected float $width;

    /**
     * Height chart
     * @var float
     */
    protected float $height;

    /**
     * Horizontal grid flag
     * @var boolean
     */
    protected bool $horizontalGrid = false;

    /**
     * Vertical grid flag
     * @var boolean
     */
    protected bool $verticalGrid = false;
    /**
     * Axis x
     * @var array
     */
    protected array $axisX = [];
    /**
     * Axis y
     * @var array
     */
    protected array $axisY = [];

    /**
     * Line width
     * @var float|integer
     */
    protected float $lineWidth = 1;

    /**
     * Record y position axis
     * @var array
     */
    protected array $yPosition = [];

    /**
     * Return true if flag horizontalGrid printed
     * @return boolean
     */
    public function isHorizontalGrid(): bool
    {
        return $this->horizontalGrid;
    }

    /**
     * Set attribute flag horizontal grid
     * @param boolean $horizontalGrid Horizontal grid flag
     * @return Base
     */
    public function setHorizontalGrid(bool $horizontalGrid): Base
    {
        $this->horizontalGrid = $horizontalGrid;
        return $this;
    }

    /**
     * Return true if flag verticalGrid printed
     * @return boolean
     */
    public function isVerticalGrid(): bool
    {
        return $this->verticalGrid;
    }

    /**
     * Set attribute flag vertical grid
     * @param boolean $verticalGrid Flag vertical grid
     * @return Base
     */
    public function setVerticalGrid(bool $verticalGrid): Base
    {
        $this->verticalGrid = $verticalGrid;
        return $this;
    }

    /**
     * Return first point chart on x axis
     * @param DataLine $line Line chart
     * @return float
     */
    public function getFirstPointX(DataLine $line): float
    {
        $point = array_values($line->getPoints())[0];
        return $this->getXPosition($point->getX());
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
        $x = $this->getX();
        $scaleBand = new ScaleBand($axis, $width, $x);
        return $scaleBand->getPosition($xPoint);
    }

    /**
     * Return axis x values
     * @return array
     */
    public function getAxisX(): array
    {
        return $this->axisX;
    }

    /**
     * Set axis x
     * @param array $axisX Axis x list
     * @return Base
     */
    public function setAxisX(array $axisX): Base
    {
        $this->axisX = $axisX;
        return $this;
    }

    /**
     * Return width chart
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * Set width chart
     * @param float $width Width chart
     * @return Base
     */
    public function setWidth(float $width): Base
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        $this->setLineWidthChart();
        $this->setLineAxisY();
        $this->setLineAxisX();
        $this->setAxisXchart();
        $this->setAxisYchart();
        $this->setGridHorizontal();
        $this->setGridVertical();
    }

    /**
     * Set line width chart
     * @return void
     */
    protected function setLineWidthChart(): void
    {
        $lineWidth = $this->getLineWidth();
        $this->pdf->SetLineWidth($lineWidth);
        $this->pdf->SetLineCap(0);
    }

    /**
     * Return line width
     * @return float|integer
     */
    public function getLineWidth(): float
    {
        return $this->lineWidth;
    }

    /**
     * @param float|int $lineWidth
     * @return Base
     */
    public function setLineWidth($lineWidth)
    {
        $this->lineWidth = $lineWidth;
        return $this;
    }

    /**
     * Set vertical line y
     * @return void
     */
    protected function setLineAxisY(): void
    {
        $xInit = $this->getX();
        $yInit = $this->getYPosition(0);
        $height = $this->getHeight();
        $axis = $this->getAxisY();
        $space = ($height / count($axis));
        $this->pdf->Line($xInit, $yInit, $xInit, ($yInit - ($height - $space)));
    }

    /**
     * Return height chart
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * Set height chart
     * @param float $height Height chart
     * @return Base
     */
    public function setHeight(float $height): Base
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Return axis y list
     * @return array
     */
    public function getAxisY(): array
    {
        return $this->axisY;
    }

    /**
     * Set attribute y list
     * @param array $axisY List axis y
     * @return Base
     */
    public function setAxisY(array $axisY): Base
    {
        $this->axisY = $axisY;
        return $this;
    }

    /**
     * Set line horizontal x
     * @return void
     */
    protected function setLineAxisX(): void
    {
        $xInit = $this->getX();
        $yInit = $this->getYPosition(0);
        $width = $this->getWidth();
        $this->pdf->Line($xInit, $yInit, ($xInit + $width), $yInit);
    }

    /**
     * Set axis chart
     * @return void
     */
    protected function setAxisXchart(): void
    {
        $axis = $this->getAxisX();
        $xInit = $this->getX();
        $yInit = $this->getYPosition(0);
        $space = $this->getWidthAxisLabel();
        foreach ($axis as $axi) {
            $this->pdf->SetXY($xInit, ($yInit + $this->marginTopAxisX));
            $this->pdf->Cell($space, 0, $axi, '0', 0, 'C');
            $this->setTickAxisX($xInit + ($space / 2));
            $xInit += $space;
        }
    }

    /**
     * Return width label axis x
     * @return float
     */
    protected function getWidthAxisLabel(): float
    {
        $axis = $this->getAxisX();
        $width = $this->getWidth();
        return ($width / count($axis));
    }

    /**
     * Set tick on axis x
     * @return void
     */
    protected function setTickAxisX(float $xInit): void
    {
        $yInit = $this->getYPosition(0);
        $this->pdf->Line($xInit, $yInit, $xInit, ($yInit + $this->tickSize));
    }

    /**
     * Set axis y chart
     * @return void
     */
    protected function setAxisYchart(): void
    {
        $tickSize = $this->tickSize;
        $axis = $this->getAxisY();
        $xInit = $this->getX();
        $yInit = $this->getYPosition(0);
        $space = $this->getSpaceAxisY();
        $xInitLine = $this->getX() - $tickSize;
        $heightCell = $space;
        $widthCell = $this->getMaxStringWidthY();
        $xInit -= ($widthCell + ($tickSize * 1.5));
        foreach ($axis as $axi) {
            $this->yPosition[$axi] = $yInit;
            $this->pdf->SetXY($xInit, $yInit - ($heightCell / 2));
            $this->pdf->Cell($widthCell, $space, $axi, '0', 0, 'C');
            $this->pdf->Line($xInitLine, $yInit, ($xInitLine + 2), $yInit);
            $yInit -= $space;
        }
    }

    /**
     * Return space y axis
     * @return float
     */
    protected function getSpaceAxisY(): float
    {
        $axis = $this->getAxisY();
        $height = $this->getHeight();
        return ($height / count($axis));
    }

    /**
     * Return max width string axisY
     * @return float
     */
    protected function getMaxStringWidthY(): float
    {
        $sizes = [];
        $axis = $this->getAxisY();
        foreach ($axis as $axi) {
            $sizes[] = $this->pdf->GetStringWidth($axi);
        }
        return max($sizes);
    }

    /**
     * Set horizontal grid
     * @return void
     */
    protected function setGridHorizontal(): void
    {
        if ($this->horizontalGrid === false) {
            return;
        }
        $axis = $this->getAxisY();
        $xInit = $this->getX();
        $widthLine = $this->getLineWidthAxisX();
        foreach ($axis as $axi) {
            $yInit = $this->getYPosition($axi);
            $this->pdf->Line($xInit, $yInit, $widthLine, $yInit);

        }
    }

    /**
     * Return width line on axis x
     * @return float
     */
    protected function getLineWidthAxisX(): float
    {
        $xInit = $this->getX();
        $width = $this->getWidth();
        return ($xInit + $width);
    }

    /**
     * Return position y
     * @param float $yPoint Y point
     * @return float
     */
    protected function getYPosition($yPoint): float
    {
        $axis = $this->getAxisY();
        $y = $this->getY();
        $height = -$this->getHeight();
        $scale = new ScaleLinear($axis, $height, $y);
        return $scale->getPosition($yPoint);
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
        $spaceX = $this->getWidthAxisLabel();
        $axis = $this->getAxisX();
        $yInit = $this->getYPosition(0);
        $heightLine = $this->getLineHeightAxisY();
        foreach ($axis as $axi) {
            $xInit = $this->getXPosition($axi) + ($spaceX / 2);
            $this->pdf->Line($xInit, $yInit, $xInit, $heightLine);
        }
    }

    /**
     * Return height line on axis y
     * @return float
     */
    protected function getLineHeightAxisY(): float
    {
        $yInit = $this->getYPosition(0);
        $height = $this->getHeight();
        $space = $this->getSpaceAxisY();
        return ($yInit - $height) + $space;
    }

    /**
     * Return distance between axis y
     * @return float
     */
    protected function getDistanceBetweenY(): float
    {
        $axis = $this->getAxisY();
        return $axis[1] - $axis[0];
    }

    /**
     * Return max value y
     * @return float
     */
    protected function getMaxY(): float
    {
        $axis = $this->getAxisY();
        return end($axis);
    }

    /**
     * Return max x position
     * @return float
     */
    protected function getMaxX(): float
    {
        $axis = $this->getAxisX();
        $max = end($axis);
        return $this->getXPosition($max);
    }

    /**
     * Return min x position
     * @return float
     */
    protected function getMinX(): float
    {
        $axis = $this->getAxisX();
        $max = reset($axis);
        return $this->getXPosition($max);
    }
}
