<?php

namespace App\Charts\Line;

/**
 * Line data class
 */
class DataLine
{
    /**
     * Color line rgb
     * @var array
     */
    protected array $color;

    /**
     * Points list
     * @var Point[]
     */
    protected array $points;

    /**
     * Line width
     * @var float
     */
    protected float $lineWidth;

    /**
     * Return color line
     * @return array
     */
    public function getColor(): array
    {
        return $this->color;
    }

    /**
     * Set color rgb
     * @param array $color Color line rgb
     * @return DataLine
     */
    public function setColor(array $color): DataLine
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Return points line
     * @return Point[]
     */
    public function getPoints(): array
    {
        return $this->points;
    }

    /**
     * Set attribute points
     * @param Point[] $points Point lines
     * @return DataLine
     */
    public function setPoints(array $points): DataLine
    {
        $this->points = $points;
        return $this;
    }

    /**
     * Return line width
     * @return float
     */
    public function getLineWidth(): float
    {
        return $this->lineWidth;
    }

    /**
     * Set line width attribute
     * @param float $lineWidth Line width
     * @return DataLine
     */
    public function setLineWidth(float $lineWidth): DataLine
    {
        $this->lineWidth = $lineWidth;
        return $this;
    }

}
