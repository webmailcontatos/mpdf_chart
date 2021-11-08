<?php

namespace App\Tests\Charts\Pie;

use App\Charts\ChartPdf;
use App\Charts\Pie\DataPie;
use App\Charts\Pie\Pie;
use App\Tests\Charts\TestCaseChartPdf;
use Mpdf\Output\Destination;

/**
 * Pie chart test
 */
class PieTest extends TestCaseChartPdf
{
    /**
     * Pie test sample
     */
    public function testPie(): void
    {
        $pdf = $this->getPdfInstance();
        $data = $this->getDataPie();
        $pieChart = new Pie($pdf);
        $pieChart->setRadius(35);
        $pieChart->setX(50);
        $pieChart->setY(50);
        $pieChart->setInnerRadius(0);
        $pieChart->setData($data);
        $pieChart->write();
        $result = $pdf->Output('pie01.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/pie01.pdf');
        $this->compararPdf($expected, $result);
    }

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
     * Return data pie
     * @return DataPie[]
     */
    protected function getDataPie(): array
    {
        $return = [];
        $dataPie = new DataPie();
        $dataPie->setData(33);
        $dataPie->setColorFill([239, 124, 142]);
        $dataPie->setColorDraw([255, 255, 255]);
        $dataPie->setLegend('A');
        $return[] = $dataPie;
        $dataPie = new DataPie();
        $dataPie->setData(33);
        $dataPie->setColorFill([250, 232, 224]);
        $dataPie->setColorDraw([255, 255, 255]);
        $dataPie->setLegend('B');
        $return[] = $dataPie;
        $dataPie = new DataPie();
        $dataPie->setData(33);
        $dataPie->setColorFill([182, 226, 211]);
        $dataPie->setColorDraw([255, 255, 255]);
        $dataPie->setLegend('C');
        $return[] = $dataPie;
        return $return;
    }
}
