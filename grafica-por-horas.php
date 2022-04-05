<?php
    require('config.php');
    require('cn.php');
	$areaID=$_COOKIE['areaID'];

	$queryNArea="select Area from Area where AreaID='$areaID'";
    $resultNArea=mysqli_query($connection,$queryNArea) or die (mysqli_error($connection));
    $filaNArea=(mysqli_fetch_assoc($resultNArea));
    $NArea=$filaNArea['Area'];

    $queryReporte="select max(ReporteID) as ID from reporte";
    $resultReporte=mysqli_query($connection,$queryReporte) or die (mysqli_error($connection));
    $filaReporte=(mysqli_fetch_assoc($resultReporte));
    $id=$filaReporte['ID'];
    $id=$id+1;

    if (!isset($_GET['mes'])){
		$queryFecha="select CURDATE() as Fecha, (case month(CURDATE()) when 1 then 'Enero' when 2 then 'Febrero' 
		when 3 then 'Marzo' when 4 then 'Abril' when 5 then 'Mayo' when 6 then 'Junio' 
		when 7 then 'Julio' when 8 then 'Agosto' when 9 then 'Septiembre' when 10 then 'Octubre' 
		when 11 then 'Noviembre' else 'Diciembre' end ) as Mes, year(CURDATE()) as Anio";
		$resultFecha=mysqli_query($connection,$queryFecha) or die (mysqli_error($connection));
		$filaFecha=(mysqli_fetch_assoc($resultFecha));
		$fecha=$filaFecha['Fecha'];
		$mes=$filaFecha['Mes'];
		$anio=$filaFecha['Anio'];

        $resultUsuarios=mysqli_query($conexion,"call ContHorasPor(0,$areaID);");
        $mesNombre=$mes;
    }
    else {
        $queryFecha="select CURDATE() as Fecha,year(CURDATE()) as Anio";
        $resultFecha=mysqli_query($connection,$queryFecha) or die (mysqli_error($connection));
        $filaFecha=(mysqli_fetch_assoc($resultFecha));
        $fecha=$filaFecha['Fecha'];
        $anio=$filaFecha['Anio'];
        $mes=$_GET['mes'];

        $resultUsuarios=mysqli_query($conexion,"call ContHorasPor($mes,$areaID);");
        switch($mes){
            case "1":
                    $mesNombre="Enero";
                    break;
            case "2":
                    $mesNombre="Febrero";
                    break;
            case "3":
                    $mesNombre="Marzo";
                    break;
            case "4":
                    $mesNombre="Abril";
                    break;
            case "5":
                    $mesNombre="Mayo";
                    break;
            case "6":
                    $mesNombre="Junio";
                    break;
            case "7":
                    $mesNombre="Julio";
                    break;
            case "8":
                    $mesNombre="Agosto";
                    break;
            case "9":
                    $mesNombre="Septiembre";
                    break;
            case "10":
                    $mesNombre="Octubre";
                    break;
            case "11":
                    $mesNombre="Noviembre";
                    break;
            case "12":
                    $mesNombre="Diciembre";
                    break;    
        }
    }
    
?>
<?php require 'template/head.php'; ?>
		<link rel="stylesheet" href="css/reportes.css">
		<title>Grafico Porcentaje de Horas</title>
    </head>
    <body>
	<?php include 'template/nav.php'; ?>
		<div class="d-flex justify-content-between">
			<div class="no-print pt-3 pb-0 pl-3">
				<a href="tipo-horas.html">
					<img style="width: 3rem; height: 3rem;" src="img/go-back.png">
				</a>
			</div>
        <?php include 'template/icon-logo.php';?> 
			<?php include 'template/titulos-horas.php';?>
				<div>
					<?php echo '<h2> Departamento de '.$NArea.'</h2>'?>
					<h3 class="pb-3">Demanda por Horas - <?php echo $mesNombre.' '.$anio ?></h3>
					<select class="form-control" id="career" onchange="changeMonthHorasPor(this)">
						<option value="">Elija el mes</option>
						<option value="1">Enero</option>
						<option value="2">Febrero</option>
						<option value="3">Marzo</option>
						<option value="4">Abril</option>
						<option value="5">Mayo</option>
						<option value="6">Junio</option>
						<option value="7">Julio</option>
						<option value="8">Agosto</option>
						<option value="9">Septiembre</option>
						<option value="10">Octubre</option>
						<option value="11">Noviembre</option>
						<option value="12">Diciembre</option>
					</select>
				</div>
				<?php include 'template/tabla-horas.php';?>
							<th class="text-white">Porcentaje</th>
						</tr>
				<?php
					while($filaUsuario=(mysqli_fetch_assoc($resultUsuarios))) {
				?>
						<tr>
							<td class="table-secondary"><?php echo $filaUsuario['Hora']?></td>
							<td class="table-secondary"><?php echo $filaUsuario['Porcentaje']?></td>	
						</tr>
				<?php
					}
				?>
				</table>
				<?php
					include("cn.php");
					if (!isset($_GET['mes'])){
                        $pri=mysqli_query($conexion,"call ContHorasPor(0,$areaID);");
                    }
                    else {
                        $pri=mysqli_query($conexion,"call ContHorasPor($mes,$areaID);");
                    }
					while($row=mysqli_fetch_assoc($pri)){
						$prue= $row["Hora"];
						if($prue == "7:00:00"){
							$num7=$row["Porcentaje"];
							$temp = explode("%", $num7);
							$num7=$temp[0];
						}
						if($prue == "8:00:00"){
							$num8=$row["Porcentaje"];
							$temp = explode("%", $num8);
							$num8=$temp[0];
						}
						if($prue == "9:00:00"){
							$num9=$row["Porcentaje"];
							$temp = explode("%", $num9);
							$num9=$temp[0];
						}
						if($prue == "10:00:00"){
							$num10=$row["Porcentaje"];
							$temp = explode("%", $num10);
							$num10=$temp[0];
						}
						if($prue == "11:00:00"){
							$num11=$row["Porcentaje"];
							$temp = explode("%", $num11);
							$num11=$temp[0];
						}
						if($prue == "12:00:00"){
							$num12=$row["Porcentaje"];
							$temp = explode("%", $num12);
							$num12=$temp[0];
						}
						if($prue == "13:00:00"){
							$num13=$row["Porcentaje"];
							$temp = explode("%", $num13);
							$num13=$temp[0];
						}
						if($prue == "14:00:00"){
							$num14=$row["Porcentaje"];
							$temp = explode("%", $num14);
							$num14=$temp[0];
						}
						if($prue == "15:00:00"){
							$num15=$row["Porcentaje"];
							$temp = explode("%", $num15);
							$num15=$temp[0];
						}
						if($prue == "16:00:00"){
							$num16=$row["Porcentaje"];
							$temp = explode("%", $num16);
							$num16=$temp[0];
						}
						if($prue == "17:00:00"){
							$num17=$row["Porcentaje"];
							$temp = explode("%", $num17);
							$num17=$temp[0];
						}
						if($prue == "18:00:00"){
							$num18=$row["Porcentaje"];
							$temp = explode("%", $num18);
							$num18=$temp[0];
						}
						if($prue == "19:00:00"){
							$num19=$row["Porcentaje"];
							$temp = explode("%", $num19);
							$num19=$temp[0];
						}
					}
				?>
		<?php require 'template/barchartHoras.php'?>
		<?php require 'template/bootstrap-scripts.php'?>
    </body>
</html>