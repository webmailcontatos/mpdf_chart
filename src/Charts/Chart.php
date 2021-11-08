<?php

namespace App\Charts;
/**
 * Chart abstract class
 */
abstract class Chart
{
    /**
     * Write chart on the pdf
     * @return void
     */
    public function write(): void
    {
        $x = $this->getX();
        $y = $this->getY();
        $this->pdf->SetXY($x, $y);
        $this->load();
    }

    /**
     * Write chart on the pdf
     */
    protected abstract function load(): void;
}
