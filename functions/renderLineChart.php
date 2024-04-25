<?php
function renderLineChart($id, $chartType, $chartTitle, $eixoXLabels, $lineNames, $dataSets)
{
    $chart_data = array();
    $chart_data[] = array_merge(['Eixo X'], $lineNames);

    // Verifica se $dataSets está vazio
    if (empty($dataSets)) {
        // Se estiver vazio, preenche com arrays de zeros
        $num_lines = count($lineNames);
        $num_labels = count($eixoXLabels);
        for ($i = 0; $i < $num_labels; $i++) {
            $data = [$eixoXLabels[$i]];
            for ($j = 0; $j < $num_lines; $j++) {
                $data[] = 0;
            }
            $chart_data[] = $data;
        }
    } else {
        // Caso contrário, processa normalmente os dados
        foreach ($eixoXLabels as $index => $label) {
            $data = [$label];
            foreach ($dataSets as $dataset) {
                $data[] = (int) $dataset[$index];
            }
            $chart_data[] = $data;
        }
    }

    $chart_data_json = json_encode($chart_data);
?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var jsonData = <?php echo $chart_data_json; ?>;
            var data = google.visualization.arrayToDataTable(jsonData);

            var options = {
                title: '<?php echo $chartTitle; ?>',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                animation: {
                    duration: 2000, // Animacão mais lenta
                    easing: 'linear', // Easing padrão
                    startup: true
                },
                is3D: true // Habilita visualização 3D
            };

            var chart;
            switch (<?php echo $chartType; ?>) {
                case 1:
                    chart = new google.visualization.LineChart(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 2:
                    chart = new google.visualization.PieChart(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 3:
                    chart = new google.visualization.BarChart(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 4:
                    chart = new google.visualization.AreaChart(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 5:
                    chart = new google.visualization.ScatterChart(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 6:
                    chart = new google.visualization.ColumnChart(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 7:
                    chart = new google.visualization.CandlestickChart(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 8:
                    chart = new google.visualization.BubbleChart(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 9:
                    chart = new google.visualization.GeoChart(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 10:
                    chart = new google.visualization.Timeline(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 11:
                    chart = new google.visualization.OrgChart(document.getElementById('<?php echo $id; ?>'));
                    break;
                case 12:
                    chart = new google.visualization.Table(document.getElementById('<?php echo $id; ?>'));
                    break;
                    // Adicione mais tipos de gráfico conforme necessário
                default:
                    console.error('Tipo de gráfico desconhecido.');
            }

            chart.draw(data, options);
        }

        // Função para redimensionar o gráfico quando a janela for redimensionada
        window.addEventListener('resize', function() {
            drawChart();
        });
    </script>

    <!-- O gráfico será exibido aqui -->
    <div id="<?php echo $id; ?>" style="width: 100%; height: 100%;"></div>
<?php
}
?>