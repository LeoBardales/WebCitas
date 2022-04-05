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
            labels : ["16-20", "21-25","26-30","31-35","36-40","41-45","46-50","51-55","56-60"],
            datasets: [{
                label: '# por edades',
                // backgroundColor: ['rgb(0, 44, 158)','rgb(255, 204, 0)','rgb(255, 255, 0)','rgb(0, 44, 158)','rgb(255, 204, 0)',
                // 'rgb(255, 255, 0)','rgb(0, 44, 158)','rgb(255, 204, 0)','rgb(255, 255, 0)','rgb(0, 44, 158)','rgb(255, 204, 0)',
                // 'rgb(255, 255, 0)','rgb(0, 44, 158)'],
                backgroundColor: ['rgb(255, 255, 0)','rgb(255, 255, 0)','rgb(255, 255, 0)','rgb(255, 204, 0)','rgb(255, 204, 0)',
                'rgb(255, 204, 0)','rgb(0, 44, 158)','rgb(0, 44, 158)','rgb(0, 44, 158)'],
                data : [<?php echo $item1 ?>,<?php echo $item2 ?>,<?php echo $item3 ?>,<?php echo $item4 ?>,
                <?php echo $item5 ?>,<?php echo $item6 ?>,<?php echo $item7 ?>,<?php echo $item8 ?>,<?php echo $item9 ?>]
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
                    // color: ['black','black','black','black','black','black','white','white','white']
                }
            }
        }   
    };

    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, barChartData);
</script>