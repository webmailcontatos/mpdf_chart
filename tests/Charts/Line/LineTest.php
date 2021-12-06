<?php

namespace ChartPdf\Tests\Charts\Line;

use ChartPdf\Charts\Axis;
use ChartPdf\Charts\Line\DataLine;
use ChartPdf\Charts\Line\Line;
use ChartPdf\Charts\LineArea\LineArea;
use ChartPdf\Charts\Point\DataPoint;
use ChartPdf\Charts\ScaleLinear;
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
        $scaleX = new ScaleLinear($axisX, 150, 35, 2);
        $line = new Line($pdf);
        $line->setX(35);
        $line->setY(90);
        $line->setWidth(150);
        $line->setHeight(80);
        $line->setScaleX($scaleX);
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

    /**
     * Test sample line chart
     */
    public function testLineLinearScaleFill(): void
    {
        $data = $this->getDataLine05();
        $axisX = range(0, 9);
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $line = new LineArea($pdf);
        $scaleX = new ScaleLinear($axisX, 150, 35, 2);
        $line->setX(35);
        $line->setY(90);
        $line->setWidth(150);
        $line->setHeight(80);
        $line->setHorizontalGrid(false);
        $line->setVerticalGrid(false);
        $line->setAxisX($axisX);
        $line->setAxisY($axisY);
        $line->setLines($data);
        $line->setScaleX($scaleX);
        $line->setLineWidth(0.1);
        $line->setHorizontalGrid(true);
        $line->setVerticalGrid(true);
        $line->write();
        $result = $pdf->Output('line06.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line06.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Test sample line chart
     */
    public function testLineFormatYAndXAxis(): void
    {
        $yFunction = function (int $key, Axis $axi) {
            $modulo = (int) $axi->getText() % 3;
            if ($modulo === 0) {
                $axi->setColor([255, 0, 0]);
            }
            $axi->setText($axi->getText() . '%');
            return $axi;
        };
        $xFunction = function (int $key, Axis $axi) {
            $reds = ['Jan', 'Mai', 'Out'];
            if (in_array($axi->getText(), $reds)) {
                $axi->setColor([100, 255, 100]);
            }
            return $axi;
        };
        $data = $this->getDataLine01();
        $data[0]->setLineWidth(0.01);
        $data[1]->setLineWidth(0.01);
        $data[2]->setLineWidth(0.01);
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $line = new Line($pdf);
        $line->setFormatY($yFunction);
        $line->setFormatX($xFunction);
        $line->setX(35);
        $line->setY(90);
        $line->setWidth(150);
        $line->setHeight(80);
        $line->setHorizontalGrid(false);
        $line->setVerticalGrid(false);
        $line->setAxisX($axisX);
        $line->setAxisY($axisY);
        $line->setLines($data);
        $line->setLineWidth(0.01);
        $line->write();
        $result = $pdf->Output('line07.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line07.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Test sample line chart
     */
    public function testLineFormatYAndXAxisFont(): void
    {
        $yFunction = function (int $key, Axis $axi) {
            $axi->setFont('garuda', 8, 'BI');
            $axi->setText('R$ ' . $axi->getText() . ',00');
            return $axi;
        };
        $xFunction = function (int $key, Axis $axi) {
            $number = str_pad(($key + 1), 2, '0', STR_PAD_LEFT);
            $axi->setText($number . '/' . $axi->getText());
            $axi->setFont('garuda', 8, 'BI');
            return $axi;
        };
        $data = $this->getDataLine01();
        $data[0]->setLineWidth(0.01);
        $data[1]->setLineWidth(0.01);
        $data[2]->setLineWidth(0.01);
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $line = new Line($pdf);
        $line->setFormatY($yFunction);
        $line->setFormatX($xFunction);
        $line->setX(35);
        $line->setY(90);
        $line->setWidth(150);
        $line->setHeight(80);
        $line->setHorizontalGrid(true);
        $line->setVerticalGrid(true);
        $line->setAxisX($axisX);
        $line->setAxisY($axisY);
        $line->setLines($data);
        $line->setLineWidth(0.01);
        $line->write();
        $result = $pdf->Output('line08.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line08.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Test sample line chart
     */
    public function testLineBackgroundColor(): void
    {
        $data = $this->getDataLine01();
        $data[0]->setLineWidth(0.01);
        $data[1]->setLineWidth(0.01);
        $data[2]->setLineWidth(0.01);
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
        $line->setLineWidth(0.01);
        $line->setShowTicksX(false);
        $line->setShowLineAxisX(false);
        $line->setShowTicksY(false);
        $line->setShowLineAxisY(false);
        $line->setBackgroundColor(true);
        $line->write();
        $result = $pdf->Output('line09.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line09.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Test sample line chart
     */
    public function testLineGridAxisYDiff01(): void
    {
        $data = [$this->getDataLine07()[0]];
        $data[0]->setDashed(true);
        $data[0]->setLineWidth(0.2);
        $axisX = $this->returnAxisX();
        $axisY = range(30, 100, 10);
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
        $result = $pdf->Output('line10.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line10.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Test sample line chart
     */
    public function testLineGridAxisYDiff02(): void
    {
        $data = [$this->getDataLine07()[0]];
        $data[0]->setDashed(true);
        $data[0]->setLineWidth(0.2);
        $axisX = $this->returnAxisX();
        $axisY = range(30, 100, 5);
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
        $result = $pdf->Output('line11.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line11.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Test sample line chart
     */
    public function testLineGridAxisYDiff03(): void
    {
        $data = [$this->getDataLine07()[1]];
        $data[0]->setDashed(true);
        $data[0]->setLineWidth(0.2);
        $axisX = $this->returnAxisX();
        $axisY = range(10, 50, 5);
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
        $result = $pdf->Output('line12.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/line12.pdf');
        $this->compararPdf($expected, $result);
    }
}
