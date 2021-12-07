<?php

namespace ChartPdf\Charts;

use Mpdf\Output\Destination;

interface Pdf
{
    /**
     * Set x position
     * @param float $x X position
     * @return void
     */
    public function setX(float $x): void;

    /**
     * Set y position
     * @param float $y Y position
     * @return void
     */
    public function setY(float $y): void;

    /**
     * Set line width
     * @param float $lineWidth Line width
     * @return void
     */
    public function setLineWidth(float $lineWidth): void;

    /**
     * Sets the line cap style for subsequently drawn lines.
     *
     *      LineCap    The line cap style to use:
     *      0 = Butt
     *      1 = Round
     *      2 = Projecting square cap
     * @param integer $mode
     */
    public function setLineCap(int $mode): void;

    /**
     * Write line on pdf
     * @param float $x1 X1
     * @param float $y1 Y1
     * @param float $x2 X2
     * @param float $y2 Y2
     * @return void
     */
    public function line(float $x1, float $y1, float $x2, float $y2): void;

    /**
     * RGB text color
     * @param float $r Red
     * @param float $g Green
     * @param float $b Blue
     */
    public function setTextColor(float $r, float $g, float $b): void;

    /**
     * Set font attribute
     * @param string        $family Font family
     * @param string        $style  Style text
     * @param float|integer $size   Size font
     */
    public function setFont(string $family, string $style = '', float $size = 0): void;

    /**
     * Cell on pdf
     * @param float         $w      Width
     * @param float|integer $h      Height
     * @param string        $txt    Text
     * @param integer       $border Border
     * @param string        $ln     Line
     * @param string        $align  Align
     * @param integer       $fill   Fill
     */
    public function cell(float $w, float $h = 0, string $txt = '', int $border = 0, string $ln = '', string $align = '', int $fill = 0): void;

    /**
     * Return width string
     * @param string $s Text
     * @return float
     */
    public function getStringWidth(string $s): float;

    /**
     * RGB fill color
     * @param float $r Red
     * @param float $g Green
     * @param float $b Blue
     */
    public function setFillColor(float $r, float $g, float $b): void;

    /**
     * RGB draw color
     * @param float $r Red
     * @param float $g Green
     * @param float $b Blue
     */
    public function setDrawColor(float $r, float $g, float $b): void;

    /**
     * Draw rect on pdf
     * @param float  $x     X init
     * @param float  $y     Y init
     * @param float  $w     Width
     * @param float  $h     Height
     * @param string $style Style F,D and DF or FD
     */
    public function rect(float $x, float $y, float $w, float $h, string $style = ''): void;

    /**
     * Out put pdf file or return string with content pdf
     * @param string $name File name
     * @param string $dest Destination
     * @return mixed
     */
    public function output(string $name = '', string $dest = Destination::FILE);

    /**
     * Set dashed line on pdf
     * @param boolean $black Black
     * @param boolean $white White
     */
    public function setDash(bool $black = false, bool $white = false): void;

    /**
     * Return current height
     * @return float
     */
    public function getCurrentHeightPage(): float;

    /**
     * Write in pdf
     * @param string $s Content
     */
    public function write(string $s): void;

    /**
     * Rotate
     * @param float         $angle Angle
     * @param float|integer $x     X init
     * @param float|integer $y     Y init
     */
    public function rotate(float $angle, float $x = -1, float $y = -1): void;

    /**
     * Set alpha
     * @param float $alpha Alpha 0.....1
     * @return void
     */
    public function setAlpha(float $alpha): void;

    /**
     * Write HTML to a fixed position on the current page.
     * @param string $html     This parameter specifies the text to write to the document - parsed as HTML code
     * @param float  $x        Sets the $x position of the (left edge) of the block element, set in mm from the left of the page.
     * @param float  $y        Sets the $y position of the (top edge) of the block element, set in mm from the top of the page.
     * @param float  $w        Sets the width of the block element, in mm.
     * @param float  $h        Sets the height of the block element, in mm.
     * @param string $overflow Specifies how to handle text which would not fit inside the block element, with its dimensions as specified.
     */
    public function writeFixedPosHtml(string $html, float $x, float $y, float $w, float $h, string $overflow = 'visible'): void;

    /**
     * Return current x position
     * @return float
     */
    public function getCurrentX(): float;

    /**
     * Return current position y
     * @return float
     */
    public function getCurrentY(): float;

    /**
     * Write arc on pdf
     * @param float $x1 X1
     * @param float $y1 Y1
     * @param float $x2 X2
     * @param float $y2 Y2
     * @param float $x3 X3
     * @param float $y3 y3
     */
    public function arc(float $x1, float $y1, float $x2, float $y2, float $x3, float $y3): void;

    /**
     * Return current lib pdf writer
     * @return mixed
     */
    public function getLibPdf();
}
