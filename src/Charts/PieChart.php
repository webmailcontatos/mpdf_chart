<?php

namespace App\Charts;

use App\Entity\DataPieChart;

/**
 * Pie chart class
 */
class PieChart extends LineChart
{
    /**
     * Radius chart pie
     * @var float|integer
     */
    protected float $radius = 0;
    /**
     * Inner radius
     * @var float
     */
    protected float $innerRadius = 0;

    /**
     * Data chart pie
     * @var DataPieChart[]
     */
    protected array $data;

    /**
     * Write chart pie
     * @return void
     */
    protected function load(): void
    {
        $chartDatas = $this->getData();
        $sum = $this->getSumData();
        $x = $this->getX();
        $y = $this->getY();
        $start = 0;
        $finishAngle = 0;
        $drawColor = $this->getDrawColorLine();
        $this->SetDrawColor($drawColor);
        $descSeparated = 5;
        foreach ($chartDatas as $chartData) {
            $radius = $this->getRadius();
            $data = $chartData->getData();
            $isSeparated = $chartData->isSeparated();
            $color = $chartData->getColor();
            $sector = ($data * 360) / $sum;
            $sector += $finishAngle;
            $this->setFillColor($color);
            if ($isSeparated) {
                $this->pdf->Sector($x, $y, $radius * 1.1, ($start + $descSeparated), ($sector - $descSeparated), 'DF');
            } else {
                $this->pdf->Sector($x, $y, $radius, $start, $sector, 'DF');
            }
            $this->setLegend($chartData, $start, $sector);
            $finishAngle = $sector;
            $start = $finishAngle;
        }
        $this->setInnerRadiusCircle();
    }

    /**
     * Return data chart
     * @return DataPieChart[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Set data chart
     * @param DataPieChart[] $dataChart Data chart
     * @return void
     */
    public function setData(array $dataChart): PieChart
    {
        $this->data = $dataChart;
        return $this;
    }

    /**
     * Sum all data chart
     * @return float
     */
    protected function getSumData(): float
    {
        $datas = $this->getData();
        $chartDatas = [];
        foreach ($datas as $data) {
            $chartDatas[] = $data->getData();
        }
        return array_sum($chartDatas);
    }

    /**
     * Return radius chart
     * @return float
     */
    protected function getRadius(): float
    {
        $width = $this->getWidth();
        return ($width / 2);
    }

    /**
     * Set legend
     * @param DataPieChart $chartData   Data chart pie
     * @param float        $angle       Angle chart data
     * @param float        $finishAngle Finish angle chart data
     * @return void
     */
    protected function setLegend(DataPieChart $chartData, float $angle, float $finishAngle): void
    {
        $text = $chartData->getLegend();
        if (empty($text)) {
            return;
        }
        $isSeparated = $chartData->isSeparated();
        $xInit = $this->x;
        $yInit = $this->y;
        $widthText = $this->pdf->GetStringWidth($text);
        $middle = (($finishAngle - $angle) / 2);
        $angle = (($angle - 90) + $middle);
        $defaultRadius = $isSeparated ? $this->getRadius() * 1.1 : $this->getRadius();
        $radius = $defaultRadius * 0.65;
        $x = $radius * cos(deg2rad($angle)) + ($xInit - ($widthText / 2));
        $y = $radius * sin(deg2rad($angle)) + $yInit;
        $this->pdf->Text($x, $y, $text);
    }

    /**
     * Set circle inner radius
     * @return void
     */
    protected function setInnerRadiusCircle(): void
    {
        $innerRadius = $this->getInnerRadius();
        if (empty($innerRadius)) {
            return;
        }
        $fillColor = $this->getFillColor();
        $this->setFillColor($fillColor);
        $this->pdf->Circle($this->x, $this->y, $innerRadius, 0, 360, 'DF');
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
     * Set radius inner
     * @param float $innerRadius Inner radius
     * @return PieChart
     */
    public function setInnerRadius($innerRadius)
    {
        $this->innerRadius = $innerRadius;
        return $this;
    }

}
