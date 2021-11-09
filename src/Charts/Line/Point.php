<?php

namespace App\Charts\Line;
/**
 * Point class
 */
class Point
{
    /**
     * X position
     * @var string
     */
    protected string $x;

    /**
     * Y position
     * @var float
     */
    protected float $y;

    /**
     * Color point rgb
     * @var array
     */
    protected array $color;

    /**
     * Fill point
     * @var boolean
     */
    protected bool $fill = true;

    /**
     * Return x position
     * @return string
     */
    public function getX(): string
    {
        return $this->x;
    }

    /**
     * Set x position
     * @param string $x X position
     * @return Point
     */
    public function setX(string $x): Point
    {
        $this->x = $x;
        return $this;
    }

    /**
     * Return y position
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * Set y position
     * @param float $y Y position
     * @return Point
     */
    public function setY(float $y): Point
    {
        $this->y = $y;
        return $this;
    }

    /**
     * Return color point rgb
     * @return array
     */
    public function getColor(): array
    {
        return $this->color;
    }

    /**
     * Set color rgb
     * @param array $color Color point
     * @return Point
     */
    public function setColor(array $color): Point
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Return true if point is filled
     * @return boolean
     */
    public function isFill(): bool
    {
        return $this->fill;
    }

    /**
     * Set fill attribute
     * @param boolean $fill Fill flag point
     * @return Point
     */
    public function setFill(bool $fill): Point
    {
        $this->fill = $fill;
        return $this;
    }

}
