    <div id="canvas-holder"><canvas class="resultados" id="chart-area2"></canvas></div>
            <div id="chartjs-tooltip"></div>
        </div>
    </div>
    <script src="js/chart.js"></script>
    <script src="js/chartjs-plugin-datalabels.js"></script>
    <script>
        Chart.plugins.register(ChartDataLabels);

        var pieData = {
            type: 'pie',
            data: {
                labels: [
                    'Medicina',
                    'Psicologia',
                    'Odontologia'
                ],
                datasets: [{
                    label: 'Reporte por Departamentp',
                    backgroundColor: [
                    '#002c9e',
                    '#ffbf00',
                    '#ffff00'
                    ],
                    data: [<?php if ($item1 > 0){echo $item1;}?>, <?php if ($item2 > 0){echo $item2;}?>, <?php if ($item3 > 0){echo $item3;}?>],
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        font: {
                            weight: 'bold',
                            size: 20
                        },
                        color: 'black'
                        // color: ['black','black','black','black','black','black','black','black','black','white','white','white','white']
                    }
                }
            }   
        };
        var ctx = document.getElementById("chart-area2").getContext("2d");
        window.myPie = new Chart(ctx, pieData);
    </script>