<?php

namespace ChartPdf\Tests\Charts\LineArea;

use ChartPdf\Charts\LineArea\GradientSvg;
use ChartPdf\Charts\LineArea\LineAreaSvg;
use ChartPdf\Charts\LineArea\Stop;
use ChartPdf\Charts\ScaleLinear;
use ChartPdf\Tests\Charts\TestCaseChartPdf;
use Mpdf\Output\Destination;

/**
 * Test line chart
 */
class LineAreaSvgTest extends TestCaseChartPdf
{
    /**
     * Test sample line chart
     */
    public function testLine(): void
    {
        $gradient = $this->getGradientObject();
        $data = [$this->getDataLine01()[0]];
        $data[0]->setColor([247, 148, 137]);
        $data[0]->setLineWidth(0.5);
        $points = $data[0]->getPoints();
        foreach ($points as $point) {
            $point->setColorFill([255, 255, 255]);
            $point->setColorDraw([247, 148, 137]);
        }
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $line = new LineAreaSvg($pdf);
        $line->setGradientSvg($gradient);
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
        $line->write();
        $result = $pdf->Output('lineAreaSvg01.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/lineAreaSvg01.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Return gradient object
     * @return GradientSvg
     */
    protected function getGradientObject(): GradientSvg
    {
        $gradient = new GradientSvg();
        $gradient->setX1(100);
        $gradient->setX2(100);
        $gradient->setY1(100);
        $gradient->setY2(100);
        $stop1 = new Stop();
        $stop1->setOffset(0);
        $stop1->setStyle('stop-color:rgb(249, 241, 240);stop-opacity:1');
        $stop2 = new Stop();
        $stop2->setOffset(100);
        $stop2->setStyle('stop-color:rgb(247, 148, 137);stop-opacity:1');
        $gradient->setStops([$stop1, $stop2]);
        return $gradient;
    }

    /**
     * Test sample line chart
     */
    public function testLineScaleLinear(): void
    {
        $gradient = $this->getGradientObject();
        $data = [$this->getDataLine05()[0]];
        $data[0]->setColor([247, 148, 137]);
        $data[0]->setLineWidth(0.5);
        $data[0]->showPoint();
        $points = $data[0]->getPoints();
        foreach ($points as $point) {
            $point->setColorFill([255, 255, 255]);
            $point->setColorDraw([247, 148, 137]);
        }
        $axisX = range(0, 9);
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $scaleX = new ScaleLinear($axisX, 150, 35);
        $line = new LineAreaSvg($pdf);
        $line->setGradientSvg($gradient);
        $line->setX(35);
        $line->setY(90);
        $line->setWidth(150);
        $line->setHeight(80);
        $line->setHorizontalGrid(true);
        $line->setVerticalGrid(true);
        $line->setAxisX($axisX);
        $line->setAxisY($axisY);
        $line->setLines($data);
        $line->setScaleX($scaleX);
        $line->setLineWidth(0.1);
        $line->write();
        $result = $pdf->Output('lineAreaSvg02.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/lineAreaSvg02.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Test sample line chart
     */
    public function testLineScaleLinear02(): void
    {
        $gradient = $this->getGradientObject();
        $data = [$this->getDataLine06()[0]];
        $data[0]->setColor([247, 148, 137]);
        $data[0]->setLineWidth(0.5);
        $data[0]->showPoint();
        $points = $data[0]->getPoints();
        foreach ($points as $point) {
            $point->setColorFill([255, 255, 255]);
            $point->setColorDraw([247, 148, 137]);
        }
        $axisX = range(0, 9);
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $scaleX = new ScaleLinear($axisX, 150, 35);
        $line = new LineAreaSvg($pdf);
        $line->setGradientSvg($gradient);
        $line->setX(35);
        $line->setY(90);
        $line->setWidth(150);
        $line->setHeight(80);
        $line->setHorizontalGrid(true);
        $line->setVerticalGrid(true);
        $line->setAxisX($axisX);
        $line->setAxisY($axisY);
        $line->setLines($data);
        $line->setScaleX($scaleX);
        $line->setLineWidth(0.1);
        $line->write();
        $result = $pdf->Output('lineAreaSvg03.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/lineAreaSvg03.pdf');
        $this->compararPdf($expected, $result);
    }
}
