<?php

namespace App\Charts\Point;

/**
 * Set point trait
 */
trait SetPoint
{
    /**
     * Add point on the chart
     * @param DataPoint $point Point
     * @return void
     */
    protected function addPoint(DataPoint $point): void
    {
        $styleDefault = 'FD';
        $stylePoint = $styleDefault;
        $x = $this->getXPosition($point->getX());
        $y = $this->getYPosition($point->getY());
        $colorDraw = $point->getColorDraw();
        $colorFill = $point->getColorFill();
        $isFill = $point->isFill();
        $size = $point->getSize();
        if ($isFill === false) {
            $stylePoint = 'D';
        }
        $this->pdf->SetDrawColor($colorDraw[0], $colorDraw[1], $colorDraw[2]);
        $this->pdf->SetFillColor($colorFill[0], $colorFill[1], $colorFill[2]);
        $this->pdf->Circle($x, $y, $size, 0, 360, $stylePoint);
    }
}
