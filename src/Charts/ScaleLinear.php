<?php

namespace ChartPdf\Charts;
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
     * Axis
     * @var array
     */
    protected array $axis = [];

    /**
     * Init position
     * @var float
     */
    protected float $initPosition;

    /**
     * Constructor class
     * @param Axis[] $axis         List axis elements
     * @param float $width        Width chart
     * @param float $initPosition Init position
     */
    public function __construct(array $axis, float $width, float $initPosition)
    {
        $this->axis = $axis;
        $this->width = $width;
        $this->initPosition = $initPosition;
    }

    /**
     * Return position
     * @param string $point Point
     * @return float
     */
    public function getPosition($point): float
    {
        $width = $this->getWidth();
        $xInit = $this->getInitPosition();
        $space = $this->getWidthAxisLabel();
        $axis = array_map(fn(Axis $axis) => $axis->getValue(), $this->getAxis());
        $range = end($axis) - $axis[0];
        $calc = (($point - $axis[0]) / $range);
        return $xInit + ($calc * ($width - $space));
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
    protected function getInitPosition(): float
    {
        return $this->initPosition;
    }

    /**
     * Return width label axis x
     * @return float
     */
    protected function getWidthAxisLabel(): float
    {
        $axis = $this->getAxis();
        $width = $this->getWidth();
        return ($width / count($axis));
    }

    /**
     * Return axis x values
     * @return array
     */
    protected function getAxis(): array
    {
        return $this->axis;
    }
}
