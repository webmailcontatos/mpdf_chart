<?php

use App\Charts\InfoGraphics;
use App\Charts\PdfChart;
use App\Charts\PieChart;
use App\Entity\DataPieChart;
use Mpdf\Output\Destination;
use PHPUnit\Framework\TestCase;

/**
 * Class pie chart
 */
class PieChartTest extends TestCase
{

    /**
     * Piechart sample test
     */
    public function testPieChart(): void
    {
        $data = [
            [
                'data'  => 30,
                'color' => [247, 116, 11]
            ],
            [
                'data'  => 20,
                'color' => [226, 32, 123]
            ],
            [
                'data'  => 12,
                'color' => [73, 164, 159]
            ],
            [
                'data'  => 9,
                'color' => [180, 194, 212],
            ],
            [
                'data'  => 8,
                'color' => [160, 147, 170],
            ],
        ];
        $dataChartPie = $this->mountDataChart($data);
        $pieChart = new PieChart(new PdfChart());
        $pieChart->setWidth(50);
        $pieChart->setHeight(50);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setData($dataChartPie);
        $pieChart->setX(40);
        $pieChart->setY(30);
        $result = $pieChart->save('piechart.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/piechart.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Return list data chart object
     * @param array $data Data chart list
     * @return DataPieChart[]
     */
    protected function mountDataChart(array $data): array
    {
        return array_map(
            function ($data) {
                $dataChartPie = new DataPieChart();
                $dataChartPie->setData($data['data']);
                $dataChartPie->setColor($data['color']);
                $dataChartPie->setLegend($data['legend'] ?? null);
                $dataChartPie->setSeparated($data['separated'] ?? false);
                return $dataChartPie;
            },
            $data
        );
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
     * Piechart sample test
     */
    public function testPieChartWithLegend(): void
    {
        $data = [
            [
                'data'   => 30,
                'color'  => [247, 116, 11],
                'legend' => 'Teatro',
            ],
            [
                'data'   => 20,
                'color'  => [226, 32, 123],
                'legend' => 'Cinema',
            ],
            [
                'data'   => 12,
                'color'  => [73, 164, 159],
                'legend' => 'Restaurante',
            ],
            [
                'data'   => 9,
                'color'  => [180, 194, 212],
                'legend' => 'Futebol',
            ],
            [
                'data'   => 8,
                'color'  => [160, 147, 170],
                'legend' => 'Parque',
            ],
        ];
        $dataChartPie = $this->mountDataChart($data);
        $pieChart = new PieChart(new PdfChart());
        $pieChart->setWidth(100);
        $pieChart->setHeight(100);
        $pieChart->setData($dataChartPie);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setX(80);
        $pieChart->setY(80);
        $result = $pieChart->save('piechart.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/piechart_legend_text.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Piechart sample test
     */
    public function testPieChartDonuts(): void
    {
        $data = [
            [
                'data'  => 30,
                'color' => [247, 116, 11]
            ],
            [
                'data'  => 20,
                'color' => [226, 32, 123]
            ],
            [
                'data'  => 12,
                'color' => [73, 164, 159]
            ],
            [
                'data'  => 9,
                'color' => [180, 194, 212],
            ],
            [
                'data'  => 8,
                'color' => [160, 147, 170],
            ],
        ];
        $dataChartPie = $this->mountDataChart($data);
        $pieChart = new PieChart(new PdfChart());
        $pieChart->setWidth(100);
        $pieChart->setHeight(100);
        $pieChart->setData($dataChartPie);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setX(80);
        $pieChart->setY(80);
        $pieChart->setInnerRadius(25);
        $result = $pieChart->save('piechart_donuts.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/piechart_donuts.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Piechart sample test
     */
    public function testInfoGraphics(): void
    {
        $data = [
            [
                'data'   => 80,
                'color'  => [108, 187, 161],
                'legend' => '01',
            ],
            [
                'data'   => 70,
                'color'  => [206, 14, 195],
                'legend' => '02',
            ],
            [
                'data'   => 60,
                'color'  => [245, 142, 25],
                'legend' => '03',
            ],
            [
                'data'   => 50,
                'color'  => [174, 210, 42],
                'legend' => '04',
            ],
        ];
        $dataChartPie = $this->mountDataChart($data);
        $pieChart = new InfoGraphics(new PdfChart());
        $pieChart->setWidth(140);
        $pieChart->setHeight(140);
        $pieChart->setData($dataChartPie);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setX(100);
        $pieChart->setY(80);
        $pieChart->setInnerRadius(25);
        $result = $pieChart->save('infographics.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/infographics.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Piechart sample test
     */
    public function testPieChartDonutsSameParts(): void
    {
        $data = [
            [
                'data'  => 33, 333333333,
                'color' => [28, 108, 173]
            ],
            [
                'data'  => 33, 333333333,
                'color' => [165, 193, 230]
            ],
            [
                'data'  => 33, 333333333,
                'color' => [247, 116, 11]
            ],
        ];
        $dataChartPie = $this->mountDataChart($data);
        $pieChart = new PieChart(new PdfChart());
        $pieChart->setWidth(100);
        $pieChart->setHeight(100);
        $pieChart->setData($dataChartPie);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setX(80);
        $pieChart->setY(80);
        $pieChart->setInnerRadius(35);
        $result = $pieChart->save('piechart_donuts_same.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/piechart_donuts_same.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Piechart sample test
     */
    public function testPieChartSectorSepareted(): void
    {
        $data = [
            [
                'data'      => 44,
                'color'     => [105, 34, 54],
                'legend'    => '44%',
                'separated' => true,
            ],

            [
                'data'   => 22,
                'color'  => [225, 134, 52],
                'legend' => '22%',

            ],

            [
                'data'   => 33,
                'color'  => [191, 61, 59],
                'legend' => '33%',
            ],

        ];
        $dataChartPie = $this->mountDataChart($data);
        $pieChart = new PieChart(new PdfChart());
        $pieChart->setWidth(100);
        $pieChart->setHeight(100);
        $pieChart->setData($dataChartPie);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setX(100);
        $pieChart->setY(60);
        $pieChart->setInnerRadius(25);
        $result = $pieChart->save('piechart_separated.pdf.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/piechart_separated.pdf');
        $this->compararPdf($expected, $result);
    }
}
