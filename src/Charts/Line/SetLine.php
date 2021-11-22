<?php

namespace ChartPdf\Charts\Line;

/**
 * Set line trait
 */
trait SetLine
{
    /**
     * Set simple line chart
     * @param DataLine[] $lines Lines
     * @return void
     */
    protected function simpleLineSegment(array $lines): void
    {
        foreach ($lines as $line) {
            $conectionX = 0;
            $conectionY = 0;
            $color = $line->getColor();
            $points = $this->getPoints($line);
            $this->pdf->SetDrawColor($color[0], $color[1], $color[2]);
            $styleLine = $this->getStyleLine($line);
            foreach ($points as $point) {
                if ($conectionX && $conectionY) {
                    $this->pdf->Line($conectionX, $conectionY, $point[0], $point[1], $styleLine);
                }
                $this->pdf->Line($point[0], $point[1], $point[2], $point[3], $styleLine);
                $conectionX = $point[2];
                $conectionY = $point[3];
            }
        }
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

    /**
     * Return style line
     * @param DataLine $line Line
     * @return array
     */
    protected function getStyleLine(DataLine $line): array
    {
        $styleLineDefault = ['dash' => 0, 'width' => $line->getLineWidth()];
        if ($line->isDashed()) {
            $styleLineDefault['dash'] = '3,3';
        }
        return $styleLineDefault;
    }
}
