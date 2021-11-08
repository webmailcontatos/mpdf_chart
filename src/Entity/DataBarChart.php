<?php

namespace App\Entity;

/**
 * Data bar chart
 */
class DataBarChart
{
    /**
     * Position X
     * @var string
     */
    protected string $x;

    /**
     * Position y
     * @var float
     */
    protected float $y;

    /**
     * Color rgb
     * @var array
     */
    protected array $color;

    /**
     * @return string
     */
    public function getX(): string
    {
        return $this->x;
    }

    /**
     * @param string $x
     * @return DataBarChart
     */
    public function setX(string $x): DataBarChart
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param float $y
     * @return DataBarChart
     */
    public function setY(float $y): DataBarChart
    {
        $this->y = $y;
        return $this;
    }

    /**
     * @return array
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param array $color
     * @return DataBarChart
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

}
