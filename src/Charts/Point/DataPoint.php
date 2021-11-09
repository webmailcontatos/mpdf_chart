<?php

namespace App\Charts\Point;
/**
 * Point class
 */
class DataPoint
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
    protected array $colorDraw = [0, 0, 0];

    /**
     * Color point rgb
     * @var array
     */
    protected array $colorFill = [0, 0, 0];

    /**
     * Fill point
     * @var boolean
     */
    protected bool $fill = false;

    /**
     * Size point
     * @var float
     */
    protected float $size = 0.5;

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
     * @return DataPoint
     */
    public function setX(string $x): DataPoint
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
     * @return DataPoint
     */
    public function setY(float $y): DataPoint
    {
        $this->y = $y;
        return $this;
    }

    /**
     * Return color point rgb
     * @return array
     */
    public function getColorDraw(): array
    {
        return $this->colorDraw;
    }

    /**
     * Set color rgb
     * @param array $colorDraw Color point
     * @return DataPoint
     */
    public function setColorDraw(array $colorDraw): DataPoint
    {
        $this->colorDraw = $colorDraw;
        return $this;
    }

    /**
     * Return color point rgb
     * @return array
     */
    public function getColorFill(): array
    {
        return $this->colorFill;
    }

    /**
     * Set color rgb
     * @param array $colorFill Color point
     * @return DataPoint
     */
    public function setColorFill(array $colorFill): DataPoint
    {
        $this->colorFill = $colorFill;
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
     * @return DataPoint
     */
    public function setFill(bool $fill): DataPoint
    {
        $this->fill = $fill;
        return $this;
    }

    /**
     * Return size point
     * @return float
     */
    public function getSize(): float
    {
        return $this->size;
    }

    /**
     * Set size point
     * @param float $size Size point
     * @return DataPoint
     */
    public function setSize(float $size): DataPoint
    {
        $this->size = $size;
        return $this;
    }

}
