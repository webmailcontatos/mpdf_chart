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
     * Axis x
     * @var array
     */
    protected array $axisX = [];

    /**
     * X init position
     * @var float
     */
    protected float $x;
    protected int   $orientarion;

    /**
     * Constructor class
     * @param array $axis  List axis elements
     * @param float $width Width chart
     * @param float $xInit Init x position
     */
    public function __construct(array $axis, float $width, float $xInit, int $orientation = 1)
    {
        $this->axisX = $axis;
        $this->width = $width;
        $this->x = $xInit;
        $this->orientarion = $orientation;
    }

    /**
     * Return position
     * @param string $point Point
     * @return float
     */
    public function getPosition($point): float
    {
        $width = abs($this->getWidth());
        $xInit = $this->getXInit();
        $space = $this->getWidthAxisLabel();
        $axis = $this->getAxisX();
        $range = end($axis) - $axis[0];
        $calc = (($point - $axis[0]) / $range);
        if ($this->orientarion === 1) {
            return $xInit - ($calc * ($width + $space));
        }
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
    protected function getXInit(): float
    {
        $axis = $this->getAxisX();
        $first = reset($axis);
//        if ($first < 0) {
//            $space = $this->getWidthAxisLabel();
//            return $this->getX() + ($this->getWidth() / 2) - ($space / 2);
//        }
        return $this->getX();
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
     * Return x init
     * @return float
     */
    protected function getX(): float
    {
        return $this->x;
    }
}
