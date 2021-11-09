<?php

namespace App\Charts\Line;

use App\Charts\Scale;

/**
 * Line chart class
 */
class Line extends Scale
{
    /**
     * Lines chart
     * @var DataLine[]
     */
    protected array $lines = [];

    /**
     * @return array
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * Set attribute lines
     * @param DataLine[] $lines Line data
     * @return Line
     */
    public function setLines(array $lines): Line
    {
        $this->lines = $lines;
        return $this;
    }

    /**
     * Write chart on the pdf
     */
    protected function load(): void
    {
        parent::load();
    }

}
