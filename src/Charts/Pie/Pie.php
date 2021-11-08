<?php

namespace App\Charts\Pie;

use App\Charts\ChartPdf;

/**
 * Pie chart class
 */
class Pie extends Chart
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
     * Write chart on the pdf
     * @return void
     */
    protected function load(): void
    {
        $data = $this->getData();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $radius = $this->getRadius();
        $initAngle = 0;
        $sumData = $this->sumData();
        foreach ($data as $item) {
            $this->setConfiSector($item);
            $percent = ($item->getData() * 100) / $sumData;
            $finishAngle = ($percent * 360) + $initAngle;
            $this->pdf->Sector($xInit, $yInit, $radius, $initAngle, $finishAngle);
            $initAngle = $finishAngle;
        }
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
     * Return sum all data
     * @return float
     */
    public function sumData(): float
    {
        $values = [];
        $data = $this->getData();
        foreach ($data as $item) {
            $values[] = $item->getData();
        }
        return array_sum($values);
    }

    /**
     * Set confi sector
     * @param DataPie $dataPie Data pie
     * @return void
     */
    protected function setConfiSector(DataPie $dataPie): void
    {
        $drawColor = $dataPie->getColorDraw();
        $colorFill = $dataPie->getColorFill();
        $this->pdf->SetDrawColor($drawColor[0], $drawColor[1], $drawColor[2]);
        $this->pdf->SetFillColor($colorFill[0], $colorFill[1], $colorFill[2]);
    }
}
