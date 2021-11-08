<?php

use App\Charts\LineChart;
use App\Charts\PdfChart;
use PHPUnit\Framework\TestCase;

/**
 * ExampleOfUseTest
 */
class ExampleOfUseLineTest extends TestCase
{
    /**
     * Linechart sample test
     */
    public function testLineChart(): void
    {
        $mpdf = new PdfChart();
        $mpdf->AddPage();
        $chartLine = new LineChart($mpdf);
        $this->assertTrue(true);
    }
}
