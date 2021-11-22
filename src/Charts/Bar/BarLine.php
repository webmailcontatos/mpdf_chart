<?php

namespace ChartPdf\Charts\Bar;

use ChartPdf\Charts\Line\DataLine;
use ChartPdf\Charts\Line\SetLine;
use ChartPdf\Charts\Point\DataPoint;
use ChartPdf\Charts\Point\SetPoint;

/**
 * Bar chart class
 */
class BarLine extends Bar
{
    /**
     * Set line
     */
    use SetLine;

    /**
     * Set point
     */
    use SetPoint;

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        parent::load();
        $this->setLine();
    }

    /**
     * Set line o the top of bar
     */
    protected function setLine(): void
    {
        $bars = $this->getDataBar();
        $line = new DataLine();
        $points = [];
        foreach ($bars as $bar) {
            $point = new DataPoint();
            $point->setY($bar->getY());
            $point->setX($bar->getX());
            $points[] = $point;
            $this->addPoint($point);
        }
        $line->setPoints($points);
        $this->simpleLineSegment([$line]);

    }
}
