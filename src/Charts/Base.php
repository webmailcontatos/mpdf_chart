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
     * @var Axis[]
     */
    protected array $axisX = [];
    /**
     * Axis y
     * @var Axis[]
     */
    protected array $axisY = [];

    /**
     * Line width
     * @var float|integer
     */
    protected float $lineWidth = 1;

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
     * Show line axis x
     * @var boolean
     */
    protected bool $showLineAxisX = true;
    /**
     * Flag show ticksy
     * @var boolean
     */
    protected bool $showTicksY = true;

    /**
     * Flag show axis y
     * @var boolean
     */
    protected bool $showAxisY = true;

    /**
     * Show line axis x
     * @var boolean
     */
    protected bool $showLineAxisY = true;
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
     * Format print axis y
     * @var \Closure
     */
    protected \Closure $formatY;

    /**
     * Format print axis x
     * @var \Closure
     */
    protected \Closure $formatX;

    /**
     * Back ground color gradient
     * @var array|int[]
     */
    protected array $backgroundColor = [54, 170, 255];
    /**
     * Flag background color
     * @var boolean
     */
    protected bool $drawBackGroundColor = false;

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
     * Set format y
     * @param \Closure $format Function format axis y
     * @return void
     */
    public function setFormatY(\Closure $format): void
    {
        $this->formatY = $format;
    }

    /**
     * Set format x
     * @param \Closure $format Function format axis x
     * @return void
     */
    public function setFormatX(\Closure $format): void
    {
        $this->formatX = $format;
    }

    /**
     * Set flag show line x axis
     * @param boolean $showLineAxisX Flag show line axis x
     * @return Base
     */
    public function setShowLineAxisX(bool $showLineAxisX): Base
    {
        $this->showLineAxisX = $showLineAxisX;
        return $this;
    }

    /**
     * Set flag show ticks y
     * @param boolean $showTicksY Show tick y flag
     * @return void
     */
    public function setShowTicksY(bool $showTicksY): void
    {
        $this->showTicksY = $showTicksY;
    }

    /**
     * Set flag show ticks y
     * @param boolean $showAxisY Show tick y flag
     * @return void
     */
    public function setShowAxisY(bool $showAxisY): void
    {
        $this->showAxisY = $showAxisY;
    }

    /**
     * Set flag show line y axis
     * @param boolean $showLineAxisY Flag show line axis y
     * @return Base
     */
    public function setShowLineAxisY(bool $showLineAxisY): Base
    {
        $this->showLineAxisY = $showLineAxisY;
        return $this;
    }

    /**
     * Set background color flag
     * @param boolean $background Background flag
     * @return void
     */
    public function setBackgroundColor(bool $background): void
    {
        $this->drawBackGroundColor = $background;
    }

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        $this->formatY = empty($this->formatY) ? fn(int $key, Axis $y) => $y : $this->formatY;
        $this->formatX = empty($this->formatX) ? fn(int $key, Axis $x) => $x : $this->formatX;
        $this->setDefaultScales();
        $this->setLineWidthChart();
        $this->setLineAxisY();
        $this->setLineAxisX();
        $this->setAxisXchart();
        $this->setAxisYchart();
        $this->drawBackground();
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
     * @return Axis[]
     */
    public function getAxisX(): array
    {
        return $this->axisX;
    }

    /**
     * Set axis x
     * @param Axis[] $axisX Axis x list
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
     * @return Axis[]
     */
    public function getAxisY(): array
    {
        return $this->axisY;
    }

    /**
     * Set attribute y list
     * @param Axis[] $axisY List axis y
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
        $this->pdf->setLineWidth($lineWidth);
        $this->pdf->setLineCap(0);
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
        if ($this->showLineAxisY === false) {
            return;
        }
        $xInit = $this->getX();
        $yInit = $this->getY();
        $height = $this->getHeight();
        $axis = $this->getAxisY();
        $space = ($height / count($axis));
        $this->pdf->line($xInit, $yInit, $xInit, ($yInit - ($height - $space)));
    }

    /**
     * Set line horizontal x
     * @return void
     */
    protected function setLineAxisX(): void
    {
        if ($this->showLineAxisX === false) {
            return;
        }
        $isLinear = $this->isLinearScale($this->scaleX);
        $xInit = $this->getX();
        $yInit = $this->getInitPointY();
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
     * Return init point y axis
     * @return float
     */
    protected function getInitPointY(): float
    {
        $axisY = $this->getAxisY();
        foreach ($axisY as $axis) {
            if ($axis->getText() < 0) {
                return $this->getYPosition(0);//Negative case
            }
        }
        return $this->getYPosition($axisY[0]->getText());
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
        foreach ($axis as $key => $axi) {
            $this->formatX->call($this, $key, $axi);
            $this->setTextAxisDecorator($axi);
            $this->pdf->setY(($yInit + $this->marginTopAxisX));
            $this->pdf->setX($xInit);
            $this->pdf->cell($space, 0, $axi->getText(), '0', 0, 'C');
            $this->setTickAxisX($xInit + $halfSpace);
            $xInit += $space;
        }
    }

    /**
     * Set font config
     * @param Axis $axis Axis config
     * @return void
     */
    protected function setTextAxisDecorator(Axis $axis): void
    {
        $color = $axis->getColor();
        $this->pdf->setTextColor($color[0], $color[1], $color[2]);
        $this->pdf->setFont($axis->getFontFamily(), $axis->getFontStyle(), $axis->getFontSize());
    }

    /**
     * Set tick on axis x
     * @return void
     */
    protected function setTickAxisX(float $xInit): void
    {
        if ($this->showTicksX === false) {
            return;
        }
        $axisY = $this->getAxisY();
        $yInit = $this->getYPosition($axisY[0]->getText());
        $this->pdf->Line($xInit, $yInit, $xInit, ($yInit + $this->tickSize));
    }

    /**
     * Set axis y chart
     * @return void
     */
    protected function setAxisYchart(): void
    {
        $tickSize = $this->showTicksY ? $this->tickSize : 1;
        $axis = $this->getAxisY();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $space = $this->getSpaceAxisY();
        $xInitLine = $this->getX() - $tickSize;
        $heightCell = $space;
        $widthCell = $this->getMaxStringWidthY();
        $xInit -= ($widthCell + ($tickSize * 1.5));
        foreach ($axis as $key => $axi) {
            $this->formatY->call($this, $key, $axi);
            $this->setTextAxisDecorator($axi);
            $this->pdf->setY($yInit - ($heightCell / 2));
            $this->pdf->setX($xInit);
            $this->pdf->cell($widthCell, $space, $axi->getText(), '0', 0, 'C');
            $this->setTickAxisY($xInitLine, $yInit);
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
        foreach ($axis as $key => $axi) {
            $axi = clone $axi;
            $this->formatY->call($this, $key, $axi);
            $this->setTextAxisDecorator($axi);
            $sizes[] = $this->pdf->getStringWidth($axi->getText());
        }
        return max($sizes);
    }

    /**
     * Set tick axis y
     * @param float $xInit X init
     * @param float $yInit Y init
     * @return void
     */
    protected function setTickAxisY(float $xInit, float $yInit): void
    {
        if ($this->showTicksY === false) {
            return;
        }
        $this->pdf->Line($xInit, $yInit, ($xInit + $this->tickSize), $yInit);
    }

    /**
     * Draw a background gradient
     * @return void
     */
    protected function drawBackground(): void
    {
        if ($this->drawBackGroundColor === false) {
            return;
        }
        $space = $this->getSpaceAxisY();
        $axis = array_map(fn(Axis $axis) => $axis->getValue(), $this->getAxisY());
        $qtdRect = (count($axis) - 1);
        $color = $this->backgroundColor;
        $xInit = $this->getX();
        $w = $this->getWidth();
        $this->pdf->SetFillColor($color[0], $color[1], $color[2]);
        $alpha = 1;
        $decrement = $alpha / $qtdRect;
        for ($i = 0; $i < count($axis); $i++) {
            $y = $this->getYPosition($axis[$i]);
            $this->pdf->SetAlpha($alpha);
            $this->pdf->Rect($xInit, ($y - $space), $w, $space, 'F');
            $alpha -= $decrement;
        }
        $this->pdf->SetAlpha(1);
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
            $yInit = $this->getYPosition($axi->getValue());
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
            $xInit = $this->getXPosition($axi->getValue()) + $halfSpace;
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
     * Return min x position
     * @return float
     */
    protected function getMinX(): float
    {
        $axis = $this->getAxisX();
        $max = reset($axis);
        return $this->getXPosition($max->getValue());
    }
}
