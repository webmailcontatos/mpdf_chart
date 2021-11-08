<?php

namespace App\Charts\Pie;

use App\Charts\ChartPdf;

/**
 * Pie chart class
 */
class Pie
{
    /**
     * Pdf lib
     * @var ChartPdf
     */
    protected ChartPdf $pdf;
    /**
     * Radius circle
     * @var float
     */
    protected float $radius;
    /**
     * Inner radius
     * @var float
     */
    protected float $innerRadius;

    /**
     * X position on pdf
     * @var float
     */
    protected float $x;

    /**
     * Y position on pdf
     * @var float
     */
    protected float $y;
    /**
     * Color draw rgb
     * @var array
     */
    protected array $colorDraw;

    /**
     * Data pie list
     * @var DataPie[]
     */
    protected array $data;

    /**
     * Constructor class
     * @param ChartPdf $pdf Pdf lib
     */
    public function __construct(ChartPdf $pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Return radius
     * @return float
     */
    public function getRadius(): float
    {
        return $this->radius;
    }

    /**
     * Set radius
     * @param float $radius Radius
     * @return Pie
     */
    public function setRadius(float $radius): Pie
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * Return inner radius
     * @return float
     */
    public function getInnerRadius(): float
    {
        return $this->innerRadius;
    }

    /**
     * Set inner radius
     * @param float $innerRadius Inner radius
     * @return Pie
     */
    public function setInnerRadius(float $innerRadius): Pie
    {
        $this->innerRadius = $innerRadius;
        return $this;
    }

    /**
     * Return x position (center of de circle)
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * Set x postion (center of de circle)
     * @param float $x x position
     * @return Pie
     */
    public function setX(float $x): Pie
    {
        $this->x = $x;
        return $this;
    }

    /**
     * Return y postion (center of circle)
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * Set y position
     * @param float $y Y position
     * @return Pie
     */
    public function setY(float $y): Pie
    {
        $this->y = $y;
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
     * @return Pie
     */
    public function setColorDraw(array $colorDraw): Pie
    {
        $this->colorDraw = $colorDraw;
        return $this;
    }

    /**
     * Return lista data pie
     * @return DataPie[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Set data pie
     * @param DataPie[] $data Data pie
     * @return Pie
     */
    public function setData(array $data): Pie
    {
        $this->data = $data;
        return $this;
    }

}
