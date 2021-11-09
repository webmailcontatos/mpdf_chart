<?php

namespace App\Charts\Point;

use App\Charts\Scale;

/**
 * Point chart
 */
class Point extends Scale
{
    /**
     * Points
     * @var DataPoint[]
     */
    protected array $points;

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        parent::load();
        $this->writePoint();
    }

    /**
     * Write points
     * @return void
     */
    protected function writePoint(): void
    {
        $points = $this->getPoints();
        $styleDefault = 'FD';
        foreach ($points as $point) {
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

    /**
     * Return points
     * @return DataPoint[]
     */
    public function getPoints(): array
    {
        return $this->points;
    }

    /**
     * Set points chart
     * @param DataPoint[] $points Points chart
     * @return Point
     */
    public function setPoints(array $points): Point
    {
        $this->points = $points;
        return $this;
    }
}
