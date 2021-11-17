<?php

namespace App\Charts\Bar;

/**
 * Bar data class
 */
class DataBar
{
    /**
     * Color line rgb
     * @var array
     */
    protected array $color;

    /**
     * Color draw
     * @var array
     */
    protected array $colorDraw;

    /**
     * Line width
     * @var float
     */
    protected float $lineWidth;

    /**
     * Dashed line
     * @var boolean
     */
    protected bool $dashed = false;

    /**
     * X position
     * @var float
     */
    protected string $x;

    /**
     * Y position
     * @var float
     */
    protected float $y;


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
     * @return DataBar
     */
    public function setColor(array $color): DataBar
    {
        $this->color = $color;
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
     * @return DataBar
     */
    public function setLineWidth(float $lineWidth): DataBar
    {
        $this->lineWidth = $lineWidth;
        return $this;
    }

    /**
     * Return true if is dashed
     * @return boolean
     */
    public function isDashed(): bool
    {
        return $this->dashed;
    }

    /**
     * Set dashed line
     * @param boolean $dashed Dashed flag
     * @return DataBar
     */
    public function setDashed(bool $dashed): DataBar
    {
        $this->dashed = $dashed;
        return $this;
    }

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
     * @param float $x X position
     * @return DataBar
     */
    public function setX(string $x): DataBar
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
     * @return DataBar
     */
    public function setY(float $y): DataBar
    {
        $this->y = $y;
        return $this;
    }

    /**
     * Return color draw
     * @return array
     */
    public function getColorDraw(): array
    {
        return $this->colorDraw;
    }

    /**
     * Set color draw attribute
     * @param array $colorDraw Color draw
     * @return DataBar
     */
    public function setColorDraw(array $colorDraw): DataBar
    {
        $this->colorDraw = $colorDraw;
        return $this;
    }

}
