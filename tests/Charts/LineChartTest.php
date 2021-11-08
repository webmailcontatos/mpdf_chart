<?php

use App\Charts\Line;
use App\Charts\LineChart;
use App\Charts\PdfChart;
use App\Charts\Point;
use App\Entity\DataBarChart;
use App\Entity\DataLineChart;
use Mpdf\Output\Destination;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class LineChartTest extends TestCase
{
    /**
     * Linechart sample test
     */
    public function testLineChart(): void
    {
        $data = $this->getDataChart();
        $dataChartPie = $this->mountDataChart($data);
        $result = $dataChartPie->save('lineChart.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/lineChart.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Retorna os dados do gráfico
     * @return array
     */
    protected function getDataChart(): array
    {
        return [
            'axis' => [
                'x' => [
                    'Jan',
                    'Fev',
                    'Mar',
                    'Abr',
                    'Mai',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Set',
                    'Out',
                ],
                'y' => [
                    0,
                    10,
                    20,
                    30,
                    40,
                    50,
                    60,
                    70,
                    80,
                    90,
                    100,
                ],
            ],
            'data' => [
                [
                    'x'     => 'Jan',
                    'y'     => 13,
                    'color' => [0, 0, 0]
                ], [
                    'x'     => 'Fev',
                    'y'     => 25,
                    'color' => [0, 0, 0]
                ], [
                    'x'     => 'Mar',
                    'y'     => 37,
                    'color' => [0, 0, 0]
                ], [
                    'x'     => 'Abr',
                    'y'     => 22,
                    'color' => [0, 0, 0]
                ], [
                    'x'     => 'Mai',
                    'y'     => 13,
                    'color' => [0, 0, 0]
                ], [
                    'x'     => 'Jun',
                    'y'     => 77,
                    'color' => [0, 0, 0]
                ],
                [
                    'x'     => 'Jul',
                    'y'     => 54,
                    'color' => [0, 0, 0]
                ],
                [
                    'x'     => 'Ago',
                    'y'     => 62,
                    'color' => [0, 0, 0]
                ],
                [
                    'x'     => 'Set',
                    'y'     => 47,
                    'color' => [0, 0, 0]
                ],
                [
                    'x'     => 'Out',
                    'y'     => 23,
                    'color' => [0, 0, 0]
                ],
            ]
        ];
    }

    /**
     * Return list data chart object
     * @param array $data Data chart list
     * @return LineChart
     */
    protected function mountDataChart(array $data): LineChart
    {
        $lineChart = new LineChart(new PdfChart());
        $lineChart->setAxisX($data['axis']['x']);
        $lineChart->setAxisY($data['axis']['y']);
        $lineChart->setX(40);
        $lineChart->setY(100);
        $lineChart->setWidth(150);
        $lineChart->setHeight(80);
        $bars = [];
        foreach ($data['data'] as $bar) {
            $dataBarChart = new DataLineChart();
            $dataBarChart->setColor($bar['color']);
            $dataBarChart->setX($bar['x']);
            $dataBarChart->setY($bar['y']);
            $bars[] = $dataBarChart;
        }
        $point = new Point();
        $point->setColor([0, 0, 0]);
        $point->setSymbol(DataLineChart::CIRCLE);
        $point->setFillColor([0, 0, 0]);
        $line = new Line();
        $line->setPoints($bars);
        $line->setPoint($point);
        $lineChart->setLinesData([$line]);
        return $lineChart;
    }

    /**
     * Método criado para comparar os pdfs
     * @param string  $expected Conteudo do pdf esperado
     * @param string  $result   Conteudo do pdf gerado
     * @param boolean $showDiff Flag que cria uma imagem com a diferença,caso exista.
     * @return void
     * @throws ImagickException Em caso de erro na leitura e avaliação do pdf
     */
    private function compararPdf(string $expected, string $result, bool $showDiff = false)
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

    /**
     * Linechart sample test
     */
    public function testLineFillChart(): void
    {
        $data = $this->getDataChart();
        $dataChartPie = $this->mountDataChart($data);
        $dataChartPie->setFill(true);
        $dataChartPie->setFillColorLine([200, 50, 50]);
        $result = $dataChartPie->save('lineChartFill.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/lineChartFill.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Linechart sample test
     */
    public function testLineChartGradient(): void
    {
        $data = $this->getDataChart();
        $dataChartPie = $this->mountDataChart($data);
        $dataChartPie->setFill(true);
        $dataChartPie->setFillColorLine([255, 255, 255]);
        $dataChartPie->setDrawColorLine([0, 0, 0]);
        $dataChartPie->setGradient(true);
        $dataChartPie->setColorInitGradiente([255, 0, 0]);
        $result = $dataChartPie->save('lineChartGradient.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/lineChartGradient.pdf');
        $this->compararPdf($expected, $result);
    }
}
