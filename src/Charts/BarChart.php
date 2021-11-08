<?php

namespace App\Charts;

use App\Entity\DataBarChart;

/**
 * Bar chart class
 */
class BarChart extends Chart
{
    /**
     * Space between vertical y line and first x label
     * @var float|int
     */
    protected float $marginBarZeroPointX = 5;
    /**
     * Space between labels x and horizontal line x
     * @var float|int
     */
    protected float $marginBarZeroPointY = 2;
    /**
     * Space between labels y and vertical line y
     * @var float|int
     */
    protected float $marginBarYPoint = 9;

    /**
     * Line width
     * @var float
     */
    protected float $lineWidth = 0.200025;

    /**
     * Grid horizontal
     * @var boolean
     */
    protected bool $gridHori = false;

    /**
     * Alphar bar
     * @var boolean
     */
    protected bool $alphaBar = false;

    /**
     * Border bar
     * @var boolean
     */
    protected bool $borderBar = false;

    /**
     * x postions
     * @var array
     */
    protected array $xPosition = [];

    /**
     * Y position
     * @var array
     */
    protected array $yPosition = [];
    /**
     * Axis x
     * @var array
     */
    protected array $axisX;

    /**
     * Axis y
     * @var array
     */
    protected array $axisY;

    /**
     * Lista data bar chart
     * @var DataBarChart[]
     */
    protected array $data;

    /**
     * Set grid atributes value
     * @param boolean $grid If true set horizontal lines
     */
    public function gridHorizontal(bool $grid = true): void
    {
        $this->gridHori = $grid;
    }

    /**
     * Load chart elements
     * @return void
     */
    protected function load(): void
    {
        $this->pdf->SetLineWidth($this->getLineWidth());
        $this->setLineAxisY();
        $this->setLineAxisX();
        $this->setAxisXchart();
        $this->setAxisYchart();
        $this->setGridHorizontal();
        $this->setBar();
    }

    /**
     * Return line width attribute
     * @return float
     */
    public function getLineWidth(): float
    {
        return $this->lineWidth;
    }

    /**
     * Set line width attribute
     * @param float $lineWidth Line width
     * @return BarChart
     */
    public function setLineWidth(float $lineWidth): BarChart
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
     * Return axis y
     * @return array
     */
    public function getAxisY(): array
    {
        return $this->axisY;
    }

    /**
     * Set axis y
     * @param array $axisY Axis y
     * @return BarChart
     */
    public function setAxisY(array $axisY): BarChart
    {
        $this->axisY = $axisY;
        return $this;
    }

    /**
     * Set line horizontal x
     * @return void
     */
    protected function setLineAxisX(): void
    {
        $xInit = $this->getX();
        $yInit = $this->getY();
        $width = $this->getWidth();
        $this->pdf->Line($xInit, $yInit, ($xInit + $width), $yInit);
    }

    /**
     * Set axis chart
     * @return void
     */
    protected function setAxisXchart(): void
    {
        $axis = $this->getAxisX();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $space = $this->getWidthLabelX();
        $xInit += $this->marginBarZeroPointX;
        $yInit += $this->marginBarZeroPointY;
        foreach ($axis as $axi) {
            $this->xPosition[$axi] = $xInit;
            $this->pdf->SetXY($xInit, $yInit);
            $this->pdf->Cell($space, 4, $axi, '0', 0, 'C');
            $xInit += $space;
        }
    }

    /**
     * Return axis x
     * @return array
     */
    public function getAxisX(): array
    {
        return $this->axisX;
    }

    /**
     * Set axis x
     * @param array $axisX Axis x
     * @return BarChart
     */
    public function setAxisX(array $axisX): BarChart
    {
        $this->axisX = $axisX;
        return $this;
    }

    /**
     * Return width cell label x
     * @return float
     */
    protected function getWidthLabelX(): float
    {
        return $this->getXInitChart() * 2;
    }

    /**
     * Retorn xinit chart position
     * @return float
     */
    protected function getXInitChart(): float
    {
        $axis = $this->getAxisX();
        $width = ($this->getWidth() - $this->marginBarZeroPointX);
        return ($width / (count($axis))) / 2;
    }

    /**
     * Set axis y chart
     * @return void
     */
    protected function setAxisYchart(): void
    {
        $axis = $this->getAxisY();
        $xInit = $this->getX();
        $yInit = $this->getY();
        $height = $this->getHeight();
        $space = ($height / count($axis));
        $xInit -= $this->marginBarYPoint;
        $xInitLine = $this->getX() - 2;
        $heightCell = $space;
        $widthCell = 6;
        foreach ($axis as $axi) {
            $this->yPosition[$axi] = $yInit;
            $this->pdf->SetXY($xInit, $yInit - ($heightCell / 2));
            $this->pdf->Cell($widthCell, $space, $axi, '0', 0, 'C');
            $this->pdf->Line($xInitLine, $yInit, ($xInitLine + 2), $yInit);
            $yInit -= $space;
        }
    }

    /**
     * Set horizontal lines on the chart
     * @return void
     */
    protected function setGridHorizontal(): void
    {
        if ($this->gridHori === false) {
            return;
        }
        $axis = $this->getAxisY();
        $xInit = $this->getX();
        $width = $this->getWidth();
        foreach ($axis as $axi) {
            $yInit = $this->getYPosition($axi);
            $this->pdf->Line($xInit, $yInit, ($xInit + $width), $yInit);

        }
    }

    /**
     * Return position y
     * @param float $yPoint Y point
     * @return float
     */
    protected function getYPosition($yPoint): float
    {
        $y = $this->getY();
        $height = $this->getHeight();
        $percent = ($height / 100);
        $space = $this->getDistanceBetweenY();
        $maxPoint = $this->getMaxY() + $space;
        return $y - ((($yPoint / $maxPoint) * 100) * $percent);
    }

    /**
     * Return distance between axis y
     * @return float
     */
    protected function getDistanceBetweenY(): float
    {
        $axis = $this->getAxisY();
        return $axis[1] - $axis[0];
    }

    /**
     * Return max value y
     * @return float
     */
    protected function getMaxY(): float
    {
        $axis = $this->getAxisY();
        return end($axis);
    }

    /**
     * Set bar on the chart
     * @return void
     */
    protected function setBar(): void
    {
        $yInit = $this->getY();
        $barWidth = $this->getWidthLabelX() * 0.7;
        $datas = $this->getData();
        $space = (($this->getXInitChart() * 2) - $barWidth) / 2;
        $isAlpha = $this->isAlphaBar();
        if ($isAlpha) {
            $this->pdf->SetAlpha(0.7);
        }
        $style = $this->isBorderBar() ? 'DF' : 'F';
        foreach ($datas as $data) {
            foreach ($data as $point) {
                $x = $this->getXPostion($point->getX());
                $y = $this->getYPosition($point->getY());
                $this->setFillColor($point->getColor());
                $this->setDrawColor($point->getColor());
                $this->pdf->Rect($x + $space, $y, $barWidth, ($yInit - $y), $style);
            }
        }
    }

    /**
     * Return data chart
     * @return DataBarChart[][]
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set data chart
     * @param DataBarChart[] $data Data chart
     * @return BarChart
     */
    public function setData(array $data): BarChart
    {
        $this->data[] = $data;
        return $this;
    }

    /**
     * Return true if alpha is seted
     * @return boolean
     */
    public function isAlphaBar(): bool
    {
        return $this->alphaBar;
    }

    /**
     * Set alpha bar flag
     * @param boolean $alphaBar Flag alpha bar
     * @return BarChart
     */
    public function setAlphaBar(bool $alphaBar): BarChart
    {
        $this->alphaBar = $alphaBar;
        return $this;
    }

    /**
     * Return true if border bar is seted
     * @return boolean
     */
    public function isBorderBar(): bool
    {
        return $this->borderBar;
    }

    /**
     * Set border bar flag
     * @param boolean $borderBar Border bar flag
     * @return BarChart
     */
    public function setBorderBar(bool $borderBar): BarChart
    {
        $this->borderBar = $borderBar;
        return $this;
    }

    /**
     * Return x position
     * @param string $position Postion
     * @return float
     */
    protected function getXPostion(string $position): float
    {
        return $this->xPosition[$position];
    }

    /**
     * Return last postion x
     * @return float
     */
    protected function getLastPositionX(): float
    {
        $axis = $this->getAxisX();
        $last = end($axis);
        return $this->xPosition[$last];
    }

    /**
     * Return first postion y
     * @return float
     */
    protected function getFirstPositionY(): float
    {
        $axis = $this->getAxisY();
        $first = array_values($axis)[0];
        return $this->getYPosition($first);
    }

    /**
     * Return last postion y
     * @return float
     */
    protected function getLastPositionY(): float
    {
        $axis = $this->getAxisY();
        $last = end($axis);
        return $this->getYPosition($last);
    }

    /**
     * Return last postion x
     * @return float
     */
    protected function getFirstPositionX(): float
    {
        $axis = $this->getAxisX();
        $first = array_values($axis)[0];
        return $this->xPosition[$first];
    }

    /**
     * Get space y
     * @return float
     */
    protected function getSpaceY(): float
    {
        $axis = $this->getAxisY();
        return $this->getYPosition($axis[1]) - $this->getYPosition($axis[0]);
    }
}
