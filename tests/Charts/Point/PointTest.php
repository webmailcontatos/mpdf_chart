<?php

namespace App\Tests\Charts\Pie;

use App\Charts\Point\DataPoint;
use App\Charts\Point\Point;
use App\Tests\Charts\TestCaseChartPdf;
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
        $result = $pdf->Output('point01.pdf', Destination::FILE);
//        $expected = file_get_contents(__DIR__ . '/../../files/line01.pdf');
//        $this->compararPdf($expected, $result);
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
     * Return data char line
     * @return array
     */
    protected function getDataChart(): array
    {
        return [

            [
                'x'     => 'Jan',
                'y'     => 13,
                'color' => [0, 0, 0]
            ], [
                'x'     => 'Fev',
                'y'     => 25,
                'color' => [0, 0, 0]
            ], [
                'x'     => 'Mar',
                'y'     => 37,
                'color' => [0, 0, 0]
            ], [
                'x'     => 'Abr',
                'y'     => 22,
                'color' => [0, 0, 0]
            ], [
                'x'     => 'Mai',
                'y'     => 13,
                'color' => [0, 0, 0]
            ], [
                'x'     => 'Jun',
                'y'     => 77,
                'color' => [0, 0, 0]
            ],
            [
                'x'     => 'Jul',
                'y'     => 54,
                'color' => [0, 0, 0]
            ],
            [
                'x'     => 'Ago',
                'y'     => 62,
                'color' => [0, 0, 0]
            ],
            [
                'x'     => 'Set',
                'y'     => 47,
                'color' => [0, 0, 0]
            ],
            [
                'x'     => 'Out',
                'y'     => 23,
                'color' => [0, 0, 0]
            ],

        ];
    }

    /**
     * Return x axis
     * @return string[]
     */
    protected function returnAxisX(): array
    {
        return [
            'Jan',
            'Fev',
            'Mar',
            'Abr',
            'Mai',
            'Jun',
            'Jul',
            'Ago',
            'Set',
            'Out',
        ];
    }

    /**
     * Return y axis
     * @return string[]
     */
    protected function returnAxisY(): array
    {
        return [
            0,
            10,
            20,
            30,
            40,
            50,
            60,
            70,
            80,
            90,
            100,
        ];
    }
}
