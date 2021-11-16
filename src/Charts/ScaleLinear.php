<?php

namespace App\Charts;
/**
 * Scale band class
 */
class ScaleLinear
{
    /**
     * Width chart
     * @var float
     */
    protected float $width;

    /**
     * Axis x
     * @var array
     */
    protected array $axisX = [];

    /**
     * X init position
     * @var float
     */
    protected float $x;

    /**
     * Constructor class
     * @param array $axis  List axis elements
     * @param float $width Width chart
     * @param float $xInit Init x position
     */
    public function __construct(array $axis, float $width, float $xInit)
    {
        $this->axisX = $axis;
        $this->width = $width;
        $this->x = $xInit;
    }

    /**
     * Return position
     * @param string $point Point
     * @return float
     */
    public function getPosition($point): float
    {
        $space = $this->getWidthAxisLabel();
        $x = $this->getX();
        $axisX = $this->getAxisX();
        $width = ($x + $this->getWidth()) - $space;
        $range = ($width - $x);
        $rangeX = end($axisX) - $axisX[0];
        return (($point * $range) / $rangeX) + $x;
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
    protected function getAxisX(): array
    {
        return $this->axisX;
    }

    /**
     * Return width chart
     * @return float
     */
    protected function getWidth(): float
    {
        return $this->width;
    }


    /**
     * Return x init
     * @return float
     */
    protected function getX(): float
    {
        return $this->x;
    }
}
