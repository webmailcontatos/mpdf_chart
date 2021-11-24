<?php

namespace ChartPdf\Charts;
/**
 * Axis class
 */
class Axis
{
    /**
     * Axis text
     * @var string
     */
    protected string $text;

    /**
     * Rgb color
     * @var array
     */
    protected array $color;

    /**
     * Return text axis
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set text attr
     * @param string $text Text attribute
     * @return Axis
     */
    public function setText(string $text): Axis
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Return array color
     * @return array
     */
    public function getColor(): array
    {
        return $this->color;
    }

    /**
     * Set color
     * @param array $color Color rgb
     * @return Axis
     */
    public function setColor(array $color): Axis
    {
        $this->color = $color;
        return $this;
    }

}
