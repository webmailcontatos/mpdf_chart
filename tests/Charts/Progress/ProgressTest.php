<?php

namespace ChartPdf\Tests\Charts\Progress;

use ChartPdf\Charts\Progress\Progress;
use ChartPdf\Tests\Charts\TestCaseChartPdf;
use Mpdf\Output\Destination;

class ProgressTest extends TestCaseChartPdf
{
    /**
     * Test sample progress chart
     */
    public function testProgress(): void
    {
        $pdf = $this->getPdfInstance();
        $percents = range(0, 100);
        $xInit = 20;
        $yInit = 10;
        $width = 150;
        $height = 10;
        $yLimit = 262;
        foreach ($percents as $percent) {
            $stringPercent = $percent . '%';
            $widthText = $pdf->GetStringWidth($stringPercent);
            $progress = new Progress($pdf);
            $progress->setX($xInit);
            $progress->setY($yInit);
            $progress->setWidth($width);
            $progress->setPercent($percent);
            $progress->setHeight($height);
            $progress->write();
            $pdf->SetXY($xInit + $width, $yInit);
            $pdf->Cell($widthText, $height, $stringPercent, '0', '', 'L');
            $yInit += $height * 1.2;
            if ($pdf->y >= $yLimit) {
                $pdf->AddPage();
                $yInit = 10;
            }
        }
        $result = $pdf->Output('progress01.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/progress01.pdf');
        $this->compararPdf($expected, $result);
    }
}
