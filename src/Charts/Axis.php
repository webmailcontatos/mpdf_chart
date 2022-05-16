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
     * Valor
     * @var string
     */
    protected string $value;

    /**
     * Rgb color
     * @var array
     */
    protected array $color;

    /**
     * Font size in point
     * @var float
     */
    protected float $fontSize;

    /**
     * Font family
     * @var string
     */
    protected string $fontFamily;

    /**
     * Font style
     * @var string
     */
    protected string $fontStyle;

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

    /**
     * Return font size in pt
     * @return float
     */
    public function getFontSize(): float
    {
        return $this->fontSize;
    }

    /**
     * Set font size
     * @param float $fontSize Font size in pt
     * @return Axis
     */
    public function setFont(string $family, float $fontSize, string $style = '')
    {
        $this->fontSize = $fontSize;
        $this->fontFamily = $family;
        $this->fontStyle = $style;
        return $this;
    }

    /**
     * Return font style
     * @return string
     */
    public function getFontStyle(): string
    {
        return $this->fontStyle;
    }

    /**
     * Return font family
     * @return string
     */
    public function getFontFamily(): string
    {
        return $this->fontFamily;
    }

    /**
     * Valor
     * @param string $value
     * @return void
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
