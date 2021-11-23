<?php

namespace ChartPdf\Tests\Charts\Bar;

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
}
