<?php

namespace ChartPdf\Charts\LineArea;

/**
 * Stop class gradient
 */
class Stop
{
    /**
     * Off set value
     * @var float
     */
    protected float $offset;

    /**
     * Style gradient
     * @var string
     */
    protected string $style;

    /**
     * @return float
     */
    public function getOffset(): float
    {
        return $this->offset;
    }

    /**
     * @param float $offset
     * @return Stop
     */
    public function setOffset(float $offset): Stop
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return string
     */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @param string $style
     * @return Stop
     */
    public function setStyle(string $style): Stop
    {
        $this->style = $style;
        return $this;
    }


}
