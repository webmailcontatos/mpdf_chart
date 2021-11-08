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
        $data = $this->getDataPie01();
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
    protected function getDataPie01(): array
    {
        $return = [];
        $dataPie = new DataPie();
        $dataPie->setData(33);
        $dataPie->setColorFill([239, 124, 142]);
        $dataPie->setColorDraw([255, 255, 255]);
        $return[] = $dataPie;
        $dataPie = new DataPie();
        $dataPie->setData(33);
        $dataPie->setColorFill([250, 232, 224]);
        $dataPie->setColorDraw([255, 255, 255]);
        $return[] = $dataPie;
        $dataPie = new DataPie();
        $dataPie->setData(33);
        $dataPie->setColorFill([182, 226, 211]);
        $dataPie->setColorDraw([255, 255, 255]);
        $return[] = $dataPie;
        return $return;
    }

    /**
     * Pie test sample
     */
    public function testPieSectorAlpha(): void
    {
        $pdf = $this->getPdfInstance();
        $data = $this->getDataPie02();
        $pieChart = new Pie($pdf);
        $pieChart->setRadius(35);
        $pieChart->setX(50);
        $pieChart->setY(50);
        $pieChart->setInnerRadius(0);
        $pieChart->setData($data);
        $pieChart->write();
        $result = $pdf->Output('pie02.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/pie02.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Return data pie
     * @return DataPie[]
     */
    protected function getDataPie02(): array
    {
        $return = [];

        $dataPie = new DataPie();
        $dataPie->setData(44);
        $dataPie->setColorFill([0, 0, 0]);
        $dataPie->setColorDraw([255, 255, 255]);
        $dataPie->setAlpha(true);
        $return[] = $dataPie;

        $dataPie = new DataPie();
        $dataPie->setData(22);
        $dataPie->setColorFill([180, 248, 200]);
        $dataPie->setColorDraw([255, 255, 255]);
        $return[] = $dataPie;

        $dataPie = new DataPie();
        $dataPie->setData(54);
        $dataPie->setColorFill([160, 231, 229]);
        $dataPie->setColorDraw([255, 255, 255]);
        $return[] = $dataPie;

        $dataPie = new DataPie();
        $dataPie->setData(66);
        $dataPie->setColorFill([255, 174, 188]);
        $dataPie->setColorDraw([255, 255, 255]);
        $return[] = $dataPie;

        return $return;
    }

    /**
     * Pie test sample
     */
    public function testPieWithLegend(): void
    {
        $pdf = $this->getPdfInstance();
        $data = $this->getDataPie03();
        $pieChart = new Pie($pdf);
        $pieChart->setRadius(35);
        $pieChart->setX(50);
        $pieChart->setY(50);
        $pieChart->setInnerRadius(0);
        $pieChart->setData($data);
        $sum = $pieChart->sumData();
        foreach ($data as $item) {///set legend
            $legend = round(($item->getData() / $sum) * 100) . '%';
            $item->setLegend($legend);
        }
        $pieChart->write();
        $result = $pdf->Output('pie03.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/pie03.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Return data pie
     * @return DataPie[]
     */
    protected function getDataPie03(): array
    {
        $return = [];

        $dataPie = new DataPie();
        $dataPie->setData(44);
        $dataPie->setColorFill([22, 125, 127]);
        $dataPie->setColorDraw([255, 255, 255]);
        $return[] = $dataPie;

        $dataPie = new DataPie();
        $dataPie->setData(22);
        $dataPie->setColorFill([180, 248, 200]);
        $dataPie->setColorDraw([255, 255, 255]);
        $return[] = $dataPie;

        $dataPie = new DataPie();
        $dataPie->setData(54);
        $dataPie->setColorFill([160, 231, 229]);
        $dataPie->setColorDraw([255, 255, 255]);
        $return[] = $dataPie;

        $dataPie = new DataPie();
        $dataPie->setData(66);
        $dataPie->setColorFill([255, 174, 188]);
        $dataPie->setColorDraw([255, 255, 255]);
        $return[] = $dataPie;

        return $return;
    }

    /**
     * Pie test sample
     */
    public function testPieWithLegendDonut(): void
    {
        $pdf = $this->getPdfInstance();
        $data = $this->getDataPie03();
        $pieChart = new Pie($pdf);
        $pieChart->setRadius(35);
        $pieChart->setX(50);
        $pieChart->setY(50);
        $pieChart->setInnerRadius(17.5);
        $pieChart->setData($data);
        $sum = $pieChart->sumData();
        foreach ($data as $item) {///set legend
            $legend = round(($item->getData() / $sum) * 100) . '%';
            $item->setLegend($legend);
        }
        $pieChart->write();
        $result = $pdf->Output('pie04.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/pie04.pdf');
        $this->compararPdf($expected, $result);
    }
}
