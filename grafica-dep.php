<?php
    require('config.php');
    require('cn.php');

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

        $resultUsuarios=mysqli_query($conexion,"call ContArea(0);");
        $mesNombre=$mes;
    }
    else {
        $queryFecha="select CURDATE() as Fecha,year(CURDATE()) as Anio";
        $resultFecha=mysqli_query($connection,$queryFecha) or die (mysqli_error($connection));
        $filaFecha=(mysqli_fetch_assoc($resultFecha));
        $fecha=$filaFecha['Fecha'];
        $anio=$filaFecha['Anio'];
        $mes=$_GET['mes'];

        $resultUsuarios=mysqli_query($conexion,"call ContArea($mes);");
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
        <title>Grafico Cantidad Departamento</title>
    </head>
    <body>
    <?php include 'template/nav.php'; ?>
        <div class="d-flex justify-content-between">
            <div class="no-print pt-3 pb-0 pl-3">
                <a href="tipo-dep.html">
                    <img style="width: 3rem; height: 3rem;" src="img/go-back.png">
                </a>
            </div>
        <?php include 'template/icon-logo.php';?>
            <?php include 'template/titulos-dep.php';?>
            <div>
                <h3 class="pb-3 text-center">Demanda por Departamento - <?php echo $mesNombre.' '.$anio; ?></h3>
                <select class="form-control" id="career" onchange="changeMonthAreas(this)">
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
            <div class="d-flex" >
                <div>
                    <?php
                        echo '<p class="font-weight-bold"> Fecha: '.$fecha.'</p>';
                    ?>
                </div>
            </div>
        </div>
        <div class="container">
            <table id="tabla-horas" class="table col-xl-2 mr-5 text-center mt-3">
                <thead style="background-color: rgb(0,44,158);">
                    <tr>
                        <th class="text-white">Departamento</th>
                        <th class="text-white">Cantidad</th>
                    </tr>
                <?php
                    while($filaUsuario=(mysqli_fetch_assoc($resultUsuarios))) {
                ?>
                            <tr>
                                <td class="table-secondary"><?php echo $filaUsuario['Departamento']?></td>
                                <td class="table-secondary"><?php echo $filaUsuario['Cantidad']?></td>        
                            </tr>
                        <?php
                    }
                ?>
                </table>
                <?php
                    include("cn.php");
                    if (!isset($_GET['mes'])){
                        $pri=mysqli_query($conexion,"call ContArea(0);");
                    }
                    else {
                        $pri=mysqli_query($conexion,"call ContArea($mes);");
                    }
                    while($row=mysqli_fetch_assoc($pri)){
                        $prue= $row["Departamento"];
                        if($prue == "Medicina General"){
                            $item1=$row["Cantidad"];
                        }
                        if($prue == "Psicologia"){
                            $item2=$row["Cantidad"];
                        }
                        if($prue == "Odontologia"){
                            $item3=$row["Cantidad"];
                        }
                    }
                ?>
        <?php require 'template/piechart.php'?>
        <?php require 'template/bootstrap-scripts.php'?>
    </body>
</html>