<?php

namespace ChartPdf\Tests\Charts\Bar;

use ChartPdf\Charts\Axis;
use ChartPdf\Charts\Bar\Bar;
use ChartPdf\Charts\Bar\BarLine;
use ChartPdf\Charts\Bar\DataBar;
use ChartPdf\Tests\Charts\TestCaseChartPdf;
use Mpdf\Output\Destination;

/**
 * Pie chart test
 */
class BarTest extends TestCaseChartPdf
{
    /**
     * Bar test sample
     */
    public function testBar(): void
    {
        $data = $this->getDataBar($this->getDataChart());
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $bar = new Bar($pdf);
        $bar->setX(35);
        $bar->setY(90);
        $bar->setWidth(150);
        $bar->setHeight(80);
        $bar->setHorizontalGrid(true);
        $bar->setVerticalGrid(true);
        $bar->setAxisX($axisX);
        $bar->setAxisY($axisY);
        $bar->setDataBar($data);
        $bar->setLineWidth(0.1);
        $bar->write();
        $result = $pdf->Output('bar01.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/bar01.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Bar test sample
     */
    public function testBarLight(): void
    {
        $data = [];
        $dados = [
            [
                'x' => 'Abr/21',
                'y' => 342,
            ],
            [
                'x' => 'Mai/21',
                'y' => 234,
            ],
            [
                'x' => 'Jun/21',
                'y' => 206,
            ],
            [
                'x' => 'Jul/21',
                'y' => 176,
            ],
            [
                'x' => 'Ago/21',
                'y' => 148,
            ],
            [
                'x' => 'Set/21',
                'y' => 158,
            ],
            [
                'x' => 'Out/21',
                'y' => 183,
            ],
            [
                'x' => 'Nov/21',
                'y' => 215,
            ],
            [
                'x' => 'Dez/21',
                'y' => 237,
            ],
            [
                'x' => 'Jan/22',
                'y' => 217,
            ],
            [
                'x' => 'Fev/22',
                'y' => 306,
            ],
            [
                'x' => 'Mar/22',
                'y' => 223,
            ],
            [
                'x' => 'Abr/22',
                'y' => 298,
            ],
        ];
        foreach ($dados as $dado) {
            $dataBar = new DataBar();
            $dataBar->setColor([0, 153, 145]);
            $dataBar->setX($dado['x']);
            $dataBar->setY($dado['y']);
            $data[] = $dataBar;
        }
        $axisX = [
            'Abr/21',
            'Mai/21',
            'Jun/21',
            'Jul/21',
            'Ago/21',
            'Set/21',
            'Out/21',
            'Nov/21',
            'Dez/21',
            'Jan/22',
            'Fev/22',
            'Mar/22',
            'Abr/22',
        ];
        $axisY = [
            0,
            100,
            200,
            300,
            400
        ];
        $xFunction = function (int $key, Axis $axi) {
            $axi->setFont('Arial', 8);
        };
        $yFunction = function (int $key, Axis $axi) {
            $axi->setFont('Arial', 8);
        };
        $pdf = $this->getPdfInstance();
        $bar = new Bar($pdf);
        $bar->setFormatX($xFunction);
        $bar->setFormatY($yFunction);
        $bar->setX(35);
        $bar->setY(90);
        $bar->setWidth(150);
        $bar->setHeight(80);
        $bar->setLineWidth(100);
        $bar->setShowLineAxisY(false);
        $bar->setShowTicksX(false);
        $bar->setHorizontalGrid(true);
        $bar->setVerticalGrid(false);
        $bar->setAxisX($this->dataToAxis($axisX));
        $bar->setAxisY($this->dataToAxis($axisY));
        $bar->setDataBar($data);
        $bar->setLineWidth(0.1);
        $bar->write();
        $result = $pdf->Output('bar_light_consumo.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/bar_light_consumo.pdf');
        $this->compararPdf($expected, $result);
        $this->assertTrue(true);
    }

    /**
     * Return data chart bar
     * @param array $data Data bar
     * @return DataBar[]
     */
    protected function getDataBar(array $data): array
    {
        $return = [];
        foreach ($data as $item) {
            $obj = new DataBar();
            $obj->setLineWidth(0.5);
            $obj->setDashed(false);
            $obj->setColor($item['color']);
            $obj->setColorDraw($item['color']);
            $obj->setX($item['x']);
            $obj->setY($item['y']);
            $return[] = $obj;
        }
        return $return;
    }

    /**
     * Bar test sample
     */
    public function testBarSmall(): void
    {
        $data = $this->getDataBar($this->getDataChart());
        $data = [$data[0], $data[1], $data[2]];
        $axisX = $this->returnAxisX();
        $axisX = [$axisX[0], $axisX[1], $axisX[2]];
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $bar = new Bar($pdf);
        $bar->setX(35);
        $bar->setY(90);
        $bar->setWidth(150);
        $bar->setHeight(80);
        $bar->setHorizontalGrid(true);
        $bar->setVerticalGrid(true);
        $bar->setAxisX($axisX);
        $bar->setAxisY($axisY);
        $bar->setDataBar($data);
        $bar->setLineWidth(0.1);
        $bar->write();
        $result = $pdf->Output('bar02.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/bar02.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Bar test sample
     */
    public function testBarLine(): void
    {
        $data = $this->getDataBar($this->getDataChart());
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $bar = new BarLine($pdf);
        $bar->setX(35);
        $bar->setY(90);
        $bar->setWidth(150);
        $bar->setHeight(80);
        $bar->setHorizontalGrid(true);
        $bar->setVerticalGrid(true);
        $bar->setAxisX($axisX);
        $bar->setAxisY($axisY);
        $bar->setDataBar($data);
        $bar->setLineWidth(0.1);
        $bar->write();
        $result = $pdf->Output('bar03.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/bar03.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Bar test sample
     */
    public function testBarNegative(): void
    {
        $data = $this->getDataBar($this->getDataChartNegative());
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisYNegative();
        $pdf = $this->getPdfInstance();
        $bar = new Bar($pdf);
        $bar->setX(35);
        $bar->setY(90);
        $bar->setWidth(150);
        $bar->setHeight(80);
        $bar->setHorizontalGrid(false);
        $bar->setVerticalGrid(false);
        $bar->setAxisX($axisX);
        $bar->setAxisY($axisY);
        $bar->setDataBar($data);
        $bar->setShowAxisX(false);
        $bar->setLineWidth(0.1);
        $bar->write();
        $result = $pdf->Output('bar04.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/bar04.pdf');
        $this->compararPdf($expected, $result);
    }


    /**
     * Bar test sample
     */
    public function testBarNegativeWithGrid(): void
    {
        $data = $this->getDataBar($this->getDataChartNegative());
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisYNegative();
        $pdf = $this->getPdfInstance();
        $bar = new Bar($pdf);
        $bar->setX(35);
        $bar->setY(90);
        $bar->setWidth(150);
        $bar->setHeight(80);
        $bar->setHorizontalGrid(true);
        $bar->setVerticalGrid(true);
        $bar->setAxisX($axisX);
        $bar->setAxisY($axisY);
        $bar->setDataBar($data);
        $bar->setShowAxisX(false);
        $bar->setLineWidth(0.1);
        $bar->write();
        $result = $pdf->Output('bar05.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/bar05.pdf');
        $this->compararPdf($expected, $result);
    }
}
