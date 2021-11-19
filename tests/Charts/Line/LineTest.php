<?php

namespace App\Tests\Charts\Line;

use ChartPdf\Charts\Line\DataLine;
use ChartPdf\Charts\Line\Line;
use ChartPdf\Charts\Line\LineLinear;
use ChartPdf\Charts\Point\DataPoint;
use ChartPdf\Tests\Charts\TestCaseChartPdf;
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
        $data[0]->setDashed(true);
        $data[0]->setLineWidth(0.2);
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

    /**
     * Test sample line chart
     */
    public function testLineLinearScale(): void
    {
        $data = $this->getDataLine04();
        $pointsList = [];
        $lineData = new DataLine();
        $lineData->setColor([0, 100, 0]);
        $lineData->setLineWidth(0.4);
        $point01 = new DataPoint();
        $point01->setX(0);
        $point01->setY(55);
        $point02 = new DataPoint();
        $point02->setX(9);
        $point02->setY(55);
        $pointsList[] = $point01;
        $pointsList[] = $point02;
        $lineData->setPoints($pointsList);
        $data[] = $lineData;
        $axisX = range(0, 9);
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $line = new LineLinear($pdf);
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
        $line->setHorizontalGrid(true);
        $line->setVerticalGrid(true);
        $line->write();
        $result = $pdf->Output('line04.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line04.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Test sample line chart
     */
    public function testLineGrid(): void
    {
        $data = $this->getDataLine01();
        $data[0]->setDashed(true);
        $data[0]->setLineWidth(0.2);
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $line = new Line($pdf);
        $line->setX(35);
        $line->setY(90);
        $line->setWidth(150);
        $line->setHeight(80);
        $line->setHorizontalGrid(true);
        $line->setVerticalGrid(true);
        $line->setAxisX($axisX);
        $line->setAxisY($axisY);
        $line->setLines($data);
        $line->setLineWidth(0.1);
        $line->write();
        $result = $pdf->Output('line05.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line05.pdf');
        $this->compararPdf($expected, $result);
    }
}
