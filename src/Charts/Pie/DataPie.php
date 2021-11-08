<?php

namespace App\Charts\Pie;

/**
 * Data pie
 */
class DataPie
{
    /**
     * Color draw rgb
     * @var array
     */
    protected array $colorDraw = [255, 255, 255];

    /**
     * Color fill
     * @var array
     */
    protected array $colorFill;

    /**
     * Percent sector
     * @var float
     */
    protected float $data;

    /**
     * Legend
     * @var string
     */
    protected string $legend;

    /**
     * Return fill color
     * @return array
     */
    public function getColorFill(): array
    {
        return $this->colorFill;
    }

    /**
     * Set color fill sector
     * @param array $colorFill Color fill
     * @return DataPie
     */
    public function setColorFill(array $colorFill): DataPie
    {
        $this->colorFill = $colorFill;
        return $this;
    }

    /**
     * Return data
     * @return float
     */
    public function getData(): float
    {
        return $this->data;
    }

    /**
     * Set data
     * @param float $data Data
     * @return DataPie
     */
    public function setData(float $data): DataPie
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Return legend
     * @return string
     */
    public function getLegend(): string
    {
        return $this->legend;
    }

    /**
     * Set legend
     * @param string $legend Legend
     * @return DataPie
     */
    public function setLegend(string $legend): DataPie
    {
        $this->legend = $legend;
        return $this;
    }

    /**
     * Return draw color
     * @return array
     */
    public function getColorDraw(): array
    {
        return $this->colorDraw;
    }

    /**
     * Set color draw
     * @param array $colorDraw Color draw
     * @return DataPie
     */
    public function setColorDraw(array $colorDraw): DataPie
    {
        $this->colorDraw = $colorDraw;
        return $this;
    }
}
