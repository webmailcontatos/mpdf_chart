<?php

namespace ChartPdf\Charts\Line;

use ChartPdf\Charts\Point\DataPoint;
use ChartPdf\Charts\Point\Point;

/**
 * Line data class
 */
class DataLine
{
    /**
     * Color line rgb
     * @var array
     */
    protected array $color = [0, 0, 0];

    /**
     * Points list
     * @var DataPoint[]
     */
    protected array $points;

    /**
     * Line width
     * @var float
     */
    protected float $lineWidth = 0.2;

    /**
     * Dashed line
     * @var boolean
     */
    protected bool $dashed = false;
    /**
     * Show point
     * @var boolean
     */
    protected bool $showPoint = false;

    /**
     * Return color line
     * @return array
     */
    public function getColor(): array
    {
        return $this->color;
    }

    /**
     * Set color rgb
     * @param array $color Color line rgb
     * @return DataLine
     */
    public function setColor(array $color): DataLine
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Return points line
     * @return DataPoint[]
     */
    public function getPoints(): array
    {
        return $this->points;
    }

    /**
     * Set attribute points
     * @param Point[] $points Point lines
     * @return DataLine
     */
    public function setPoints(array $points): DataLine
    {
        $this->points = $points;
        return $this;
    }

    /**
     * Return line width
     * @return float
     */
    public function getLineWidth(): float
    {
        return $this->lineWidth;
    }

    /**
     * Set line width attribute
     * @param float $lineWidth Line width
     * @return DataLine
     */
    public function setLineWidth(float $lineWidth): DataLine
    {
        $this->lineWidth = $lineWidth;
        return $this;
    }

    /**
     * Show point on line
     * @param boolean $show Show point on line
     * @return void
     */
    public function showPoint(bool $show = true): void
    {
        $this->showPoint = $show;
    }

    /**
     * Return show point flag
     * @return boolean
     */
    public function isShowPoint(): bool
    {
        return $this->showPoint;
    }

    /**
     * Return true if is dashed
     * @return boolean
     */
    public function isDashed(): bool
    {
        return $this->dashed;
    }

    /**
     * Set dashed line
     * @param boolean $dashed Dashed flag
     * @return DataLine
     */
    public function setDashed(bool $dashed): DataLine
    {
        $this->dashed = $dashed;
        return $this;
    }

}
