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
     * Se true set point
     * @var boolean
     */
    protected bool $showPoint = true;

    /**
     * Point config
     * @var Point
     */
    protected Point $point;

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

    /**
     * If true set point
     * @return boolean
     */
    public function showPoint(): bool
    {
        return $this->showPoint;
    }

    /**
     * Set attribute set point
     * @param boolean $setPoint Set point
     * @return Line
     */
    public function setShowPoint(bool $setPoint): Line
    {
        $this->showPoint = $setPoint;
        return $this;
    }

    /**
     * Return config point
     * @return Point
     */
    public function getPoint(): Point
    {
        return $this->point;
    }

    /**
     * Set config point
     * @param Point $point Config Point
     * @return Line
     */
    public function setPoint(Point $point): Line
    {
        $this->point = $point;
        return $this;
    }

}
