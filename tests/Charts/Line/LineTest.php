<?php

namespace App\Tests\Charts\Pie;

use App\Charts\Line\Line;
use App\Tests\Charts\TestCaseChartPdf;

/**
 * Test line chart
 */
class LineTest extends TestCaseChartPdf
{
    /**
     * Test sample line chart
     */
    public function testLine(): void
    {
        $pdf = $this->getPdfInstance();
        $line = new Line($pdf);
        $line->setX(30);
        $line->setY(30);
        $line->setWidth(400);
        $line->setHeight(400);
        $line->setHorizontalGrid(false);
        $line->setVerticalGrid(false);
        $line->setAxisX();
        $line->setAxisY();
        $line->setLines();
        $line->setLineWidth();
    }
}
