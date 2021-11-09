<?php

namespace App\Charts;

use App\Charts\Line\Line;

/**
 * Scale chart class
 */
class Scale extends Chart
{
    /**
     * Margin top axis x
     * @var float|integer
     */
    protected float $marginTopAxisX = 3;

    /**
     * Tick size axis y
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
     * @return Scale
     */
    public function setHorizontalGrid(bool $horizontalGrid): Line
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
     * @return Scale
     */
    public function setVerticalGrid(bool $verticalGrid): Line
    {
        $this->verticalGrid = $verticalGrid;
        return $this;
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
     * @return Scale
     */
    public function setLineWidth($lineWidth)
    {
        $this->lineWidth = $lineWidth;
        return $this;
    }

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        $this->setLineAxisY();
        $this->setLineAxisX();
        $this->setAxisXchart();
        $this->setAxisYchart();
    }

    /**
     * Set vertical line y
     * @return void
     */
    protected function setLineAxisY(): void
    {
        $xInit = $this->getX();
        $yInit = $this->getY();
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
     * @return Scale
     */
    public function setHeight(float $height): Line
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
     * @return Scale
     */
    public function setAxisY(array $axisY): Line
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
        $yInit = $this->getY();
        $width = $this->getWidth();
        $this->pdf->Line($xInit, $yInit, ($xInit + $width), $yInit);
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
     * @return Scale
     */
    public function setWidth(float $width): Line
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Set axis chart
     * @return void
     */
    protected function setAxisXchart(): void
    {
        $axis = $this->getAxisX();
        $xInit = $this->getX();
        $yInit = $this->getY() + $this->marginTopAxisX;
        $space = $this->getWidthAxisLabel();
        foreach ($axis as $axi) {
            $this->xPosition[$axi] = $xInit;
            $this->pdf->SetXY($xInit, $yInit);
            $this->pdf->Cell($space, 0, $axi, '0', 0, 'C');
            $xInit += $space;
        }
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
     * @return Scale
     */
    public function setAxisX(array $axisX): Line
    {
        $this->axisX = $axisX;
        return $this;
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
     * Set axis y chart
     * @return void
     */
    protected function setAxisYchart(): void
    {
        $tickSize = $this->tickSize;
        $axis = $this->getAxisY();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $height = $this->getHeight();
        $space = ($height / count($axis));
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
}
