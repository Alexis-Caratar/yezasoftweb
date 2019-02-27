<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>amCharts examples</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="lib/amchar/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="lib/amchar/amcharts/serial.js" type="text/javascript"></script>

        <script>
            var chart;

            var chartData = [
<?php
require_once dirname(__FILE__) . '/../Clases/ConectorBD.php';
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor;
 $mensajess="";
if (isset($año)&&$año!=NULL) {
    $year=$año;
}else{
$year = date("Y");
}
$lista = "";
for ($j = 1; $j <= 12; $j++) {
    $cadenaSQL = "select SUM(base)as base from caja WHERE fecha BETWEEN '$year-$j-01' AND '$year-$j-31' ";
    $datos = ConectorBD::ejecutarQuery($cadenaSQL, null);
    $meses = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $valormesess = 0;
    if (count($datos) > 0) {
//$array[$j]=$datos[0]['base'];
    $lista .= "<tr><th>".$meses[$j]."</th>";
        $lista .= "<th>{$datos[0]['base']}</th></tr>";
        $valormeses = $datos[0]['base'];
    }
    ?>
                    {
                        "country": "<?= $meses[$j] ?>",
                        "visits": <?= $valormeses + $valormesess ?>
                    },

    <?php
}
?>
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "country";
                chart.startDuration = 1;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 90;
                categoryAxis.gridPosition = "start";

                // value
                // in case you don't want to change default settings of value axis,
                // you don't need to create it, as one value axis is created automatically.

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "visits";
                graph.balloonText = "[[category]]: <b>[[value]]</b>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 0.8;
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart.addChartCursor(chartCursor);

                chart.creditsPosition = "top-right";

                chart.write("chartdiv");
            });
        </script>



    </head>

    <body>
          <div class="offset-8 col-md-4  "style="z-index: 100;  margin: 0% 65%; position: absolute;background: #333333;">
            <form method="post" class="">
             <table class="table-responsive-lg table table-dark table-hover " >
                  <tr>
                      <th> <img src="presentacion/imagenes/buscarpequeño.png"></span></th><td><input  class="form-control" type="text"  autofocus name="año" placeholder="AÑO" ></td>
                      <td><input class="btn-primary"type="submit" value="BUSCAR"></td>
                 </tr>
               </table>
         </form>
            </div>
        
        <div class="container-fluid"><br>
            <h2>INDICADOR</h2>
            <div class="container-fluid row">    
                <div class="col-7"><div id="chartdiv" style="width: 100%; height: 500px; margin: 20% 0%;"></div>
                </div> 
                <div class="col-5" >
                    <H2>VENTAS DEL AÑO <?=$year?></H2>
                    <table class="table table-hover table-responsive-lg">
                        <thead  class="table-dark"><th>FECHA</th><th>GASTO</th></thead>
                    <?= $lista ?>
                    </table>
                </div>
             </div>
        </div>
    </body>

</html>