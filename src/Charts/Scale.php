<?php

namespace App\Charts;

use App\Charts\Line\Line;

/**
 * Scale chart class
 */
class Scale extends Chart
{
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
}
