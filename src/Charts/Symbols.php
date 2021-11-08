<?php

namespace App\Charts;
/**
 *
 */
trait Symbols
{
    /**
     * Draw triangle
     * @param float $x X position
     * @param float $y Y position
     * @return void
     */
    protected function setTriangle(float $x, float $y, float $size = 2.5): void
    {
        $x -= $size / 2;
        $base = $x + $size;
        $height = ($y - $size) - $y;
        $y -= $height / 2;
        $points = [
            $x,
            $y,
            ($x + ($size / 2)),
            ($y - $size),
            $base,
            $y
        ];
        $this->pdf->Polygon($points, 'F');
    }

    /**
     * Set circle point
     * @param float         $x           Position x
     * @param float         $y           Position y
     * @param float|integer $radiusPoint Radius of circle
     * @return void
     */
    protected function setCirclePoint(float $x, float $y, float $radiusPoint = 1, string $style = 'F'): void
    {
        $this->pdf->Circle($x, $y, $radiusPoint, 0, 360, $style);
    }
}
