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
        $this->simpleLineSegment();
        parent::simpleLineSegment();
        parent::setPointChart();
    }

    /**
     * Set simple line chart
     * @return void
     */
    protected function simpleLineSegment(): void
    {
        $lines = $this->getLines();
        $styleLine = ['all' => ['width' => -1]];
        foreach ($lines as $line) {
            $color = $line->getColor();
            $lineWidth = $line->getLineWidth();
            $this->pdf->SetDrawColor($color[0], $color[1], $color[2]);
            $this->pdf->SetFillColor($color[0], $color[1], $color[2]);
            $this->pdf->SetLineWidth($lineWidth);
            $points = $this->getFullPoints($line);
            $this->pdf->SetAlpha($this->alpha);
            $this->pdf->Polygon($points, 'FD', $styleLine);
            $this->pdf->SetAlpha(1);//remove alpha
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
        $points[] = $this->getMaxX();
        $points[] = $this->getYPosition(0);
        $points[] = $this->getMinX();
        $points[] = $this->getYPosition(0);
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
     * Set point chart
     * @return void
     */
    protected function setPointChart(): void
    {
        return;
    }
}
