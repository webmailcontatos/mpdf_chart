<?php

namespace App\Charts\LineArea;

use App\Charts\Line\DataLine;
use App\Charts\Twig;

/**
 * Line area
 */
class LineAreaSvg extends LineArea
{
    /**
     * Set simple line chart
     * @return void
     */
    protected function simpleLineSegment(): void
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
            $svg = $this->getTemplateSvg($svgPoints);
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
    protected function getTemplateSvg(string $points): string
    {
        $converter = $this->getConverter();
        $widthLabelX = $converter->mmToPx($this->getWidthAxisLabel());
        $pointsSepare = explode(' ', trim($points));
        $firstPoint = (float) explode(',', $pointsSepare[0])[0];
        $lastPoint = (float) explode(',', end($pointsSepare))[1];
        $spaceY = $this->getSpaceAxisY();
        $height = $converter->mmToPx($this->getHeight() - $spaceY);
        $width = $converter->mmToPx($this->getWidth());
        $defaultWidth = $firstPoint - ($widthLabelX / 2);
        $defaultHeight = $lastPoint - $height;
        return Twig::render(
            'svg.html.twig',
            [
                'width'         => $width,
                'height'        => $height,
                'defaultHeight' => $defaultHeight,
                'defaultWidth'  => $defaultWidth,
                'opacity'       => 0.8,
                'points'        => $points,
            ]
        );
    }
}
