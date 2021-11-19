<?php

namespace ChartPdf\Charts\Point;

/**
 * Set point trait
 */
trait SetPoint
{
    /**
     * Add point on the chart
     * @param DataPoint $point Point
     * @return void
     */
    protected function addPoint(DataPoint $point): void
    {
        $styleDefault = 'FD';
        $stylePoint = $styleDefault;
        $x = $this->getXPosition($point->getX());
        $y = $this->getYPosition($point->getY());
        $colorDraw = $point->getColorDraw();
        $colorFill = $point->getColorFill();
        $isFill = $point->isFill();
        $size = $point->getSize();
        $symbol = $point->getSymbol();
        if ($isFill === false) {
            $stylePoint = 'D';
        }
        $this->pdf->SetDrawColor($colorDraw[0], $colorDraw[1], $colorDraw[2]);
        $this->pdf->SetFillColor($colorFill[0], $colorFill[1], $colorFill[2]);
        if ($symbol === Symbol::CIRCLE) {
            $this->setCirclePoint($x, $y, $size, $stylePoint);
        }
        if ($symbol === Symbol::TRIANGLE) {
            $this->setTriangulePoint($x, $y, $size, $stylePoint);
        }
        if ($symbol === Symbol::DIAMOND) {
            $this->setDiamontPoint($x, $y, $size, $stylePoint);
        }
    }

    /**
     * Set circle point
     * @param float  $x          X position
     * @param float  $y          Y position
     * @param float  $size       Size circle
     * @param string $stylePoint Style point
     * @return void
     */
    protected function setCirclePoint(float $x, float $y, float $size, string $stylePoint): void
    {
        $styleLine = [
            'width' =>  $this->getLineWidth(),
        ];
        $this->pdf->Circle($x, $y, $size, 0, 360, $stylePoint, $styleLine);
    }

    /**
     * Set triangule point
     * @param float  $x          X position
     * @param float  $y          Y position
     * @param float  $size       Size circle
     * @param string $stylePoint Style point
     * @return void
     */
    protected function setTriangulePoint(float $x, float $y, float $size, string $stylePoint): void
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
        $styleLine = [
            'all' => [
                'width' => $this->getLineWidth(),
            ]
        ];
        $this->pdf->Polygon($points, $stylePoint, $styleLine);
    }

    /**
     * Set triangule point
     * @param float  $x          X position
     * @param float  $y          Y position
     * @param float  $size       Size circle
     * @param string $stylePoint Style point
     * @return void
     */
    protected function setDiamontPoint(float $x, float $y, float $size, string $stylePoint): void
    {
        $x -= $size / 2;
        $base = $x + $size;
        $points = [
            $x,
            $y,
            ($x + ($size / 2)),
            ($y - $size),
            $base,
            $y
        ];
        $styleLine = [
            'all' => [
                'width' => $this->getLineWidth(),
            ]
        ];
        $this->pdf->Polygon($points, $stylePoint, $styleLine);
        $this->pdf->Rotate(180, $x + ($size / 2), $y);
        $this->pdf->Polygon($points, $stylePoint, $styleLine);
        $this->pdf->Rotate(0);
    }
}
