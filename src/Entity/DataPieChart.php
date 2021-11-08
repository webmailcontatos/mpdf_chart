<?php

namespace App\Entity;

use App\Charts\PieChart;

/**
 * Data chart pie
 */
class DataPieChart
{
    /**
     * Data
     * @var float
     */
    protected float $data;
    /**
     * Color rgb sector
     * @var array
     */
    protected array $color;

    /**
     * Data legend
     * @var string
     */
    protected ?string $legend;
    /**
     * Separado
     * @var boolean
     */
    protected bool $separated = false;

    /**
     * Return data
     * @return float
     */
    public function getData(): float
    {
        return $this->data;
    }

    /**
     * Seta data
     * @param float $data Data chart pie
     * @return DataPieChart
     */
    public function setData(float $data): DataPieChart
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Return color chart sector
     * @return array
     */
    public function getColor(): array
    {
        return $this->color;
    }

    /**
     * Set color sector chart pie
     * @param array $color Color rgb sector
     * @return DataPieChart
     */
    public function setColor(array $color): DataPieChart
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Return legend
     * @return string|null
     */
    public function getLegend(): ?string
    {
        return $this->legend;
    }

    /**
     * Set legend
     * @param string|null $legend Legend chart data
     * @return DataPieChart
     */
    public function setLegend(string $legend = null): DataPieChart
    {
        $this->legend = $legend;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSeparated(): bool
    {
        return $this->separated;
    }

    /**
     * @param bool $separated
     * @return PieChart
     */
    public function setSeparated(bool $separated): DataPieChart
    {
        $this->separated = $separated;
        return $this;
    }
}
