<?php

namespace App\Charts;

use App\Entity\DataLineChart;

/**
 * Line chart
 */
class Line
{
    /**
     * Rgb color line
     * @var array
     */
    protected array $color = [0, 0, 0];

    /**
     * Line data chart
     * @var DataLineChart[]
     */
    protected array $points;

    /**
     * Return color attribute
     * @return array
     */
    public function getColor(): array
    {
        return $this->color;
    }

    /**
     * Set color attribute
     * @param array $color Color rgb
     * @return Line
     */
    public function setColor(array $color): Line
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Return points line
     * @return DataLineChart[]
     */
    public function getPoints(): array
    {
        return $this->points;
    }

    /**
     * Set points line
     * @param DataLineChart[] $points
     * @return Line
     */
    public function setPoints(array $points): Line
    {
        $this->points = $points;
        return $this;
    }

}
