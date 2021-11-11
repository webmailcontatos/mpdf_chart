<?php

namespace App\Tests\Charts\Line;

use App\Charts\Line\DataLine;
use App\Charts\Line\Line;
use App\Charts\Point\DataPoint;
use App\Charts\Point\Symbol;
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
     * Return lines data
     * @return DataLine[]
     */
    protected function getDataLine01(): array
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
            $lineData->showPoint();
            $pointsList = [];
            $increse = $line['increse'];
            foreach ($data as $points) {
                $point = new DataPoint();
                $point->setX($points['x']);
                $point->setY($points['y'] * $increse);
                $point->setColorDraw($line['color']);
                $point->setColorFill([255, 255, 255]);
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
     * Return lines data
     * @return DataLine[]
     */
    protected function getDataLine02(): array
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
                $point = new DataPoint();
                $point->setX($points['x']);
                $point->setY($points['y'] * $increse);
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
     * Return lines data
     * @return DataLine[]
     */
    protected function getDataLine03(): array
    {
        $linesConfig = [
            0 => [
                'color'     => [255, 0, 0],
                'lineWidth' => 0.5,
                'increse'   => 1,
                'symbol'    => Symbol::CIRCLE,
                'size'      => 0.5,
            ],
            1 => [
                'color'     => [255, 200, 0],
                'lineWidth' => 0.5,
                'increse'   => 0.5,
                'symbol'    => Symbol::TRIANGLE,
                'size'      => 2,
            ],
            3 => [
                'color'     => [150, 100, 100],
                'lineWidth' => 0.5,
                'increse'   => 1.2,
                'symbol'    => Symbol::DIAMOND,
                'size'      => 1.5,
            ]
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
                $point->setSymbol($line['symbol']);
                $point->setSize($line['size']);
                $point->setFill(true);
                $point->setColorDraw($line['color']);
                $point->setColorFill($line['color']);
                $pointsList[] = $point;
            }
            $lineData->setPoints($pointsList);
            $lines[] = $lineData;
        }
        return $lines;
    }
}
