<?php

namespace App\Charts;
/**
 * Point chart
 */
class Point
{
    /**
     * Symbol
     * @var integer
     */
    protected int $symbol;
    /**
     * Color symbol
     * @var array
     */
    protected array $color = [0, 0, 0];

    /**
     * Fill color
     * @var array
     */
    protected array $fillColor = [255, 255, 255];

    /**
     * Return tipe symbol
     * @return integer
     */
    public function getSymbol(): int
    {
        return $this->symbol;
    }

    /**
     * Set simbol point
     * @param integer $symbol Symbol point
     * @return Point
     */
    public function setSymbol(int $symbol): Point
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * Return color symbol
     * @return array
     */
    public function getColor(): array
    {
        return $this->color;
    }

    /**
     * Set color symbol
     * @param array $color
     * @return Point
     */
    public function setColor(array $color): Point
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Return fill color symbol
     * @return array
     */
    public function getFillColor(): array
    {
        return $this->fillColor;
    }

    /**
     * Set fill color symbol
     * @param array $fillColor Fill color symbol
     * @return Point
     */
    public function setFillColor(array $fillColor): Point
    {
        $this->fillColor = $fillColor;
        return $this;
    }

}
