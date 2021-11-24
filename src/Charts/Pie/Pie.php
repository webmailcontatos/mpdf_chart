<?php

namespace ChartPdf\Charts\Pie;

use ChartPdf\Charts\Chart;

/**
 * Pie chart class
 */
class Pie extends Chart
{
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
     * Alpha param
     * @var float
     */
    protected float $alpha = 0.1;

    /**
     * Start anglo init
     * @var float
     */
    protected float $startAngle = 90;

    /**
     * Finishi arc default
     * @var integer
     */
    protected int $finishArc = 360;
    /**
     * Data pie list
     * @var DataPie[]
     */
    protected array $data;

    /**
     * List printed init angle
     * @var array
     */
    protected array $printedFinishAngle = [];

    /**
     * Separated flag
     * @var boolean
     */
    protected bool $separated = false;

    /**
     * Set start angle pie
     * @param integer $angle Start angle pie
     * @return void
     */
    public function setStartAngle(int $angle): void
    {
        $this->startAngle = $angle;
    }

    /**
     * Set finish arc
     * @param integer $finishiArc Finish arc
     * @return void
     */
    public function setFinishArc(int $finishiArc): void
    {
        $this->finishArc = $finishiArc;
    }

    /**
     * Set flag separated
     * @param boolean $separated Flag separated
     * @return void
     */
    public function setSeparated(bool $separated): void
    {
        $this->separated = $separated;
    }

    /**
     * Write chart on the pdf
     * @return void
     */
    protected function load(): void
    {
        $this->setSectors();
        $this->setInnerRadiusCircle();
    }

    /**
     * Set sectores
     * @return void
     */
    protected function setSectors(): void
    {
        $data = $this->getData();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $initAngle = 0;
        $sumData = $this->sumData();
        foreach ($data as $item) {
            $this->setConfiSector($item);
            $data = $item->getData();
            $radius = empty($item->getRadius()) ? $this->getRadius() : $item->getRadius();
            $percent = $data / $sumData;
            $finishAngle = ($percent * $this->finishArc) + $initAngle;
            $this->chartPdf->Sector($xInit, $yInit, $radius, $initAngle, $finishAngle, 'FD', true, $this->startAngle);
            $this->setLegend($item, $finishAngle, $initAngle);
            $this->printedFinishAngle[] = $finishAngle;
            $initAngle = $finishAngle;
        }
        $this->printSeparated();
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
        $isAlpha = $dataPie->isAlpha();
        $drawColor = $dataPie->getColorDraw();
        $colorFill = $dataPie->getColorFill();
        $this->pdf->SetDrawColor($drawColor[0], $drawColor[1], $drawColor[2]);
        $this->pdf->SetFillColor($colorFill[0], $colorFill[1], $colorFill[2]);
        $this->pdf->SetAlpha(1);//no alpha
        if ($isAlpha === true) {
            $this->pdf->SetAlpha($this->alpha);
        }
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
     * Set legend pie
     * @param DataPie $dataPie     Data pie
     * @param float   $finishAngle Finishi angle
     * @param float   $angle       Init angle
     */
    protected function setLegend(DataPie $dataPie, float $finishAngle, float $angle): void
    {
        $text = $dataPie->getLegend();
        if (empty($text)) {
            return;
        }
        $start = -$this->startAngle;//init sector
        $heightLegend = 0;
        $percentLegendRadius = $this->getRadiusLegend();
        $textWidth = $this->pdf->GetStringWidth($text);
        $offSetTextX = ($textWidth / 2);
        $offSetTextY = ($heightLegend / 2);
        $xInit = $this->getX();
        $yInit = $this->getY();
        $radius = $this->getRadius();
        $angleLegend = ($start + $angle) + (($finishAngle - $angle) / 2);
        $x = $radius * $percentLegendRadius * cos(deg2rad($angleLegend)) + $xInit;
        $y = $radius * $percentLegendRadius * sin(deg2rad($angleLegend)) + $yInit;
        $this->pdf->SetAlpha(1);
        $this->pdf->SetXY(($x - $offSetTextX), ($y - $offSetTextY));
        $this->pdf->Cell($textWidth, $heightLegend, $text);
    }

    /**
     * Return radius legend
     * @return float
     */
    protected function getRadiusLegend(): float
    {
        $defaultPercent = 0.65;
        $radius = $this->getRadius();
        $innerRadius = $this->getInnerRadius();
        $diff = ($radius - $innerRadius);
        $newRadius = $innerRadius + ($diff / 2);
        if ($innerRadius) {
            return ($newRadius / $radius);
        }
        return $defaultPercent;
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
     * Print separated
     * @return void
     */
    protected function printSeparated(): void
    {
        if ($this->separated === false) {
            return;
        }
        $xInit = $this->getX();
        $yInit = $this->getY();
        $radius = $this->getRadius();
        $diameter = 2 * $radius;
        $startAngleRect = -180;
        $w = $diameter * 0.05;//5% diameter
        $this->pdf->SetFillColor(255, 255, 255);//white
        foreach ($this->printedFinishAngle as $initAngle) {
            $this->pdf->Rotate($startAngleRect - $initAngle, $xInit, $yInit);
            $this->pdf->Rect($xInit - ($w / 2), $yInit, $w, $radius, 'F');
            $this->pdf->Rotate(0);
        }
    }

    /**
     * Set inner circle
     * @return void
     */
    protected function setInnerRadiusCircle(): void
    {
        $innerRadius = $this->getInnerRadius();
        if (empty($innerRadius)) {
            return;
        }
        $x = $this->getX();
        $y = $this->getY();
        $this->pdf->SetFillColor(255, 255, 255);
        $this->chartPdf->Sector($x, $y, $innerRadius, 0, 360, 'F');
    }
}
