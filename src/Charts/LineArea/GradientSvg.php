<?php

namespace ChartPdf\Charts\LineArea;

use ChartPdf\Charts\Twig;

/**
 * Gradient class svg
 */
class GradientSvg
{
    /**
     * X1
     * @var float
     */
    protected float $x1;

    /**
     * X2
     * @var float
     */
    protected float $x2;

    /**
     * Y1
     * @var float
     */
    protected float $y1;

    /**
     * Y2
     * @var float
     */
    protected float $y2;

    /**
     * @var Stop[]
     */
    protected array $stops;

    /**
     * @return float
     */
    public function getX1(): float
    {
        return $this->x1;
    }

    /**
     * @param float $x1
     * @return GradientSvg
     */
    public function setX1(float $x1): GradientSvg
    {
        $this->x1 = $x1;
        return $this;
    }

    /**
     * @return float
     */
    public function getX2(): float
    {
        return $this->x2;
    }

    /**
     * @param float $x2
     * @return GradientSvg
     */
    public function setX2(float $x2): GradientSvg
    {
        $this->x2 = $x2;
        return $this;
    }

    /**
     * @return float
     */
    public function getY1(): float
    {
        return $this->y1;
    }

    /**
     * @param float $y1
     * @return GradientSvg
     */
    public function setY1(float $y1): GradientSvg
    {
        $this->y1 = $y1;
        return $this;
    }

    /**
     * @return float
     */
    public function getY2(): float
    {
        return $this->y2;
    }

    /**
     * @param float $y2
     * @return GradientSvg
     */
    public function setY2(float $y2): GradientSvg
    {
        $this->y2 = $y2;
        return $this;
    }

    /**
     * @return Stop[]
     */
    public function getStops(): array
    {
        return $this->stops;
    }

    /**
     * @param Stop[] $stops
     * @return GradientSvg
     */
    public function setStops(array $stops): GradientSvg
    {
        $this->stops = $stops;
        return $this;
    }

    /**
     * Return gradient
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __toString(): string
    {
        return Twig::render(
            'gradient.html.twig',
            [
                'gradient' => $this
            ]
        );
    }
}
