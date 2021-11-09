<?php

namespace App\Charts\Line;

use App\Charts\Scale;

/**
 * Line chart class
 */
class Line extends Scale
{
    /**
     * Lines chart
     * @var DataLine[]
     */
    protected array $lines = [];

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        parent::load();
        $this->simpleLineSegment();
    }

    /**
     * Set simple line chart
     * @param array $points Lines points
     * @return void
     */
    protected function simpleLineSegment(): void
    {
        $lines = $this->getLines();
        foreach ($lines as $line) {
            $conectionX = 0;
            $conectionY = 0;
            $color = $line->getColor();
            $lineWidth = $line->getLineWidth();
            $points = $this->getPoints($line);
            $this->pdf->SetDrawColor($color[0], $color[1], $color[2]);
            $this->pdf->SetLineWidth($lineWidth);
            foreach ($points as $point) {
                if ($conectionX && $conectionY) {
                    $this->pdf->Line($conectionX, $conectionY, $point[0], $point[1]);
                }
                $this->pdf->Line($point[0], $point[1], $point[2], $point[3]);
                $conectionX = $point[2];
                $conectionY = $point[3];
            }
        }
    }

    /**
     * @return array
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * Set attribute lines
     * @param DataLine[] $lines Line data
     * @return Line
     */
    public function setLines(array $lines): Line
    {
        $this->lines = $lines;
        return $this;
    }

    /**
     * Return points of line
     * @param DataLine $line Line data
     * @return array
     */
    protected function getPoints(DataLine $line): array
    {
        $return = [];
        $points = $line->getPoints();
        foreach ($points as $point) {
            $return[] = $this->getXPosition($point->getX());
            $return[] = $this->getYPosition($point->getY());
        }
        return array_chunk($return, 4);
    }
}
