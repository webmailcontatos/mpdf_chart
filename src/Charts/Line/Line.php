<?php

namespace ChartPdf\Charts\Line;

use ChartPdf\Charts\Base;
use ChartPdf\Charts\Point\SetPoint;

/**
 * Line chart class
 */
class Line extends Base
{
    /**
     * Set point trait
     */
    use SetPoint;

    /**
     * Set line trait
     */
    use SetLine;

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
        $this->loadLine();
    }

    /**
     * Load line chart points
     * @return void
     */
    protected function loadLine(): void
    {
        $lines = $this->getLines();
        $this->simpleLineSegment($lines);
        $this->setPointChart();
    }

    /**
     * Return lines chart
     * @return DataLine[]
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
     * Set point chart
     * @return void
     */
    protected function setPointChart(): void
    {
        $lines = $this->getLines();
        foreach ($lines as $line) {
            $show = $line->isShowPoint();
            if ($show === false) {
                continue;
            }
            $points = $line->getPoints();
            foreach ($points as $point) {
                $this->addPoint($point);
            }
        }
    }
}
