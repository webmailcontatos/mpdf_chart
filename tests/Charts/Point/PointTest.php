<?php

namespace ChartPdf\Tests\Charts\Point;

use ChartPdf\Charts\Axis;
use ChartPdf\Charts\Point\DataPoint;
use ChartPdf\Charts\Point\Point;
use ChartPdf\Charts\ScaleLinear;
use ChartPdf\Tests\Charts\TestCaseChartPdf;
use Mpdf\Output\Destination;

/**
 * Test point chart
 */
class PointTest extends TestCaseChartPdf
{
    /**
     * Test sample point chart
     */
    public function testPoint(): void
    {
        $data = $this->getDataPoints();
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $point = new Point($pdf);
        $point->setX(35);
        $point->setY(90);
        $point->setWidth(150);
        $point->setHeight(80);
        $point->setHorizontalGrid(false);
        $point->setVerticalGrid(false);
        $point->setAxisX($axisX);
        $point->setAxisY($axisY);
        $point->setPoints($data);
        $point->setLineWidth(0.1);
        $point->write();
        $result = $pdf->Output('point01.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/point01.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Return lines data
     * @return DataPoint[]
     */
    protected function getDataPoints(): array
    {
        $pointConfig = [
            0 => [
                'color'   => [255, 0, 0],
                'increse' => 1,
            ],
            1 => [
                'color'   => [255, 200, 0],
                'increse' => 0.5,
            ],
            3 => [
                'color'   => [150, 100, 100],
                'increse' => 1.2,
            ]
        ];
        $points = [];
        $data = $this->getDataChart();
        foreach ($pointConfig as $config) {
            $color = $config['color'];
            $increse = $config['increse'];
            foreach ($data as $configPoint) {
                $point = new DataPoint();
                $point->setColorDraw($color);
                $point->setColorFill($color);
                $point->setY($configPoint['y'] * $increse);
                $point->setX($configPoint['x']);
                $point->setFill(true);
                $point->setSize(0.5);
                $points[] = $point;
            }
        }
        return $points;
    }

    /**
     * Test sample point chart
     */
    public function testPointNegative(): void
    {
        $formatX = function (int $key, Axis $axi) {
            $value = (int) $axi->getText();
            if ($value > 0) {
                $axi->setColor([0, 0, 255]);
            } elseif ($value < 0) {
                $axi->setColor([255, 0, 0]);
            }
        };
        $data = $this->getDataPoints02();
        $axisX = $this->returnAxisYNegative();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $scaleX = new ScaleLinear($axisX, 150, 35);
        $point = new Point($pdf);
        $point->setFormatX($formatX);
        $point->setX(35);
        $point->setY(90);
        $point->setScaleX($scaleX);
        $point->setWidth(150);
        $point->setHeight(80);
        $point->setHorizontalGrid(true);
        $point->setVerticalGrid(true);
        $point->setAxisX($axisX);
        $point->setAxisY($axisY);
        $point->setPoints($data);
        $point->setLineWidth(0.1);
        $point->write();
        $result = $pdf->Output('point02.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/point02.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Return lines data
     * @return DataPoint[]
     */
    protected function getDataPoints02(): array
    {
        $pointConfig = [
            0 => [
                'color'   => [255, 0, 0],
                'increse' => 1,
            ],
            1 => [
                'color'   => [255, 200, 0],
                'increse' => 0.5,
            ],
            3 => [
                'color'   => [150, 100, 100],
                'increse' => 1.2,
            ]
        ];
        $points = [];
        $data = $this->getDataChartLinearNegativePoint();
        foreach ($pointConfig as $config) {
            $color = $config['color'];
            $increse = $config['increse'];
            foreach ($data as $configPoint) {
                $point = new DataPoint();
                $point->setColorDraw($color);
                $point->setColorFill($color);
                $point->setY($configPoint['y'] * $increse);
                $point->setX($configPoint['x']);
                $point->setFill(true);
                $point->setSize(0.5);
                $points[] = $point;
            }
        }
        return $points;
    }
}
