<?php

namespace App\Charts\Pie;

use App\Charts\Chart;

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
     * Data pie list
     * @var DataPie[]
     */
    protected array $data;

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
            $finishAngle = ($percent * 360) + $initAngle;
            $this->pdf->Sector($xInit, $yInit, $radius, $initAngle, $finishAngle);
            $this->setLegend($item, $finishAngle, $initAngle);
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
        $start = -90;//init sector
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
        $this->pdf->Sector($x, $y, $innerRadius, 0, 360, 'F');
    }
}
