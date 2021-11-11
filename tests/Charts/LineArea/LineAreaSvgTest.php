<?php

namespace App\Tests\Charts\LineArea;

use App\Charts\LineArea\LineAreaSvg;
use Mpdf\Output\Destination;

/**
 * Test line chart
 */
class LineAreaSvgTest extends LineAreaTest
{
    /**
     * Test sample line chart
     */
    public function testLine(): void
    {
        $data = $this->getDataLine01();
        $data[0]->setColor([247, 148, 137]);
        $data[0]->setLineWidth(0.5);
        $points = $data[0]->getPoints();
        foreach ($points as $point) {
            $point->setColorFill([255, 255, 255]);
            $point->setColorDraw([247, 148, 137]);
        }
        $axisX = $this->returnAxisX();
        $axisY = $this->returnAxisY();
        $pdf = $this->getPdfInstance();
        $line = new LineAreaSvg($pdf);
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
        $line->setHorizontalGrid(true);
        $line->write();
        $result = $pdf->Output('lineAreaSvg01.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/lineAreaSvg01.pdf');
        $this->compararPdf($expected, $result);
    }
}
