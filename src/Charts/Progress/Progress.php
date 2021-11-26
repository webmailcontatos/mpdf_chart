<?php

namespace ChartPdf\Charts\Progress;

use ChartPdf\Charts\Chart;

/**
 * Progress class
 */
class Progress extends Chart
{
    /**
     * Width progress
     * @var float
     */
    protected float $width;
    protected float $radius          = 10;
    protected float $lineWidth       = 0.1;
    protected float $percent         = 0;
    protected array $backgroundColor = [245, 245, 245];
    protected array $progressColor   = [180, 248, 200];

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        $width = $this->getWidth();
        $defaultRadius = $this->getRadius();
        $defaultHeight = 2 * ($defaultRadius);
        $defaultColor = $this->getBackgroundColor();
        $lineWidth = $this->getLineWidth();
        $progressColor = $this->getProgressColor();
        $percentProgress = ($this->getPercent() / 100);
        $style = ['width' => $lineWidth];
        $this->pdf->SetFillColor($defaultColor[0], $defaultColor[1], $defaultColor[2]);
        $this->setRect($width, $defaultHeight, $defaultRadius, $style);
        $this->pdf->SetFillColor($progressColor[0], $progressColor[1], $progressColor[2]);
        $this->setFillProgress($percentProgress, $defaultRadius);
    }

    /**
     * Return width
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * Set attribute width
     * @param float $width Width progress
     * @return Progress
     */
    public function setWidth(float $width): Progress
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return float|int
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @param float|int $radius
     * @return Progress
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * @return array|int[]
     */
    public function getBackgroundColor(): array
    {
        return $this->backgroundColor;
    }

    /**
     * @param array|int[] $backgroundColor
     * @return Progress
     */
    public function setBackgroundColor(array $backgroundColor): Progress
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * @return float
     */
    public function getLineWidth(): float
    {
        return $this->lineWidth;
    }

    /**
     * @param float $lineWidth
     * @return Progress
     */
    public function setLineWidth(float $lineWidth): Progress
    {
        $this->lineWidth = $lineWidth;
        return $this;
    }

    /**
     * @return array|int[]
     */
    public function getProgressColor(): array
    {
        return $this->progressColor;
    }

    /**
     * @param array|int[] $progressColor
     * @return Progress
     */
    public function setProgressColor(array $progressColor): Progress
    {
        $this->progressColor = $progressColor;
        return $this;
    }

    /**
     * @return float|int
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param float|int $percent
     * @return Progress
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
        return $this;
    }

    /**
     * Set rect
     * @param float $width  Width
     * @param float $height Height
     * @param float $radius Radius
     * @param array $style  Style
     */
    protected function setRect(float $width, float $height, float $radius, array $style = []): void
    {
        $x = $this->getX();
        $y = $this->getY();
        $this->chartPdf->RoundedRect($x, $y, $width, $height, $radius, '1111', 'F', $style);
    }

    /**
     * Set rect fill
     * @param float $percent Percent
     * @param float $radius  Radius
     * @return void
     */
    protected function setFillProgress(float $percent, float $radius): void
    {
        if (empty($percent)) {
            return;
        }
        $x = $this->getX() + $radius;
        $y = $this->getY() + $radius;
        $points = [];
        $angles = range(270, 90);
        foreach ($angles as $angle) {
            $points[] = $radius * cos(deg2rad($angle)) + $x;
            $points[] = $radius * sin(deg2rad($angle)) + $y;
        }
        $widthPercent = ($this->getWidth() - (2 * $radius)) * $percent;
        $points[] = $x + $widthPercent;
        $points[] = $y + $radius;

        $points[] = $x + $widthPercent;
        $points[] = $y - $radius;
        $this->chartPdf->Polygon($points, 'F');
        $this->chartPdf->Sector($x + $widthPercent, $y, $radius, 0, 180, 'F', true);
    }
}
