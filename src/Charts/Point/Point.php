<?php

namespace App\Charts\Point;

use App\Charts\ScaleOrdinal;

/**
 * Point chart
 */
class Point extends ScaleOrdinal
{
    /**
     * Set point trait
     */
    use SetPoint;

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
        foreach ($points as $point) {
            $this->addPoint($point);
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
