<?php

namespace App\Tests\Charts;

use Imagick;
use ImagickException;
use PHPUnit\Framework\TestCase;

class TestCaseChartPdf extends TestCase
{
    /**
     * Make compare
     * @param string  $expected Content expected
     * @param string  $result   Content result
     * @param boolean $showDiff If true create image with diff
     * @throws ImagickException|\ImagickException
     */
    protected function compararPdf(string $expected, string $result, bool $showDiff = false)
    {
        $assertedImagick = new Imagick();
        $assertedImagick->readImageBlob($expected);
        $assertedImagick->resetIterator();
        $assertedImagick = $assertedImagick->appendImages(true);

        $testImagick = new Imagick();
        $testImagick->readImageBlob($result);
        $testImagick->resetIterator();
        $testImagick = $testImagick->appendImages(true);

        $diff = $assertedImagick->compareImages($testImagick, 1);
        if ($showDiff) {
            $diff[0]->writeImages('diff.png', false);
        }
        $this->assertSame(0.0, $diff[1]);
    }
}
