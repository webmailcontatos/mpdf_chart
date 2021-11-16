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

}
