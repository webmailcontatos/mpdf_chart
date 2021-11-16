<?php

namespace App\Charts;
/**
 * Scale band class
 */
class ScaleBand
{
    /**
     * Width chart
     * @var float
     */
    protected float $width;

    /**
     * Axis y
     * @var array
     */
    protected array $axisY = [];

    /**
     * Axis x
     * @var array
     */
    protected array $axisX = [];

    /**
     * Record x position axis
     * @var array
     */
    protected array $xPosition = [];

    /**
     * Y position on pdf
     * @var float
     */
    protected float $y;

    /**
     * Height chart
     * @var float
     */
    protected float $height;

    /**
     * Constructor class
     * @param array $axis  List axis elements
     * @param float $width Width chart
     */
    public function __construct(array $axis, float $width)
    {
        $this->axisX = $axis;
        $this->width = $width;
    }

    /**
     * Return position x
     * @param string $xPoint X point
     * @return float
     */
    protected function getXPosition($xPoint): float
    {
        $spaceX = $this->getWidthAxisLabel();
        return $this->xPosition[$xPoint] + ($spaceX / 2);
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
     * Return axis x values
     * @return array
     */
    public function getAxisX(): array
    {
        return $this->axisX;
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
     * Return position y
     * @param float $yPoint Y point
     * @return float
     */
    protected function getYPosition($yPoint): float
    {
        $y = $this->getY();
        $height = $this->getHeight();
        $percent = ($height / 100);
        $space = $this->getDistanceBetweenY();
        $maxPoint = $this->getMaxY() + $space;
        return $y - ((($yPoint / $maxPoint) * 100) * $percent);
    }

    /**
     * Return y postion (center of circle)
     * @return float
     */
    protected function getY(): float
    {
        return $this->y;
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
     * Return distance between axis y
     * @return float
     */
    protected function getDistanceBetweenY(): float
    {
        $axis = $this->getAxisY();
        return $axis[1] - $axis[0];
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
     * Return max value y
     * @return float
     */
    protected function getMaxY(): float
    {
        $axis = $this->getAxisY();
        return end($axis);
    }
}
