<?php

namespace ChartPdf\Tests\Charts\Progress;

use ChartPdf\Charts\Progress\CircleProgress;
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
        $xInit = 10;
        $yInit = 10;
        $width = 180;
        $radius = 5;
        $yLimit = 262;
        foreach ($percents as $percent) {
            $stringPercent = $percent . '%';
            $widthText = $pdf->GetStringWidth($stringPercent);
            $progress = new Progress($pdf);
            $progress->setX($xInit);
            $progress->setY($yInit);
            $progress->setWidth($width);
            $progress->setPercent($percent);
            $progress->setRadius($radius);
            $progress->write();
            $pdf->setY($yInit);
            $pdf->setX($xInit + $width);
            $pdf->cell($widthText, (2 * $radius), $stringPercent, '0', '', 'L');
            $yInit += (2 * $radius) * 1.5;
            if ($pdf->getCurrentY() >= $yLimit) {
                $pdf->AddPage();
                $yInit = 10;
            }
        }
        $result = $pdf->Output('progress01.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/progress01.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Test sample progress chart
     */
    public function testCircleProgress(): void
    {
        $pdf = $this->getPdfInstance();
        $percents = array_chunk(range(0, 100), 2);

        $yInit = 50;
        $width = 75;
        $radius = $width / 2;
        $perimeter = (2 * $radius);
        $yLimit = 200;
        $pdf->SetFont('Arial', 'B', 40);
        $widthCell = $pdf->GetStringWidth('100%');
        $space = $perimeter * 1.2;
        foreach ($percents as $line) {
            $xInit = 50;
            foreach ($line as $percent) {
                $stringPercent = $percent . '%';
                $progress = new CircleProgress($pdf);
                $progress->setX($xInit);
                $progress->setY($yInit);
                $progress->setWidth($width);
                $progress->setPercent($percent);
                $progress->setRadius($radius);
                $progress->write();
                $pdf->setY($yInit);
                $pdf->setX($xInit - ($widthCell / 2));
                $pdf->Cell($widthCell, 0, $stringPercent, '0', 0, 'C');
                $xInit += $space;
            }
            $yInit += $space;
            if ($pdf->getCurrentY() > $yLimit && $percent != 100) {
                $pdf->AddPage();
                $yInit = 50;
            }
        }
        $result = $pdf->Output('progress02.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../../files/progress02.pdf');
        $this->compararPdf($expected, $result);
    }
}
