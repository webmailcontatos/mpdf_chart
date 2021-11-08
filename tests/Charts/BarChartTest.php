<?php

use App\Charts\BarChart;
use App\Charts\PdfChart;
use App\Entity\DataBarChart;
use Mpdf\Output\Destination;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class BarChartTest extends TestCase
{
    /**
     * Piechart sample test
     */
    public function testBarChart(): void
    {
        $data = $this->getDataChart();
        $dataChartPie = $this->mountDataChart($data);
        $result = $dataChartPie->save('barChart.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/barChart.pdf');
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
                    'y'     => 10,
                    'color' => [32, 117, 154]
                ], [
                    'x'     => 'Fev',
                    'y'     => 20,
                    'color' => [53, 176, 171]
                ], [
                    'x'     => 'Mar',
                    'y'     => 30,
                    'color' => [249, 201, 6]
                ], [
                    'x'     => 'Abr',
                    'y'     => 40,
                    'color' => [150, 84, 190]
                ], [
                    'x'     => 'Mai',
                    'y'     => 50,
                    'color' => [133, 197, 227]
                ], [
                    'x'     => 'Jun',
                    'y'     => 60,
                    'color' => [232, 98, 62]
                ],
                [
                    'x'     => 'Jul',
                    'y'     => 70,
                    'color' => [240, 232, 154]
                ],
                [
                    'x'     => 'Ago',
                    'y'     => 80,
                    'color' => [115, 199, 159]
                ],
                [
                    'x'     => 'Set',
                    'y'     => 90,
                    'color' => [238, 51, 140]
                ],
                [
                    'x'     => 'Out',
                    'y'     => 100,
                    'color' => [143, 145, 247]
                ],
            ]
        ];
    }

    /**
     * Return list data chart object
     * @param array $data Data chart list
     * @return BarChart
     */
    protected function mountDataChart(array $data): BarChart
    {
        $barChart = new BarChart(new PdfChart());
        $barChart->setAxisX($data['axis']['x']);
        $barChart->setAxisY($data['axis']['y']);
        $barChart->setX(40);
        $barChart->setY(100);
        $barChart->setWidth(150);
        $barChart->setHeight(80);
        $bars = [];
        foreach ($data['data'] as $bar) {
            $dataBarChart = new DataBarChart();
            $dataBarChart->setColor($bar['color']);
            $dataBarChart->setX($bar['x']);
            $dataBarChart->setY($bar['y']);
            $bars[] = $dataBarChart;
        }
        $barChart->setData($bars);
        return $barChart;
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
     * Bar chart sample test
     */
    public function testBarChartOnlyWithGrid(): void
    {
        $data = $this->getDataChartOnly3();
        $dataChartPie = $this->mountDataChart($data);
        $dataChartPie->gridHorizontal();
        $dataChartPie->setLineWidth(0.1);
        $result = $dataChartPie->save('barChartGrid.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/barChartGrid.pdf');
        $this->compararPdf($expected, $result);
    }

    protected function getDataChartOnly3(): array
    {
        return [
            'axis' => [
                'x' => [
                    'Jan',
                    'Fev',
                    'Mar',
                ],
                'y' => [
                    0,
                    10,
                    20,
                    30,
                ],
            ],
            'data' => [
                [
                    'x'     => 'Jan',
                    'y'     => 10,
                    'color' => [32, 117, 154]
                ], [
                    'x'     => 'Fev',
                    'y'     => 20,
                    'color' => [53, 176, 171]
                ], [
                    'x'     => 'Mar',
                    'y'     => 30,
                    'color' => [249, 201, 6]
                ],
            ]
        ];
    }

    /**
     * Bar chart sample test
     */
    public function testBarChartOnly3Bar(): void
    {
        $data = $this->getDataChartOnly3();

        $dataChartPie = $this->mountDataChart($data);
        $result = $dataChartPie->save('barChartOnly3.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/barChartOnly3.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Bar chart sample test
     */
    public function testBarChartAlphaBar(): void
    {
        $data = $this->getDataChart();
        $dataChartPie = $this->mountDataChart($data);
        $dataChartPie->gridHorizontal();
        $dataChartPie->setLineWidth(0.1);
        $dataChartPie->setAlphaBar(true);
        $dataChartPie->setBorderBar(true);
        $result = $dataChartPie->save('barChartAlphaBar.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/barChartAlphaBar.pdf');
        $this->compararPdf($expected, $result);
    }

}
