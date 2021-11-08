<?php

namespace App\Charts;

use App\Entity\DataLineChart;

/**
 * Line chart class
 */
class LineChart extends BarChart
{
    /**
     * Simblos
     */
    use Symbols;

    /**
     * Fill lines
     * @var boolean
     */
    protected bool $fill = false;
    /**
     * Fill color rgb chart
     * @var array
     */
    protected array $fillColor = [];
    /**
     * Draw color rgb chart
     * @var array
     */
    protected array $drawColor = [];
    /**
     * If true gradient is printed
     * @var boolean
     */
    protected bool $gradient = false;

    /**
     * List lines
     * @var Line[]
     */
    protected array $lines = [];

    /**
     * Default color gradient
     * @var array|int[]
     */
    protected array $colorInitGradiente = [255, 0, 0];

    /**
     * Set fill color
     * @param array $fillColor
     * @return LineChart
     */
    public function setFillColorLine(array $fillColor): LineChart
    {
        $this->fillColor = $fillColor;
        return $this;
    }

    /**
     * Set line data
     * @param Line[] $lines Lines chart
     * @return void
     */
    public function setLinesData(array $lines): void
    {
        $this->lines = $lines;
    }

    /**
     * Load chart elements
     * @return void
     */
    protected function load(): void
    {
        $this->pdf->SetLineWidth($this->getLineWidth());
        $this->pdf->SetFillColor(0, 0, 0);
        $this->pdf->SetDrawColor(0, 0, 0);
        $this->setLineAxisY();
        $this->setLineAxisX();
        $this->setAxisXchart();
        $this->setAxisYchart();
        $this->setRectGradient();
        $this->setGridHorizontal();
        $this->setLines();
        $this->setPoints();
    }

    /**
     * Set gradient if isGradient return true
     * @return void
     */
    protected function setRectGradient(): void
    {
        $isGradient = $this->isGradient();
        if ($isGradient === false) {
            return;
        }
        $color = 0;
        $heightRect = 0.5;
        $lineWidth = $this->getLineWidth();
        $colorGradiente = $this->getColorInitGradiente();
        $spaceX = $this->getXInitChart();
        $xInit = $this->getFirstPositionX() + $spaceX + $lineWidth;
        $maxX = $this->getLastPositionX();
        $widthRect = ($maxX - $xInit) + $spaceX;
        $height = $this->getHeight() + $this->getSpaceY();
        $yInit = $this->getY() - $height;
        $rectNumber = 0;
        while ($height >= $heightRect) {
            if ($rectNumber) {//don't print de first
                $this->pdf->SetFillColor($colorGradiente[0], $color, $color);
                $this->pdf->SetDrawColor($colorGradiente[0], $color, $color);
                $this->pdf->Rect($xInit, $yInit, $widthRect - $lineWidth, $heightRect, 'FD');
            }
            $yInit += $heightRect;
            $height -= $heightRect;
            $color++;
            $rectNumber++;
            if ($color > 255) {
                $color = 0;
            }
        }
    }

    /**
     * Get value attribute gradient
     * @return bool
     */
    public function isGradient(): bool
    {
        return $this->gradient;
    }

    /**
     * Set attribute gradiente
     * @param bool $gradient
     * @return LineChart
     */
    public function setGradient(bool $gradient): LineChart
    {
        $this->gradient = $gradient;
        return $this;
    }

    /**
     * Return color gradient
     * @return array|int[]
     */
    public function getColorInitGradiente(): array
    {
        return $this->colorInitGradiente;
    }

    /**
     * Set attribute gradiente
     * @param array|int[] $colorInitGradiente Color gradient
     * @return LineChart
     */
    public function setColorInitGradiente(array $colorInitGradiente): LineChart
    {
        $this->colorInitGradiente = $colorInitGradiente;
        return $this;
    }

    /**
     * Set lines on chart
     * @return void
     */
    protected function setLines(): void
    {
        $lines = $this->mountLinesConection();
        $isFill = $this->isFill();
        if ($isFill) {
            $color = $this->getFillColor();
            $drawColor = $this->getDrawColorLine();
            $this->setFillColor($color);
            $this->setDrawColorLine($drawColor);
            $this->poligonLineSegment($lines);
            return;
        }
        $this->simpleLineSegment($lines);
    }

    /**
     * Return lines with conection points
     * @return array
     */
    protected function mountLinesConection(): array
    {
        $index = 0;
        $lines = [];
        $points = $this->getData();
        $space = $this->getXInitChart();
        foreach ($points as $key => $line) {
            $datas = $line->getPoints();
            while (count($datas) > 1) {
                $data = $datas[$index];
                $index++;
                $next = $datas[$index];
                $lines[$key][] = ($this->getXPostion($data->getX()) + $space);
                $lines[$key][] = $this->getYPosition($data->getY());
                $lines[$key][] = ($this->getXPostion($next->getX()) + $space);
                $lines[$key][] = $this->getYPosition($next->getY());
                unset($datas[$index - 1]);
                unset($datas[$index]);
                $index++;
            }
            $index = 0;
        }
        return $lines;
    }

    /**
     * Return lines
     * @return Line[]
     */
    public function getData(): array
    {
        return $this->lines;
    }

    /**
     * Get attribute fill
     * @return boolean
     */
    public function isFill(): bool
    {
        return $this->fill;
    }

    /**
     * Set attribute fill on the chart
     * @param boolean $fill If true chart is filled
     * @return LineChart
     */
    public function setFill(bool $fill): LineChart
    {
        $this->fill = $fill;
        return $this;
    }

    /**
     * Return fill color attribute
     * @return array
     */
    public function getFillColor(): array
    {
        return $this->fillColor;
    }

    /**
     * Return drawColor attribute
     * @return array
     */
    public function getDrawColorLine(): array
    {
        return $this->drawColor;
    }

    /**
     * Set draw color line
     * @param array $drawColor Draw color
     * @return LineChart
     */
    public function setDrawColorLine(array $drawColor): LineChart
    {
        $this->drawColor = $drawColor;
        return $this;
    }

    /**
     * Set lines like a poligon
     * @param array   $points  Lines points
     * @param boolean $inverse If true print lines in top-down
     * @return void
     */
    protected function poligonLineSegment(array $points, bool $inverse = false): void
    {
        foreach ($points as $lines) {
            $space = $this->getXInitChart();
            $lastX = $this->getLastPositionX();
            $first = $this->getFirstPositionX();
            $oriLines = $lines;
            $lineWidth = $this->getLineWidth();
            $isGradiente = $this->isGradient();
            $style = $isGradiente === false ? 'FD' : 'D';
            if ($inverse === false) {
                $lines[] = $lastX + $space;
                $lines[] = $this->getFirstPositionY() - $lineWidth;
                $lines[] = $first + $space;
                $lines[] = $this->getFirstPositionY() - $lineWidth;
                $this->pdf->Polygon($lines, $style);
            } else {
                $lines[] = $lastX + $space;
                $lines[] = $this->getLastPositionY();
                $lines[] = $first + $space;
                $lines[] = $this->getLastPositionY();
                $this->pdf->SetFillColor(255, 255, 255);
                $this->pdf->SetDrawColor(255, 255, 255);
                $this->pdf->Polygon($lines, 'FD');
            }
            if ($this->isGradient() && $inverse === false) {
                $this->poligonLineSegment([$oriLines], true);
            }
        }
    }

    /**
     * Set simple line chart
     * @param array $points Lines points
     * @return void
     */
    protected function simpleLineSegment(array $points): void
    {
        $linesObj = $this->getData();
        foreach ($points as $key => $lines) {
            $lineObj = $linesObj[$key];
            $color = $lineObj->getColor();
            $lines = array_chunk($lines, 4);
            $conectionX = 0;
            $conectionY = 0;
            foreach ($lines as $line) {
                $this->pdf->SetDrawColor($color[0], $color[1], $color[2]);
                if ($conectionX && $conectionY) {
                    $this->pdf->Line($conectionX, $conectionY, $line[0], $line[1]);
                }
                $this->pdf->Line($line[0], $line[1], $line[2], $line[3]);
                $conectionX = $line[2];
                $conectionY = $line[3];
            }
        }
    }

    /**
     * Set point in the chart
     * @return void
     */
    protected function setPoints(): void
    {
        $datas = $this->getData();
        $space = $this->getXInitChart();
        foreach ($datas as $data) {
            $setPoint = $data->showPoint();
            if ($setPoint === false) {
                continue;
            }
            $linePoint = $data->getPoints();
            $pointConfig = $data->getPoint();
            foreach ($linePoint as $points) {
                $x = $this->getXPostion($points->getX());
                $y = $this->getYPosition($points->getY());
                $color = $pointConfig->getFillColor();
                $drawColor = $pointConfig->getColor();
                $this->setFillColor($color);
                $this->setDrawColorLine($drawColor);
                $style = $color === [255, 255, 255] ? 'DF' : 'F';
                $this->setPoint(($x + $space), $y, $points->getSymbol(), $style);
            }
        }
    }

    /**
     * Set point
     * @param float   $x    X position
     * @param float   $y    Y position
     * @param integer $type Type symbols
     * @return void
     */
    protected function setPoint(float $x, float $y, int $type, string $style = 'F'): void
    {
        if ($type === DataLineChart::CIRCLE) {
            $this->setCirclePoint($x, $y, 1, $style);
            return;
        }
        if ($type === DataLineChart::TRIANGLE) {
            $this->setTriangle($x, $y);
            return;
        }
    }
}
