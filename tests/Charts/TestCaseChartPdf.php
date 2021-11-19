<?php

namespace ChartPdf\Tests\Charts;

use ChartPdf\Charts\ChartPdf;
use ChartPdf\Charts\Line\DataLine;
use ChartPdf\Charts\Point\DataPoint;
use ChartPdf\Charts\Point\Symbol;
use Imagick;
use ImagickException;
use PHPUnit\Framework\TestCase;

class TestCaseChartPdf extends TestCase
{
    /**
     * Chart pdf instance
     * @return ChartPdf
     */
    protected function getPdfInstance(): ChartPdf
    {
        $pdf = new ChartPdf();
        $pdf->AddPage();
        return $pdf;
    }

    /**
     * Make compare
     * @param string  $expected Content expected
     * @param string  $result   Content result
     * @param boolean $showDiff If true create image with diff
     * @throws ImagickException|\ImagickException
     */
    protected function compararPdf(string $expected, string $result, bool $showDiff = false)
    {
        $assertedImagick = new Imagick();
        $assertedImagick->readImageBlob($expected);
        $assertedImagick->resetIterator();
        $assertedImagick = $assertedImagick->appendImages(true);

        $testImagick = new Imagick();
        $testImagick->readImageBlob($result);
        $testImagick->resetIterator();
        $testImagick = $testImagick->appendImages(true);

        $diff = $assertedImagick->compareImages($testImagick, 1);
        if ($showDiff) {
            $diff[0]->writeImages('diff.png', false);
        }
        $this->assertSame(0.0, $diff[1]);
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
     * Return data char line
     * @return array
     */
    protected function getDataChart(): array
    {
        return [

            [
                'x'     => 'Jan',
                'y'     => 13,
                'color' => [239, 124, 142]
            ], [
                'x'     => 'Fev',
                'y'     => 25,
                'color' => [250, 232, 224]
            ], [
                'x'     => 'Mar',
                'y'     => 37,
                'color' => [182, 226, 211]
            ], [
                'x'     => 'Abr',
                'y'     => 22,
                'color' => [216, 167, 177]
            ], [
                'x'     => 'Mai',
                'y'     => 13,
                'color' => [255, 244, 189]
            ], [
                'x'     => 'Jun',
                'y'     => 77,
                'color' => [244, 185, 184]
            ],
            [
                'x'     => 'Jul',
                'y'     => 54,
                'color' => [133, 210, 208]
            ],
            [
                'x'     => 'Ago',
                'y'     => 62,
                'color' => [136, 123, 176]
            ],
            [
                'x'     => 'Set',
                'y'     => 47,
                'color' => [113, 0, 25]
            ],
            [
                'x'     => 'Out',
                'y'     => 23,
                'color' => [212, 55, 144]
            ],

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
     * Return lines data
     * @return DataLine[]
     */
    protected function getDataLine04(): array
    {
        $linesConfig = [
            0 => [
                'color'     => [255, 0, 0],
                'lineWidth' => 0.5,
                'increse'   => 1,
                'symbol'    => Symbol::CIRCLE,
                'size'      => 1,
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
        $data = $this->getDataChartLinear();

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

    /**
     * Return data char line
     * @return array
     */
    protected function getDataChartLinear(): array
    {
        return [

            [
                'x'     => 0,
                'y'     => 13,
                'color' => [255, 0, 0]
            ], [
                'x'     => 1,
                'y'     => 25,
                'color' => [0, 0, 0]
            ], [
                'x'     => 2,
                'y'     => 37,
                'color' => [0, 0, 0]
            ], [
                'x'     => 3.5,
                'y'     => 22,
                'color' => [0, 0, 0]
            ], [
                'x'     => 4,
                'y'     => 13,
                'color' => [0, 0, 0]
            ], [
                'x'     => 5.8,
                'y'     => 77,
                'color' => [0, 0, 0]
            ],
            [
                'x'     => 6,
                'y'     => 54,
                'color' => [0, 0, 0]
            ],
            [
                'x'     => 7,
                'y'     => 62,
                'color' => [0, 0, 0]
            ],
            [
                'x'     => 8.2,
                'y'     => 47,
                'color' => [0, 0, 0]
            ],
            [
                'x'     => 9,
                'y'     => 23,
                'color' => [0, 0, 0]
            ],

        ];
    }
}
