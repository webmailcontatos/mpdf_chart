<?php

namespace ChartPdf\Tests\Charts\LineArea;

use ChartPdf\Charts\Line\DataLine;
use ChartPdf\Charts\LineArea\LineArea;
use ChartPdf\Charts\Point\DataPoint;
use ChartPdf\Charts\ScaleLinear;
use ChartPdf\Tests\Charts\TestCaseChartPdf;
use Mpdf\Output\Destination;

/**
 * Test line chart
 */
class LineAreaTest extends TestCaseChartPdf
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
        $line = new LineArea($pdf);
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
        $result = $pdf->Output('lineArea01.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/lineArea01.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Return lines data
     * @return DataLine[]
     */
    protected function getDataLine01(): array
    {
        $linesConfig = [
            0 => [
                'color'     => [132, 159, 209],
                'lineWidth' => 0.3,
                'increse'   => 1,
            ],
        ];
        $lines = [];
        $data = $this->getDataChart();

        foreach ($linesConfig as $line) {
            $lineData = new DataLine();
            $lineData->setColor($line['color']);
            $lineData->setLineWidth($line['lineWidth']);
            $lineData->showPoint();
            $pointsList = [];
            $increse = $line['increse'];
            foreach ($data as $points) {
                $point = new DataPoint();
                $point->setX($points['x']);
                $point->setY($points['y'] * $increse);
                $point->setColorDraw($line['color']);
                $point->setColorFill($line['color']);
                $point->setFill(true);
                $point->setSize(1);
                $pointsList[] = $point;
            }
            $lineData->setPoints($pointsList);
            $lines[] = $lineData;
        }
        return $lines;
    }

    /**
     * Test sample line chart
     */
    public function testLineLinear(): void
    {
        $data = [$this->getDataLine06()[0]];
        $axisX = range(0, 9);
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $scaleX = new ScaleLinear($axisX, 150, 35);
        $line = new LineArea($pdf);
        $line->setScaleX($scaleX);
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
        $line->setAlpha(0.5);
        $line->write();
        $result = $pdf->Output('lineArea02.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/lineArea02.pdf');
        $this->compararPdf($expected, $result);
    }
}
