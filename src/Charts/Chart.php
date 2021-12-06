<?php

namespace ChartPdf\Charts;

use Mpdf\Mpdf;

/**
 * Chart abstract class
 */
abstract class Chart
{
    /**
     * Converter units
     * @var SizeConverter
     */
    protected SizeConverter $sizeConverter;

    /**
     * Pdf lib
     * @var Pdf
     */
    protected Pdf $pdf;
    /**
     * @var ChartPdf
     */
    protected ChartPdf $chartPdf;
    /**
     * X position on pdf
     * @var float
     */
    protected float $x;

    /**
     * Y position on pdf
     * @var float
     */
    protected float $y;

    /**
     * Constructor class
     * @param Pdf $pdf Pdf lib
     */
    public function __construct(Pdf $pdf)
    {
        $this->pdf = $pdf;
        $this->chartPdf = new ChartPdf($pdf);
    }

    /**
     * Write chart on the pdf
     * @return void
     */
    public function write(): void
    {
        $x = $this->getX();
        $y = $this->getY();
        $this->pdf->setX($x);
        $this->pdf->setY($y);
        $this->load();
    }

    /**
     * Return x position (center of de circle)
     * @return float
     */
    protected function getX(): float
    {
        return $this->x;
    }

    /**
     * Set x postion (center of de circle)
     * @param float $x x position
     * @return self
     */
    public function setX(float $x): self
    {
        $this->x = $x;
        return $this;
    }

    /**
     * Return y postion (center of circle)
     * @return float
     */
    protected function getY(): float
    {
        return $this->y;
    }

    /**
     * Set y position
     * @param float $y Y position
     * @return self
     */
    public function setY(float $y): self
    {
        $this->y = $y;
        return $this;
    }

    /**
     * Write chart on the pdf
     */
    protected abstract function load(): void;

    /**
     * Return converter
     * @return SizeConverter
     */
    protected function getConverter(): SizeConverter
    {
        $mpdf = new Mpdf();
        return new SizeConverter($mpdf);
    }
}
