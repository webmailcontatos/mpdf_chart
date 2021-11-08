<?php

use App\Charts\ChartPdf;
use App\Charts\Pie\DataPie;
use App\Charts\Pie\Pie;
use PHPUnit\Framework\TestCase;

/**
 * Pie chart test
 */
class PieTest extends TestCase
{
    /**
     * Pie test sample
     */
    public function testPie(): void
    {
        $pdf = $this->getPdfInstance();
        $data = $this->getDataPie();
        $pieChart = new Pie($pdf);
        $pieChart->radius();
        $pieChart->setX();
        $pieChart->setY();
        $pieChart->setColorDraw([255, 100, 0]);
        $pieChart->setInnerRadius(0);
        $pieChart->setData($data);
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
        $dataPie->setPercent(33);
        $dataPie->setColorFill([239, 124, 142]);
        $dataPie->setColorDraw([255, 0, 0]);
        $dataPie->setLegend('A');
        $return[] = $dataPie;
        $dataPie = new DataPie();
        $dataPie->setPercent(33);
        $dataPie->setColorFill([250, 232, 224]);
        $dataPie->setColorDraw([255, 0, 0]);
        $dataPie->setLegend('B');
        $return[] = $dataPie;
        $dataPie = new DataPie();
        $dataPie->setPercent(33);
        $dataPie->setColorFill([182, 226, 211]);
        $dataPie->setColorDraw([255, 0, 0]);
        $dataPie->setLegend('C');
        $return[] = $dataPie;
        return $return;
    }
}
