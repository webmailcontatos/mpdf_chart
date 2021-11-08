<?php

namespace App\Charts\Pie;

use App\Charts\ChartPdf;

/**
 * Pie chart class
 */
class Pie
{
    /**
     * Pdf lib
     * @var ChartPdf
     */
    protected ChartPdf $pdf;

    /**
     * Constructor class
     * @param ChartPdf $pdf Pdf lib
     */
    public function __construct(ChartPdf $pdf)
    {
        $this->pdf = $pdf;
    }
}
