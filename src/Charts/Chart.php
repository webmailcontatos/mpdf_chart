<?php

namespace App\Charts;

use Mpdf\Output\Destination;

/**
 * Chart class
 */
abstract class Chart
{
    /**
     * Mpdf class
     * @var PdfChart
     */
    protected PdfChart $pdf;
    /**
     * Width chart
     * @var float
     */
    protected float $width;
    /**
     * Height chart
     * @var float
     */
    protected float $height;
    /**
     * X position
     * @var float
     */
    protected float $x;

    /**
     * Y position
     * @var float
     */
    protected float $y;

    /**
     * Constructor class
     * @param PdfChart $pdf Lib pdf
     */
    public function __construct(PdfChart $pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Return width chart
     * @return float
     */
    protected function getWidth(): float
    {
        return $this->width;
    }

    /**
     * Set width chart
     * @param float $width
     * @return Chart
     */
    public function setWidth(float $width): Chart
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Return Chart height
     * @return float
     */
    protected function getHeight(): float
    {
        return $this->height;
    }

    /**
     * Seta height chart
     * @param float $height
     * @return Chart
     */
    public function setHeight(float $height): Chart
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Save pdf chart
     * @param string|null $fileName  File name pdf
     * @param string      $destinate Destinate File, inline and string
     * @return string|null
     * @throws \Mpdf\MpdfException
     */
    public function save(string $fileName = null, string $destinate = Destination::FILE): ?string
    {
        $x = $this->getX();
        $y = $this->getY();
        $this->pdf->AddPage();
        $this->pdf->SetXY($x, $y);
        $this->load();
        return $this->pdf->Output($fileName, $destinate);
    }

    /**
     * Return x0
     * @return float
     */
    protected function getX(): float
    {
        return $this->x;
    }

    /**
     * Seta x0
     * @param float $x X 0
     * @return Chart
     */
    public function setX(float $x): Chart
    {
        $this->x = $x;
        return $this;
    }

    /**
     * Return y0
     * @return float
     */
    protected function getY(): float
    {
        return $this->y;
    }

    /**
     * Set y0
     * @param float $y Y0
     * @return Chart
     */
    public function setY(float $y): Chart
    {
        $this->y = $y;
        return $this;
    }

    /**
     * Write chart
     * @return void
     */
    protected abstract function load();

    /**
     * Write chart on the pdf
     * @return void
     */
    public function write(): void
    {
        $x = $this->getX();
        $y = $this->getY();
        $this->pdf->SetXY($x, $y);
        $this->load();
    }

    /**
     * Seta fill colorz
     * @param array $color Rgb array color
     * @return void
     */
    protected function setFillColor(array $color): void
    {
        if (empty($color)) {
            return;
        }
        $this->pdf->SetFillColor($color[0], $color[1], $color[2]);
    }

    /**
     * Seta draw color
     * @param array $color Rgb array color
     * @return void
     */
    protected function setDrawColor(array $color): void
    {
        if (empty($color)) {
            return;
        }
        $this->pdf->SetDrawColor($color[0], $color[1], $color[2]);
    }
}
