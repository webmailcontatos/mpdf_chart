<?php

namespace App\Tests\Charts\Line;

use App\Charts\Line\Line;
use App\Tests\Charts\TestCaseChartPdf;
use Mpdf\Output\Destination;

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
        $data = $this->getDataLine01();
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $line = new Line($pdf);
        $line->setX(35);
        $line->setY(90);
        $line->setWidth(150);
        $line->setHeight(80);
        $line->setHorizontalGrid(false);
        $line->setVerticalGrid(false);
        $line->setAxisX($axisX);
        $line->setAxisY($axisY);
        $line->setLines($data);
        $line->setLineWidth(0.1);
        $line->write();
        $result = $pdf->Output('line01.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line01.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Test sample line chart
     */
    public function testOnlyLine(): void
    {
        $data = $this->getDataLine02();
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $line = new Line($pdf);
        $line->setX(35);
        $line->setY(90);
        $line->setWidth(150);
        $line->setHeight(80);
        $line->setHorizontalGrid(false);
        $line->setVerticalGrid(false);
        $line->setAxisX($axisX);
        $line->setAxisY($axisY);
        $line->setLines($data);
        $line->setLineWidth(0.1);
        $line->write();
        $result = $pdf->Output('line02.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line02.pdf');
        $this->compararPdf($expected, $result);
    }


    /**
     * Test sample line chart
     */
    public function testLineSymbols(): void
    {
        $data = $this->getDataLine03();
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $line = new Line($pdf);
        $line->setX(35);
        $line->setY(90);
        $line->setWidth(150);
        $line->setHeight(80);
        $line->setHorizontalGrid(false);
        $line->setVerticalGrid(false);
        $line->setAxisX($axisX);
        $line->setAxisY($axisY);
        $line->setLines($data);
        $line->setLineWidth(0.1);
        $line->write();
        $result = $pdf->Output('line03.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line03.pdf');
        $this->compararPdf($expected, $result);
    }
}
