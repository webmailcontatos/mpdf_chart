<?php

use App\Charts\BarChart;
use App\Charts\InfoGraphics;
use App\Charts\Line;
use App\Charts\LineChart;
use App\Charts\PdfChart;
use App\Charts\PieChart;
use App\Entity\DataBarChart;
use App\Entity\DataLineChart;
use App\Entity\DataPieChart;
use Mpdf\Output\Destination;
use PHPUnit\Framework\TestCase;

/**
 * Chart test
 */
class ChartTest extends TestCase
{

    /**
     * Piechart sample test
     */
    public function testChart(): void
    {
        $pdf = new PdfChart();
        $pdf->AddPage();
        $this->setPieChartSimple($pdf);
        $this->setPieChartLegend($pdf);
        $this->setDunutChart($pdf);
        $this->setInfoGraphics($pdf);
        $this->setDonutChartSamePart($pdf);
        $this->setSectorSepareted($pdf);
        $pdf->AddPage();
        $this->setBarChart($pdf);
        $this->setBarChartGridOnly3($pdf);
        $pdf->AddPage();
        $this->setBarChartGrid($pdf);
        $this->setBarChartAlphaBar($pdf);
        $pdf->AddPage();
        $this->setLineChart($pdf);
        $this->setLineChartFill($pdf);
        $pdf->AddPage();
        $this->setLineChartGradient($pdf);
        $this->setLineChartTriangleSimbols($pdf);
        $result = $pdf->Output('samples.pdf', Destination::STRING_RETURN);
        $expected = file_get_contents(__DIR__ . '/../files/samples.pdf');
        $this->compararPdf($expected, $result);
    }

    /**
     * Set chart on pdf
     * @param PdfChart $pdfChart Pdf lib
     * @throws \Mpdf\MpdfException
     */
    protected function setPieChartSimple(PdfChart $pdfChart): void
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
        $pieChart = new PieChart($pdfChart);
        $pieChart->setMargin(20);
        $pieChart->setWidth(75);
        $pieChart->setHeight(75);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setData($dataChartPie);
        $pieChart->setX(50);
        $pieChart->setY(50);
        $pieChart->write();
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
     * Set pie chart legend
     * @param PdfChart $pdfChart Pdf chart lib
     * @return void
     */
    protected function setPieChartLegend(PdfChart $pdfChart): void
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
        $pieChart = new PieChart($pdfChart);
        $pieChart->setMargin(20);
        $pieChart->setWidth(75);
        $pieChart->setHeight(75);
        $pieChart->setData($dataChartPie);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setX(160);
        $pieChart->setY(50);
        $pieChart->write();
    }

    /**
     * Set donut chart
     * @param PdfChart $pdfChart Pdf chart
     * @return void
     */
    protected function setDunutChart(PdfChart $pdfChart): void
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
        $pieChart = new PieChart($pdfChart);
        $pieChart->setMargin(20);
        $pieChart->setWidth(75);
        $pieChart->setHeight(75);
        $pieChart->setData($dataChartPie);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setX(50);
        $pieChart->setY(150);
        $pieChart->setInnerRadius(25);
        $pieChart->write();
    }

    /**
     * Set info graphics
     * @param PdfChart $pdfChart Pdf chart
     * @throws \Mpdf\MpdfException
     */
    protected function setInfoGraphics(PdfChart $pdfChart): void
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
        $pieChart = new InfoGraphics($pdfChart);
        $pieChart->setMargin(20);
        $pieChart->setWidth(110);
        $pieChart->setHeight(110);
        $pieChart->setData($dataChartPie);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setX(150);
        $pieChart->setY(150);
        $pieChart->setInnerRadius(25);
        $pieChart->write();
    }

    /**
     * Set donut part
     * @param PdfChart $pdfChart Pdf chart
     * @throws \Mpdf\MpdfException
     */
    protected function setDonutChartSamePart(PdfChart $pdfChart): void
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
        $pieChart = new PieChart($pdfChart);
        $pieChart->setMargin(20);
        $pieChart->setWidth(75);
        $pieChart->setHeight(75);
        $pieChart->setData($dataChartPie);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setX(50);
        $pieChart->setY(250);
        $pieChart->setInnerRadius(25);
        $pieChart->write();
    }

    /**
     * Set sector separeted
     * @param PdfChart $pdfChart Pdf char lib
     */
    protected function setSectorSepareted(PdfChart $pdfChart): void
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
        $pieChart = new PieChart($pdfChart);
        $pieChart->setMargin(20);
        $pieChart->setWidth(75);
        $pieChart->setHeight(75);
        $pieChart->setData($dataChartPie);
        $pieChart->setDrawColorLine([255, 255, 255]);
        $pieChart->setFillColorLine([255, 255, 255]);
        $pieChart->setX(150);
        $pieChart->setY(250);
        $pieChart->setInnerRadius(20);
        $pieChart->write();
    }

    /**
     * Bar chart sample test
     * @param PdfChart $pdfChart Pdf lib
     * @return void
     */
    public function setBarChart(PdfChart $pdfChart): void
    {
        $pdfChart->SetDrawColor(0, 0, 0);
        $pdfChart->SetFillColor(0, 0, 0);
        $pdfChart->SetTextColor(0, 0, 0);
        $pdfChart->SetFont('Arial', '');
        $data = $this->getDataChart();
        $dataChartBar = $this->mountDataChartBar($data, $pdfChart);
        $dataChartBar->setX(35);
        $dataChartBar->setY(90);
        $dataChartBar->write();
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
     * @param array    $data     Data chart list
     * @param PdfChart $pdfChart Pdf chart lib
     * @return BarChart
     */
    protected function mountDataChartBar(array $data, PdfChart $pdfChart): BarChart
    {
        $barChart = new BarChart($pdfChart);
        $barChart->setAxisX($data['axis']['x']);
        $barChart->setAxisY($data['axis']['y']);
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
     * Bar chart sample test
     * @param PdfChart $pdfChart Pdf lib
     * @return void
     */
    public function setBarChartGridOnly3(PdfChart $pdfChart): void
    {
        $pdfChart->SetDrawColor(0, 0, 0);
        $pdfChart->SetFillColor(0, 0, 0);
        $pdfChart->SetTextColor(0, 0, 0);
        $pdfChart->SetFont('Arial', '');
        $data = $this->getDataChartOnly3();
        $dataChartBar = $this->mountDataChartBar($data, $pdfChart);
        $dataChartBar->setX(35);
        $dataChartBar->setY(220);
        $dataChartBar->write();
    }

    /**
     * Return data chart
     * @return array
     */
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
     * @param PdfChart $pdfChart Pdf lib
     * @return void
     */
    public function setBarChartGrid(PdfChart $pdfChart): void
    {
        $pdfChart->SetDrawColor(0, 0, 0);
        $pdfChart->SetFillColor(0, 0, 0);
        $pdfChart->SetTextColor(0, 0, 0);
        $pdfChart->SetFont('Arial', '');
        $data = $this->getDataChartOnly3();
        $dataChartBar = $this->mountDataChartBar($data, $pdfChart);
        $dataChartBar->gridHorizontal();
        $dataChartBar->setLineWidth(0.1);
        $dataChartBar->setX(35);
        $dataChartBar->setY(90);
        $dataChartBar->write();
    }

    /**
     * Bar chart sample test
     * @param PdfChart $pdfChart Pdf lib
     * @return void
     */
    public function setBarChartAlphaBar(PdfChart $pdfChart): void
    {
        $pdfChart->SetDrawColor(0, 0, 0);
        $pdfChart->SetFillColor(0, 0, 0);
        $pdfChart->SetTextColor(0, 0, 0);
        $pdfChart->SetFont('Arial', '');
        $data = $this->getDataChartBarComplete();
        $dataChartBar = $this->mountDataChartBar($data, $pdfChart);
        $dataChartBar->gridHorizontal();
        $dataChartBar->setLineWidth(0.1);
        $dataChartBar->setAlphaBar(true);
        $dataChartBar->setBorderBar(true);
        $dataChartBar->setLineWidth(0.1);
        $dataChartBar->setX(35);
        $dataChartBar->setY(220);
        $dataChartBar->write();
    }

    protected function getDataChartBarComplete(): array
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
     * Linechart sample test
     * @param PdfChart $pdfChart Pdf lib
     * @return void
     */
    public function setLineChart(PdfChart $pdfChart): void
    {
        $data = $this->getDataChartLine();
        $dataChartLine = $this->mountDataChartLine($data, $pdfChart);
        $dataChartLine->setFillColorLine([0, 0, 0]);
        $dataChartLine->setDrawColorLine([0, 0, 0]);
        $dataChartLine->setX(35);
        $dataChartLine->setY(90);
        $dataChartLine->write();
    }

    protected function getDataChartLine(): array
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
     * Mount line chart
     * @param array    $data     Data chart
     * @param PdfChart $pdfChart Chart pdf lib
     * @return LineChart
     */
    protected function mountDataChartLine(array $data, PdfChart $pdfChart, int $symbol = DataLineChart::CIRCLE): LineChart
    {
        $lineChart = new LineChart($pdfChart);
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
            $dataBarChart->setSymbol($symbol);
            $bars[] = $dataBarChart;
        }
        $line = new Line();
        $line->setPoints($bars);
        $lineChart->setLinesData([$line]);
        return $lineChart;
    }

    /**
     * Linechart sample test
     * @param PdfChart $pdfChart Pdf lib
     * @return void
     */
    public function setLineChartFill(PdfChart $pdfChart): void
    {
        $data = $this->getDataChartLine();
        $dataChartLine = $this->mountDataChartLine($data, $pdfChart);
        $dataChartLine->setFill(true);
        $dataChartLine->setFillColorLine([200, 50, 50]);
        $dataChartLine->setX(40);
        $dataChartLine->setY(220);
        $dataChartLine->write();
    }

    /**
     * Linechart sample test
     * @param PdfChart $pdfChart Pdf lib
     * @return void
     */
    public function setLineChartGradient(PdfChart $pdfChart): void
    {
        $data = $this->getDataChartLine();
        $dataChartLine = $this->mountDataChartLine($data, $pdfChart);
        $dataChartLine->setFill(true);
        $dataChartLine->setFillColorLine([255, 255, 255]);
        $dataChartLine->setDrawColorLine([0, 0, 0]);
        $dataChartLine->setGradient(true);
        $dataChartLine->setColorInitGradiente([180, 0, 0]);
        $dataChartLine->setX(35);
        $dataChartLine->setY(90);
        $dataChartLine->write();
    }

    /**
     * Linechart sample test triangle
     * @param PdfChart $pdfChart Pdf lib
     * @return void
     */
    public function setLineChartTriangleSimbols(PdfChart $pdfChart): void
    {
        $bars = [];
        $data = $this->getDataChartLine();
        foreach ($data['data'] as $bar) {
            $dataBarChart = new DataLineChart();
            $dataBarChart->setColor($bar['color']);
            $dataBarChart->setX($bar['x']);
            $dataBarChart->setY($bar['y'] * 0.3);
            $dataBarChart->setSymbol(DataLineChart::CIRCLE);
            $bars[] = $dataBarChart;
        }
        $dataChartLine = $this->mountDataChartLine($data, $pdfChart, DataLineChart::TRIANGLE);
        $dataChartLine->setFillColorLine([0, 0, 0]);
        $dataChartLine->setDrawColorLine([0, 0, 0]);
        $line = new Line();
        $line->setPoints($bars);
        $line->setColor([255, 0, 0]);
        $data = $dataChartLine->getData();
        $data[] = $line;
        $dataChartLine->setLinesData($data);
        $dataChartLine->setX(35);
        $dataChartLine->setY(220);
        $dataChartLine->write();
    }

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
}
