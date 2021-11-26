<?php

namespace ChartPdf\Charts\Progress;
/**
 * Circle progress class
 */
class CircleProgress extends Progress
{

    protected function load(): void
    {
        $x = $this->getX();
        $y = $this->getY();
        $radius = $this->getRadius();
        $this->pdf->SetFillColor(218, 221, 228);
        $this->chartPdf->Circle($x, $y, $radius, 0, 360, 'F');
        $this->pdf->SetFillColor(255, 255, 255);
        $this->chartPdf->Circle($x, $y, ($radius * 0.95), 0, 360, 'F');
        $startAngle = 180;
        $percent = $this->getPercent();
        $finishAngle = ($percent * 360 / 100) + $startAngle;
        $angles = range(180, $finishAngle);

        foreach ($angles as $angle) {
            $points[] = $radius * cos(deg2rad($angle)) + $x;
            $points[] = $radius * sin(deg2rad($angle)) + $y;
        }
        foreach (array_reverse($angles) as $angle) {
            $points[] = ($radius * 0.95) * cos(deg2rad($angle)) + $x;
            $points[] = ($radius * 0.95) * sin(deg2rad($angle)) + $y;
        }
        $this->pdf->SetFillColor(50, 169, 196);
        $this->chartPdf->Polygon($points, 'F');

        $diff = $radius - ($radius * 0.95);
        $radius -= $diff / 2;
        $pointerX = $radius * cos(deg2rad($finishAngle)) + $x;
        $pointerY = $radius * sin(deg2rad($finishAngle)) + $y;
        $this->chartPdf->Circle($pointerX, $pointerY, 3, 0, 360, 'F');
        $this->pdf->SetFillColor(255, 255, 255);
        $this->chartPdf->Circle($pointerX, $pointerY, 2.5, 0, 360, 'F');


    }
}
