<?php

namespace App\Charts;

use App\Entity\DataPieChart;

/**
 * Info graphics
 */
class InfoGraphics extends PieChart
{
    /**
     * Segmento radius
     * @var float
     */
    protected float $segmentRadius = 8;

    /**
     * Last radius
     * @var float|integer
     */
    protected float $lastRadius = 0;

    /**
     * Write chart pie
     * @return void
     */
    protected function load(): void
    {
        $this->setCircles();
        $this->setSegments();
        $this->setIconLegendPercent();
        $this->setCircleRedCenter();
    }

    /**
     * Seta os circulos
     * @return void
     */
    protected function setCircles(): void
    {
        $datas = $this->getData();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $radius = $this->getRadius();
        foreach ($datas as $data) {
            $color = $data->getColor();
            $this->setDrawColor($color);
            $this->pdf->Circle($xInit, $yInit, $radius, 0, 360, 'D');
            $radius -= $this->segmentRadius;
        }
        $this->lastRadius = $radius;
    }

    /**
     * Set segments
     * @return void
     */
    protected function setSegments(): void
    {
        $datas = $this->getData();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $radius = $this->getRadius();
        $starAngle = 180;
        $radiusOri = $radius;
        foreach ($datas as $data) {
            $value = $data->getData();
            $percent = $value;
            $lastAngle = ((($percent * $starAngle) / 50) + $starAngle);
            $color = $data->getColor();
            $this->setFillColor($color);
            $degrees = range(-$starAngle, -$lastAngle);
            $radiusSegments = ($this->segmentRadius * 0.50);
            $radiusCalc = ($radius - $radiusSegments);
            foreach ($degrees as $degree) {
                $x = $radiusCalc * cos(deg2rad($degree)) + $xInit;
                $y = $radiusCalc * sin(deg2rad($degree)) + $yInit;
                $this->pdf->Circle($x, $y, $radiusSegments, 0, 360, 'F');
            }
            $this->setIconLegend($data, $starAngle, $radius);
            $radius -= $this->segmentRadius;
            $radiusOri -= $this->segmentRadius;
        }
    }

    /**
     * Set icon legend
     * @param DataPieChart $chartData Chart data
     * @param float        $angle     Init angle
     * @param float        $radius    Radius segment
     * @return void
     */
    protected function setIconLegend(DataPieChart $chartData, float $angle, float $radius): void
    {
        $color = $chartData->getColor();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $text = $chartData->getLegend();
        $widthText = $this->pdf->GetStringWidth($text);
        $xInit += ($widthText / 2);
        $yInit -= 5;
        $x = $radius * cos(deg2rad(-$angle)) + $xInit;
        $y = $radius * sin(deg2rad(-$angle)) + $yInit;
        $this->pdf->SetTextColor($color[0], $color[1], $color[2]);
        $this->pdf->Text($x, $y, $text);
    }

    /**
     * Set percent label
     * @return void
     */
    protected function setIconLegendPercent(): void
    {
        $starAngle = 180;
        $descontoConstante = 130;
        $datas = $this->getData();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $radius = $this->getRadius();
        $radiusSegments = ($this->segmentRadius * 0.50);
        foreach ($datas as $data) {
            $radiusCalc = ($radius - $radiusSegments);
            $desconto = ($descontoConstante / $radiusCalc);
            $percent = $data->getData();
            $text = $percent . '%';
            $widthText = $this->pdf->GetStringWidth($text);
            $lastAngle = (((($percent + $desconto) * $starAngle) / 50) + $starAngle);
            $color = $data->getColor();
            $this->setFillColor($color);
            $this->setDrawColor($color);
            $this->pdf->SetTextColor($color[0], $color[1], $color[2]);
            $x = $radiusCalc * cos(deg2rad(-$lastAngle)) + $xInit;
            $y = $radiusCalc * sin(deg2rad(-$lastAngle)) + $yInit;
            $this->pdf->Circle($x, $y, $radiusSegments, 0, 360, 'D');
            $this->pdf->Text($x - ($widthText / 2), $y + 1, $text);
            $radius -= $this->segmentRadius;
        }
    }

    /**
     * Set circle red center
     * @return void
     */
    protected function setCircleRedCenter(): void
    {
        $xInit = $this->getX();
        $yInit = $this->getY();
        $radius = ($this->lastRadius * 0.8);
        $perimeter = (2 * $radius);
        $this->setFillColor([255, 0, 0]);
        $this->pdf->SetTextColor(255, 255, 255);
        $this->pdf->SetFont('Arial', 'B', 15);
        $this->pdf->Circle($xInit, $yInit, $radius, 0, 360, 'F');
        $textCenter = 'INFOGRAPHIC PDF';
        $currentX = $this->pdf->x;
        $this->pdf->SetX($currentX - $radius);
        $this->pdf->AutosizeText($textCenter, $perimeter, 'Arial', 'B');
        $this->pdf->SetX($currentX);
    }
}
