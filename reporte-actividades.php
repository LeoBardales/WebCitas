<?php
    require('config.php');
    $areaID=$_COOKIE['areaID'];

    $queryActividad="select concat(a.PNombre,' ',a.SNombre,' ',a.PApellido,' ',a.SApellido) as Estudiante, a.NCuenta as '#Cuenta', c.Codigo as 'Numero de Cita', act.Fecha, ac.Nombre as Accion, 
    ar.Area from actividades as act inner join accion as ac on act.AccionID = ac.AccionID inner join alumno as a 
    on act.AlumnoID = a.AlumnoID inner join cita as c on act.CitaID = c.CitaID inner join area as ar on c.AreaID = ar.AreaID
    where c.AreaID = '$areaID' order by act.Fecha";
    $resultActividad=mysqli_query($connection,$queryActividad) or die (mysqli_error($connection));
    
    $queryReporte="select max(ReporteID) as ID from reporte";
    $resultReporte=mysqli_query($connection,$queryReporte) or die (mysqli_error($connection));
    $filaReporte=(mysqli_fetch_assoc($resultReporte));
    $id=$filaReporte['ID'];
    $id=$id+1;

    $queryFecha="select CURDATE() as Fecha";
    $resultFecha=mysqli_query($connection,$queryFecha) or die (mysqli_error($connection));
    $filaFecha=(mysqli_fetch_assoc($resultFecha));
    $fecha=$filaFecha['Fecha']; 
    
    $queryNArea="select Area from Area where AreaID='$areaID'";
    $resultNArea=mysqli_query($connection,$queryNArea) or die (mysqli_error($connection));
    $filaNArea=(mysqli_fetch_assoc($resultNArea));
    $NArea=$filaNArea['Area'];
?>
<?php require 'template/head.php'; ?>
        <link rel="stylesheet" href="css/reportes.css">
        <title>Actividades</title>
    </head>
    <body>
    <?php include 'template/nav.php'; ?>
        <div class="d-flex justify-content-between">
            <div class="no-print pt-3 pb-0 pl-3">
                <a href="reportes-doctor.php">
                    <img style="width: 3rem; height: 3rem;" src="img/go-back.png">
                </a>
            </div>
        <?php include 'template/icon-logo.php';?>    
            <div class="d-flex justify-content-between">
                <div>
                    <?php
                        echo '<p class="font-weight-bold"></p>';
                    ?>
                </div>
                <div>
                    <h3 class="pb-3">Reporte de Actividades para <?php echo $NArea?></h3>
                </div>
                <div>
                    <?php
                        echo '<p class="font-weight-bold"> Hasta hoy: '.$fecha.'</p>';
                    ?>
                </div>
            </div>
            <table class="table">
                <thead style="background-color: rgb(0,44,158">
                    <tr>
                    
                        <th class="text-white" style="width: 20%">Fecha</th>
                        <th class="text-white" style="width: 30%">Estudiante</th>
                        <th class="text-white" style="width: 15%">#Cuenta</th>
                        <th class="text-white" style="width: 20%">Codigo de Cita</th>
                        <th class="text-white" style="width: 15%">Accion</th>
                        <!-- <th class="text-white">Area</th> -->
                    </tr>
            <?php
                while($filaUsuario=(mysqli_fetch_assoc($resultActividad))) {
            ?>
                    <tr>
                    
                        <td class="table-secondary"><?php echo $filaUsuario['Fecha']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Estudiante']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['#Cuenta']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Numero de Cita']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Accion']?></td>
                        <!-- <td class="table-secondary"><?php echo $filaUsuario['Area']?></td> -->
                    </tr>
            <?php
                }
            ?>
            </table>
        </div>
        <?php require 'template/bootstrap-scripts.php'?>
    </body>
</html>