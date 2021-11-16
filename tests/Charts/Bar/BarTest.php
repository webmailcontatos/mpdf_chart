<?php

namespace App\Tests\Charts\Bar;

use App\Charts\Bar\Bar;
use App\Tests\Charts\TestCaseChartPdf;
use Mpdf\Output\Destination;

/**
 * Pie chart test
 */
class BarTest extends TestCaseChartPdf
{
    /**
     * Bar test sample
     */
    public function testBar(): void
    {
        $data = $this->getDataChart();
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $bar = new Bar($pdf);
        $bar->setX(35);
        $bar->setY(90);
        $bar->setWidth(150);
        $bar->setHeight(80);
        $bar->setHorizontalGrid(true);
        $bar->setVerticalGrid(true);
        $bar->setAxisX($axisX);
        $bar->setAxisY($axisY);
        $bar->setDataBar($data);
        $bar->setLineWidth(0.1);
        $bar->write();
        $result = $pdf->Output('bar01.pdf', Destination::FILE);
//        $expected = file_get_contents(__DIR__ . '/../../files/bar01.pdf');
//        $this->compararPdf($expected, $result);
    }
}
