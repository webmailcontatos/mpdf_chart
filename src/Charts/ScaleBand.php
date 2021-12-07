<?php

namespace ChartPdf\Charts;
/**
 * Scale band class
 */
class ScaleBand extends ScaleLinear
{
    /**
     * Return position
     * @param string $point Point
     * @return float
     */
    public function getPosition($point): float
    {
        $x = $this->getInitPosition();
        $axis = $this->getAxis();
        $axisFlip = array_flip($axis);
        $space = $this->getWidthAxisLabel();
        $position = $axisFlip[$point];
        return ($position * $space) + $x + ($space / 2);
    }
}
