<?php

namespace ChartPdf\Charts;

use ChartPdf\Charts\Line\DataLine;

/**
 * Scale chart class
 */
class Base extends Chart
{
    /**
     * Margin top axis x
     * @var float|integer
     */
    protected float $marginTopAxisX = 4;

    /**
     * Tick size axis y and x
     * @var float|integer
     */
    protected float $tickSize = 2;
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
     * Horizontal grid flag
     * @var boolean
     */
    protected bool $horizontalGrid = false;

    /**
     * Vertical grid flag
     * @var boolean
     */
    protected bool $verticalGrid = false;
    /**
     * Axis x
     * @var array
     */
    protected array $axisX = [];
    /**
     * Axis y
     * @var array
     */
    protected array $axisY = [];

    /**
     * Line width
     * @var float|integer
     */
    protected float $lineWidth = 1;

    /**
     * Record y position axis
     * @var array
     */
    protected array $yPosition = [];

    /**
     * Flag show ticksx
     * @var boolean
     */
    protected bool $showTicksX = true;

    /**
     * Flag show axis x
     * @var boolean
     */
    protected bool $showAxisX = true;

    /**
     * Scale x
     * @var ScaleLinear|null
     */
    protected ?ScaleLinear $scaleX = null;

    /**
     * Scale y
     * @var ScaleLinear|null
     */
    protected ?ScaleLinear $scaleY = null;

    /**
     * Return true if flag horizontalGrid printed
     * @return boolean
     */
    public function isHorizontalGrid(): bool
    {
        return $this->horizontalGrid;
    }

    /**
     * Set attribute flag horizontal grid
     * @param boolean $horizontalGrid Horizontal grid flag
     * @return Base
     */
    public function setHorizontalGrid(bool $horizontalGrid): Base
    {
        $this->horizontalGrid = $horizontalGrid;
        return $this;
    }

    /**
     * Return true if flag verticalGrid printed
     * @return boolean
     */
    public function isVerticalGrid(): bool
    {
        return $this->verticalGrid;
    }

    /**
     * Set attribute flag vertical grid
     * @param boolean $verticalGrid Flag vertical grid
     * @return Base
     */
    public function setVerticalGrid(bool $verticalGrid): Base
    {
        $this->verticalGrid = $verticalGrid;
        return $this;
    }

    /**
     * Return first point chart on x axis
     * @param DataLine $line Line chart
     * @return float
     */
    public function getFirstPointX(DataLine $line): float
    {
        $point = array_values($line->getPoints())[0];
        return $this->getXPosition($point->getX());
    }

    /**
     * Return position x
     * @param string $xPoint X point
     * @return float
     */
    protected function getXPosition($xPoint): float
    {
        return $this->scaleX->getPosition($xPoint);
    }

    /**
     * Set flag show ticks x
     * @param boolean $showTicksX Show tick x flag
     * @return void
     */
    public function setShowTicksX(bool $showTicksX): void
    {
        $this->showTicksX = $showTicksX;
    }

    /**
     * Set flag show ticks x
     * @param boolean $showAxisX Show tick x flag
     * @return void
     */
    public function setShowAxisX(bool $showAxisX): void
    {
        $this->showAxisX = $showAxisX;
    }

    /**
     * Set scale x
     * @param ScaleLinear $scale Scale linear
     * @return void
     */
    public function setScaleX(ScaleLinear $scale): void
    {
        $this->scaleX = $scale;
    }

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        $this->setDefaultScales();
        $this->setLineWidthChart();
        $this->setLineAxisY();
        $this->setLineAxisX();
        $this->setAxisXchart();
        $this->setAxisYchart();
        $this->setGridHorizontal();
        $this->setGridVertical();
    }

    /**
     * Set default scale x and y
     */
    protected function setDefaultScales(): void
    {
        if (empty($this->scaleX)) {
            $width = $this->getWidth();
            $x = $this->getX();
            $this->scaleX = new ScaleBand($this->getAxisX(), $width, $x);
        }
        if (empty($this->scaleY)) {
            $y = $this->getY();
            $height = -$this->getHeight();
            $this->scaleY = new ScaleLinear($this->getAxisY(), $height, $y);
        }
    }

    /**
     * Return width chart
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * Set width chart
     * @param float $width Width chart
     * @return Base
     */
    public function setWidth(float $width): Base
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Return axis x values
     * @return array
     */
    public function getAxisX(): array
    {
        return $this->axisX;
    }

    /**
     * Set axis x
     * @param array $axisX Axis x list
     * @return Base
     */
    public function setAxisX(array $axisX): Base
    {
        $this->axisX = $axisX;
        return $this;
    }

    /**
     * Return height chart
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * Set height chart
     * @param float $height Height chart
     * @return Base
     */
    public function setHeight(float $height): Base
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Return axis y list
     * @return array
     */
    public function getAxisY(): array
    {
        return $this->axisY;
    }

    /**
     * Set attribute y list
     * @param array $axisY List axis y
     * @return Base
     */
    public function setAxisY(array $axisY): Base
    {
        $this->axisY = $axisY;
        return $this;
    }

    /**
     * Set line width chart
     * @return void
     */
    protected function setLineWidthChart(): void
    {
        $lineWidth = $this->getLineWidth();
        $this->pdf->SetLineWidth($lineWidth);
        $this->pdf->SetLineCap(0);
    }

    /**
     * Return line width
     * @return float|integer
     */
    public function getLineWidth(): float
    {
        return $this->lineWidth;
    }

    /**
     * @param float|int $lineWidth
     * @return Base
     */
    public function setLineWidth($lineWidth)
    {
        $this->lineWidth = $lineWidth;
        return $this;
    }

    /**
     * Set vertical line y
     * @return void
     */
    protected function setLineAxisY(): void
    {
        $xInit = $this->getX();
        $yInit = $this->getY();
        $height = $this->getHeight();
        $axis = $this->getAxisY();
        $space = ($height / count($axis));
        $this->pdf->Line($xInit, $yInit, $xInit, ($yInit - ($height - $space)));
    }

    /**
     * Set line horizontal x
     * @return void
     */
    protected function setLineAxisX(): void
    {
        $isLinear = $this->isLinearScale($this->scaleX);
        $xInit = $this->getX();
        $yInit = $this->getYPosition(0);
        $width = $this->getWidth();
        $space = $this->getWidthAxisLabel();
        $widthLine = ($xInit + $width);
        if ($isLinear) {
            $widthLine -= $space;
        }
        $this->pdf->Line($xInit, $yInit, $widthLine, $yInit);
    }

    /**
     * Return true if scale is type scale linear
     * @param ScaleLinear $scale Current scale
     * @return boolean
     */
    protected function isLinearScale(ScaleLinear $scale): bool
    {
        return get_class($scale) === 'ChartPdf\Charts\ScaleLinear';
    }

    /**
     * Return position y
     * @param float $yPoint Y point
     * @return float
     */
    protected function getYPosition($yPoint): float
    {
        return $this->scaleY->getPosition($yPoint);
    }

    /**
     * Return width label axis x
     * @return float
     */
    protected function getWidthAxisLabel(): float
    {
        $axis = $this->getAxisX();
        $width = $this->getWidth();
        return ($width / count($axis));
    }

    /**
     * Set axis chart
     * @return void
     */
    protected function setAxisXchart(): void
    {
        if ($this->showAxisX === false) {
            return;
        }
        $axis = $this->getAxisX();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $space = $this->getWidthAxisLabel();
        $halfSpace = ($space / 2);
        $isLinear = $this->isLinearScale($this->scaleX);
        if ($isLinear === true) {
            $xInit -= $halfSpace;
        }
        foreach ($axis as $axi) {
            $this->pdf->SetXY($xInit, ($yInit + $this->marginTopAxisX));
            $this->pdf->Cell($space, 0, $axi, '0', 0, 'C');
            $this->setTickAxisX($xInit + $halfSpace);
            $xInit += $space;
        }
    }

    /**
     * Set tick on axis x
     * @return void
     */
    protected function setTickAxisX(float $xInit): void
    {
        $yInit = $this->getYPosition(0);
        $this->pdf->Line($xInit, $yInit, $xInit, ($yInit + $this->tickSize));
    }

    /**
     * Set axis y chart
     * @return void
     */
    protected function setAxisYchart(): void
    {
        $tickSize = $this->tickSize;
        $axis = $this->getAxisY();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $space = $this->getSpaceAxisY();
        $xInitLine = $this->getX() - $tickSize;
        $heightCell = $space;
        $widthCell = $this->getMaxStringWidthY();
        $xInit -= ($widthCell + ($tickSize * 1.5));
        foreach ($axis as $axi) {
            $this->yPosition[$axi] = $yInit;
            $this->pdf->SetXY($xInit, $yInit - ($heightCell / 2));
            $this->pdf->Cell($widthCell, $space, $axi, '0', 0, 'C');
            $this->pdf->Line($xInitLine, $yInit, ($xInitLine + 2), $yInit);
            $yInit -= $space;
        }
    }

    /**
     * Return space y axis
     * @return float
     */
    protected function getSpaceAxisY(): float
    {
        $axis = $this->getAxisY();
        $height = $this->getHeight();
        return ($height / count($axis));
    }

    /**
     * Return max width string axisY
     * @return float
     */
    protected function getMaxStringWidthY(): float
    {
        $sizes = [];
        $axis = $this->getAxisY();
        foreach ($axis as $axi) {
            $sizes[] = $this->pdf->GetStringWidth($axi);
        }
        return max($sizes);
    }

    /**
     * Set horizontal grid
     * @return void
     */
    protected function setGridHorizontal(): void
    {
        if ($this->horizontalGrid === false) {
            return;
        }
        $axis = $this->getAxisY();
        $xInit = $this->getX();
        $widthLine = $this->getLineWidthAxisX();
        foreach ($axis as $axi) {
            $yInit = $this->getYPosition($axi);
            $this->pdf->Line($xInit, $yInit, $widthLine, $yInit);

        }
    }

    /**
     * Return width line on axis x
     * @return float
     */
    protected function getLineWidthAxisX(): float
    {
        $isLinear = $this->isLinearScale($this->scaleX);
        $xInit = $this->getX();
        $width = $this->getWidth();
        $space = $this->getWidthAxisLabel();
        if ($isLinear === false) {
            $space = 0;
        }
        return ($xInit + $width) - $space;
    }

    /**
     * Set vertical grid
     * @return void
     */
    protected function setGridVertical(): void
    {
        if ($this->verticalGrid === false) {
            return;
        }
        $space = $this->getWidthAxisLabel();
        $axis = $this->getAxisX();
        $height = $this->getLineHeightAxisY();
        $yInit = $this->getY();
        $halfSpace = ($space / 2);
        $isLinear = $this->isLinearScale($this->scaleX);
        if ($isLinear) {
            $halfSpace = 0;
        }
        foreach ($axis as $axi) {
            $xInit = $this->getXPosition($axi) + $halfSpace;
            $this->pdf->Line($xInit, $yInit, $xInit, $height);
        }
    }

    /**
     * Return height line on axis y
     * @return float
     */
    protected function getLineHeightAxisY(): float
    {
        $yInit = $this->getY();
        $height = $this->getHeight();
        $space = $this->getSpaceAxisY();
        return ($yInit - $height) + $space;
    }

    /**
     * Return max x position
     * @return float
     */
    protected function getMaxX(): float
    {
        $axis = $this->getAxisX();
        $max = end($axis);
        return $this->getXPosition($max);
    }

    /**
     * Return min x position
     * @return float
     */
    protected function getMinX(): float
    {
        $axis = $this->getAxisX();
        $max = reset($axis);
        return $this->getXPosition($max);
    }
}
