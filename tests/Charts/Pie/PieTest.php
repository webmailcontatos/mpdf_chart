<?php

namespace ChartPdf\Tests\Charts\Pie;

use ChartPdf\Charts\Pie\DataPie;
use ChartPdf\Charts\Pie\Pie;
use ChartPdf\Charts\Pie\Velocimeter;
use ChartPdf\Tests\Charts\TestCaseChartPdf;
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

    /**
     * Pie test sample
     */
    public function testPieSepareted(): void
    {
        $pdf = $this->getPdfInstance();
        $data = $this->getDataPie01();
        $data[0]->setRadius(40);
        $pieChart = new Pie($pdf);
        $pieChart->setRadius(35);
        $pieChart->setX(50);
        $pieChart->setY(50);
        $pieChart->setInnerRadius(0);
        $pieChart->setData($data);
        $pieChart->write();
        $result = $pdf->Output('pie05.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/pie05.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Pie test sample
     */
    public function testPieWithLegendStart145(): void
    {
        $pdf = $this->getPdfInstance();
        $data = $this->getDataPie03();
        $pieChart = new Pie($pdf);
        $pieChart->setRadius(35);
        $pieChart->setX(50);
        $pieChart->setY(50);
        $pieChart->setInnerRadius(0);
        $pieChart->setData($data);
        $pieChart->setStartAngle(145);
        $sum = $pieChart->sumData();
        foreach ($data as $item) {///set legend
            $legend = round(($item->getData() / $sum) * 100) . '%';
            $item->setLegend($legend);
        }
        $pieChart->write();
        $result = $pdf->Output('pie06.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/pie06.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Pie test sample
     */
    public function testVelocimeter(): void
    {
        $pdf = $this->getPdfInstance();
        $data = $this->getDataPie03();
        $pieChart = new Velocimeter($pdf);
        $pieChart->setRadius(60);
        $pieChart->setX(100);
        $pieChart->setY(100);
        $pieChart->setInnerRadius(0);
        $pieChart->setData($data);
        $pieChart->setStartAngle(180);
        $pieChart->setFinishArc(180);
        $pieChart->setInnerRadius(20);
        $pieChart->setCurrentPosition(112.5);
        $colors = [
            [146, 209, 79],
            [251, 191, 1],
            [239, 127, 26],
            [216, 39, 36],
        ];
        $legends = [
            'Low',
            'Medium',
            'High',
            'Critical',
        ];
        foreach ($data as $key => $item) {///set legend
            $item->setData(25);
            $item->setColorFill($colors[$key]);
            $item->setLegend($legends[$key]);
        }
        $pieChart->write();
        $result = $pdf->Output('velocimeter01.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/velocimeter01.pdf');
        $this->compararPdf($expected, $result);
    }
}
