        <div class="resultados w-100"><canvas id="canvas"></canvas></div> 
    </div>
</div>
<script src="js/chart.js"></script>
<script src="js/chartjs-plugin-datalabels.js"></script>
<script>
    Chart.plugins.register(ChartDataLabels);

    var barChartData = {
        type: 'bar',
        data: {
            labels : ["07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00"],
            datasets: [{
                label: '# de Citas',
                // backgroundColor: ['rgb(0, 44, 158)','rgb(255, 204, 0)','rgb(255, 255, 0)','rgb(0, 44, 158)','rgb(255, 204, 0)',
                // 'rgb(255, 255, 0)','rgb(0, 44, 158)','rgb(255, 204, 0)','rgb(255, 255, 0)','rgb(0, 44, 158)','rgb(255, 204, 0)',
                // 'rgb(255, 255, 0)','rgb(0, 44, 158)'],
                backgroundColor: ['rgb(255, 255, 0)','rgb(255, 255, 0)','rgb(255, 255, 0)','rgb(255, 255, 0)','rgb(255, 255, 0)',
                'rgb(255, 204, 0)','rgb(255, 204, 0)','rgb(255, 204, 0)','rgb(255, 204, 0)','rgb(0, 44, 158)','rgb(0, 44, 158)',
                'rgb(0, 44, 158)','rgb(0, 44, 158)'],
                data : [<?php echo $num7 ?>,<?php echo $num8 ?>,<?php echo $num9 ?>,<?php echo $num10 ?>,<?php echo $num11 ?>,
                <?php echo $num12 ?>,<?php echo $num13 ?>,<?php echo $num14 ?>,<?php echo $num15 ?>,<?php echo $num16 ?>,
                <?php echo $num17 ?>,<?php echo $num18 ?>,<?php echo $num19 ?>]
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Cantidad por Horas',
                fontSize: 20
            },
            plugins: {
                datalabels: {
                    color: 'black'
                    // color: ['black','black','black','black','black','black','black','black','black','white','white','white','white']
                }
            }
        }   
    };

    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, barChartData);
</script>