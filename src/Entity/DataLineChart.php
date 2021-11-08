<?php

namespace App\Entity;

/**
 * Data line chart
 */
class DataLineChart extends DataBarChart
{
    /**
     * Constant triangle
     */
    public const  TRIANGLE = 1;

    /**
     * Constant circle
     */
    public const  CIRCLE = 2;

    /**
     * Symbol
     * @var integer
     */
    protected int $typeSymbol = self::CIRCLE;

    /**
     * Set symbol
     * @param integer $type Type symbols
     * @return void
     */
    public function setSymbol(int $type): void
    {
        $this->typeSymbol = $type;
    }

    /**
     * Return current symbol
     * @return integer
     */
    public function getSymbol(): int
    {
        return $this->typeSymbol;
    }
}
