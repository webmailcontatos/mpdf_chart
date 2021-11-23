<?php

namespace ChartPdf\Charts\Bar;

use ChartPdf\Charts\Base;

/**
 * Bar chart class
 */
class Bar extends Base
{
    /**
     * Data bar list
     * @var DataBar[]
     */
    protected array $dataBar = [];

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        parent::load();
        $this->setBar();
    }

    /**
     * Set bar on chart
     * @return void
     */
    protected function setBar(): void
    {
        $bars = $this->getDataBar();
        $width = ($this->getWidthAxisLabel() * 0.5);
        $lineWidth = $this->getLineWidth();
        $baseY = $this->getYPosition(0);
        foreach ($bars as $bar) {
            $x = $this->getXPosition($bar->getX());
            $y = $this->getYPosition($bar->getY());
            $yInit = ($baseY < $y) ? ($baseY + $lineWidth) : ($baseY - $lineWidth);
            $color = $bar->getColor();
            $this->pdf->SetFillColor($color[0], $color[1], $color[2]);
            $this->pdf->SetDrawColor($color[0], $color[1], $color[2]);
            $this->pdf->Rect($x - ($width / 2), $y, $width, $yInit - $y, 'FD');
        }
    }

    /**
     * Returna data bar
     * @return DataBar[]
     */
    public function getDataBar(): array
    {
        return $this->dataBar;
    }

    /**
     * Set data bar chart
     * @param DataBar[] $dataBar Data bar
     * @return void
     */
    public function setDataBar(array $dataBar): void
    {
        $this->dataBar = $dataBar;
    }
}
