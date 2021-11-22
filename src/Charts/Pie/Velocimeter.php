<?php

namespace ChartPdf\Charts\Pie;

/**
 * Velocimeter
 */
class Velocimeter extends Pie
{
    /**
     * Currente position pointer
     * @var float|integer
     */
    protected float $currentPosition = 0;

    /**
     * Set current position pointer
     * @param float $position Position
     * @return void
     */
    public function setCurrentPosition(float $position): void
    {
        $this->currentPosition = $position;
    }

    /**
     * Write chart on the pdf
     * @return void
     */
    protected function load(): void
    {
        parent::load();
        $this->setPointer();
    }

    /**
     * Set pointer
     * @return void
     */
    protected function setPointer(): void
    {
        $x = $this->getX();
        $y = $this->getY();
        $radius = 3;
        $position = $this->getPolygonPointer($radius);
        $this->setColorPointer();
        $currentPosition = (90 - $this->currentPosition) < -90 ? -90 : (90 - $this->currentPosition);
        $this->pdf->Rotate($currentPosition, $x, $y);
        $this->pdf->Polygon($position, 'F');
        $this->pdf->Rotate(0, $x, $y);
        $this->pdf->Circle($x, $y, $radius, 0, 360, 'F');
        $this->pdf->SetFillColor(255, 255, 255);
        $this->pdf->SetDrawColor(255, 255, 255);
        $this->pdf->Circle($x, $y, $radius * 0.8, 0, 360, 'F');
    }

    /**
     * Return polygon pointer
     * @param integer $basePointerRadius Base pointer
     * @return array
     */
    protected function getPolygonPointer(int $basePointerRadius): array
    {
        $x = $this->getX();
        $y = $this->getY();
        $mainRadius = $this->getRadius();
        $radius = $basePointerRadius;
        return [
            ($x - $radius),
            $y,
            ($x + $radius),
            $y,
            $x,
            ($y - ($mainRadius * 0.60))
        ];
    }

    /**
     * Set color pointer
     * @return void
     */
    protected function setColorPointer(): void
    {
        $this->pdf->SetFillColor(69, 75, 89);
        $this->pdf->SetDrawColor(69, 75, 89);
    }
}
