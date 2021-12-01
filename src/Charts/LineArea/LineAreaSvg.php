<?php

namespace ChartPdf\Charts\LineArea;

use ChartPdf\Charts\Line\DataLine;
use ChartPdf\Charts\Twig;

/**
 * Line area
 */
class LineAreaSvg extends LineArea
{
    /**
     * Gradient svg
     * @var GradientSvg
     */
    protected ?GradientSvg $gradientSvg = null;

    /**
     * Set simple line chart
     * @param DataLine[] $lines Line
     * @return void
     */
    protected function simpleLineSegment(array $lines): void
    {
        $this->setSvgPolygon();
        return;
    }

    /**
     * Set svg polygon
     * @return void
     */
    protected function setSvgPolygon(): void
    {
        $xInit = $this->getX();
        $yInit = $this->getY();
        $width = $this->getWidth();
        $height = $this->getHeight();
        $spaceY = $this->getSpaceAxisY();
        $height -= $spaceY;
        $lines = $this->getLines();
        foreach ($lines as $line) {
            $svgPoints = $this->getFullPointsSvg($line);
            $svg = $this->getTemplateSvg($svgPoints, $line);
            $this->pdf->WriteFixedPosHTML($svg, $xInit, ($yInit - $height), $width, $height, 'hidden');
        }
    }

    /**
     * Full points polygon convert to svg
     * @param DataLine $line Line data
     * @return string
     */
    protected function getFullPointsSvg(DataLine $line): string
    {
        $return = null;
        $points = array_chunk($this->getFullPoints($line), 2);
        $converter = $this->getConverter();
        foreach ($points as $point) {
            $x = $converter->mmToPx($point[0]);
            $y = $converter->mmToPx($point[1]);
            $return .= $x . ',' . $y . ' ';
        }
        return $return;
    }

    /**
     * Return template svg
     * @param string $points Points polygon
     * @return string
     */
    protected function getTemplateSvg(string $points, DataLine $line): string
    {
        $isLinear = $this->isLinearScale($this->scaleX);
        $converter = $this->getConverter();
        $xMin = $this->getDataMinX($line);
        $xInit = $this->getMinX();
        $widthLabelX = $isLinear ? $converter->mmToPx($xMin - $xInit) : ($converter->mmToPx($this->getWidthAxisLabel()) / 2);
        $pointsSepare = explode(' ', trim($points));
        $firstPoint = (float) explode(',', $pointsSepare[0])[0];
        $lastPoint = (float) explode(',', end($pointsSepare))[1];
        $spaceY = $this->getSpaceAxisY();
        $height = $converter->mmToPx($this->getHeight() - $spaceY);
        $width = $converter->mmToPx($this->getWidth());
        $defaultWidth = $firstPoint - $widthLabelX;
        $defaultHeight = $lastPoint - $height;
        $gradient = (string) $this->getGradientSvg();
        return Twig::render(
            'svg.html.twig',
            [
                'width'         => $width,
                'height'        => $height,
                'defaultHeight' => $defaultHeight,
                'defaultWidth'  => $defaultWidth,
                'opacity'       => $this->alpha,
                'points'        => $points,
                'gradient'      => $gradient,
            ]
        );
    }

    /**
     * Return gradient
     * @return GradientSvg
     */
    public function getGradientSvg(): ?GradientSvg
    {
        return $this->gradientSvg;
    }

    /**
     * Set gradient svg
     * @param GradientSvg $gradientSvg Gradient
     * @return LineAreaSvg
     */
    public function setGradientSvg(GradientSvg $gradientSvg): LineAreaSvg
    {
        $this->gradientSvg = $gradientSvg;
        return $this;
    }

}
