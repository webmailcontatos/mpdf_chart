<?php

namespace ChartPdf\Charts;

use Mpdf\SizeConverter as Size;
use Psr\Log\NullLogger;

/**
 * Size converter class
 */
class SizeConverter
{
    /**
     * Original converter
     * @var Size
     */
    protected \Mpdf\SizeConverter $sizeConverter;

    /**
     * Logger
     * @var NullLogger
     */
    protected NullLogger $logger;

    /**
     * Constructor class
     * @param ChartPdf $pdf
     */
    public function __construct(ChartPdf $pdf)
    {
        $this->logger = new NullLogger();
        $this->sizeConverter = new Size($pdf->dpi, $pdf->default_font_size, $pdf, $this->logger);
    }

    /**
     * Convert mm to px
     * @param float $mm Mm
     * @return float
     */
    public function mmToPx(float $mm): float
    {
        $onePx = $this->sizeConverter->convert('1px');
        return ($mm / $onePx);
    }
}
