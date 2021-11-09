<?php

namespace App\Tests\Charts\Pie;

use App\Charts\Line\DataLine;
use App\Charts\Line\Line;
use App\Charts\Line\Point;
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
        $data = $this->getDataLine();
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
        $result = $pdf->Output('line01.pdf', Destination::FILE);
//        $expected = file_get_contents(__DIR__ . '/../../files/line01.pdf');
//        $this->compararPdf($expected, $result);
    }

    /**
     * Return lines data
     * @return DataLine[]
     */
    protected function getDataLine(): array
    {
        $linesConfig = [
            0 => [
                'color'     => [255, 0, 0],
                'lineWidth' => 0.5,
                'increse'   => 1,
            ],
            1 => [
                'color'     => [255, 200, 0],
                'lineWidth' => 0.5,
                'increse'   => 0.5,
            ],
            3 => [
                'color'     => [150, 100, 100],
                'lineWidth' => 0.5,
                'increse'   => 1.2,
            ]
        ];
        $lines = [];
        $data = $this->getDataChart();

        foreach ($linesConfig as $line) {
            $lineData = new DataLine();
            $lineData->setColor($line['color']);
            $lineData->setLineWidth($line['lineWidth']);
            $pointsList = [];
            $increse = $line['increse'];
            foreach ($data as $points) {
                $point = new Point();
                $point->setX($points['x']);
                $point->setY($points['y'] * $increse);
                $point->setColor($points['color']);
                $pointsList[] = $point;
            }
            $lineData->setPoints($pointsList);
            $lines[] = $lineData;
        }
        return $lines;
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
