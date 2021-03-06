<?php

namespace ChartPdf\Charts\LineArea;

use ChartPdf\Charts\Line\DataLine;
use ChartPdf\Charts\Line\Line;

/**
 * Line area
 */
class LineArea extends Line
{
    /**
     * Alpha area
     * @var float
     */
    protected float $alpha = 0.3;

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        parent::load();
        $this->loadLineArea();
    }

    /**
     * Load line chart points
     * @return void
     */
    protected function loadLineArea(): void
    {
        $lines = $this->getLines();
        $this->simpleLineSegment($lines);
        parent::simpleLineSegment($lines);
        parent::setPointChart();
    }

    /**
     * Set simple line chart
     * @param DataLine[] $lines Lines
     * @return void
     */
    protected function simpleLineSegment(array $lines): void
    {
        $styleLine = ['all' => ['width' => -1]];
        foreach ($lines as $line) {
            $color = $line->getColor();
            $lineWidth = $line->getLineWidth();
            $this->pdf->SetDrawColor($color[0], $color[1], $color[2]);
            $this->pdf->SetFillColor($color[0], $color[1], $color[2]);
            $this->pdf->SetLineWidth($lineWidth);
            $points = $this->getFullPoints($line);
            $this->pdf->setAlpha($this->getAlpha());
            $this->chartPdf->Polygon($points, 'FD', $styleLine);
            $this->pdf->setAlpha(1);//remove alpha
        }
    }

    /**
     * Full points polygon
     * @param DataLine $line Line data
     * @return array
     */
    protected function getFullPoints(DataLine $line): array
    {
        $points = $this->getPointsLine($line);
        $points[] = $this->getDataMaxX($line);
        $points[] = $this->getInitPointY();
        $points[] = $this->getDataMinX($line);
        $points[] = $this->getInitPointY();
        return $points;
    }

    /**
     * Return points of line
     * @param DataLine $line Line data
     * @return array
     */
    protected function getPointsLine(DataLine $line): array
    {
        $return = [];
        $points = $line->getPoints();
        foreach ($points as $point) {
            $return[] = $this->getXPosition($point->getX());
            $return[] = $this->getYPosition($point->getY());
        }
        return $return;
    }

    /**
     * @return float
     */
    public function getAlpha(): float
    {
        return $this->alpha;
    }

    /**
     * @param float $alpha
     * @return LineArea
     */
    public function setAlpha(float $alpha): LineArea
    {
        $this->alpha = $alpha;
        return $this;
    }

    /**
     * Set point chart
     * @return void
     */
    protected function setPointChart(): void
    {
        return;
    }
}
