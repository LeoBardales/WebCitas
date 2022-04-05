<?php
    require('config.php');
    $areaID=$_COOKIE['areaID'];
    $medicoID=$_COOKIE['medicoID'];

    // ===========================================================================
    // Falta agregar condicion de que no sean cita para antes de la fecha actual
    // ==========================================================================

    $queryRealizadas="select c.Codigo,NCuenta,c.Fecha,concat(PNombre,' ',SNombre,' ',PApellido,' ',SApellido) as Estudiante, a.NCuenta as '#Cuenta',concat(m.Nombre,' ',m.Apellido) as Medico, c.Hora_I as Hora, c.Asunto from Cita as c inner join alumno as a on c.AlumnoID = a.AlumnoID
    inner join medico as m on c.MedicoID = m.MedicoID 
    inner join area as ar on c.AreaID = ar.AreaID where c.AreaID = '$areaID' and EstadoID = 1 and month(c.Fecha) = month(now()) and m.medicoID = '$medicoID' order by Fecha, Hora";
    $resultRealizadas=mysqli_query($connection,$queryRealizadas) or die (mysqli_error($connection));
    
    $queryReporte="select max(ReporteID) as ID from reporte";
    $resultReporte=mysqli_query($connection,$queryReporte) or die (mysqli_error($connection));
    $filaReporte=(mysqli_fetch_assoc($resultReporte));
    $id=$filaReporte['ID'];
    $id=$id+1;

    $queryFecha="select CURDATE() as Fecha, (case month(CURDATE()) when 1 then 'Enero' when 2 then 'Febrero' when 3 then 'Marzo' when 4 then 'Abril' when 5 then 'Mayo' when 6 then 'Junio' when 7 then 'Julio'
    when 8 then 'Agosto' when 9 then 'Septiembre' when 10 then 'Octubre' when 11 then 'Noviembre' when 12 then 'Diciembre' end) as Mes, year(CURDATE()) as Anio";
    $resultFecha=mysqli_query($connection,$queryFecha) or die (mysqli_error($connection));
    $filaFecha=(mysqli_fetch_assoc($resultFecha));
    $fecha=$filaFecha['Fecha']; 
    $mes=$filaFecha['Mes'];
    $anio=$filaFecha['Anio']; 
    
    $queryNArea="select Area from Area where AreaID='$areaID'";
    $resultNArea=mysqli_query($connection,$queryNArea) or die (mysqli_error($connection));
    $filaNArea=(mysqli_fetch_assoc($resultNArea));
    $NArea=$filaNArea['Area'];

    $queryMedico="select concat(Nombre,' ',Apellido) as Medico from medico where medicoID='$medicoID'";
    $resultMedico=mysqli_query($connection,$queryMedico) or die (mysqli_error($connection));
    $filaMedico=(mysqli_fetch_assoc($resultMedico));
    $medico=$filaMedico['Medico'];
?>
<?php require 'template/head.php'; ?>
        <link rel="stylesheet" href="css/reportes.css">
        <title>Citas Pendientes</title>
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
                    <h2 class="pb-3">Citas Pendientes de <?php echo $NArea?> para el mes de <?php echo $mes.' '.$anio ?></h2>
                    <h3 class="pb-3 text-center">Medico - <?php echo $medico?></h3>
                </div>
                <div>
                    <?php
                        echo '<p class="font-weight-bold"> Fecha: '.$fecha.'</p>';
                    ?>
                </div>
            </div>
            <table class="table">
                    <thead style="background-color: rgb(0,44,158">
                    <tr>
                        <th class="text-white" style="width: 20%">Fecha</th>
                        <th class="text-white" style="width: 15%">Codigo Cita</th>
                        <th class="text-white" style="width: 15%">Cuenta</th>
                        <th class="text-white" style="width: 25%">Estudiante</th>
                        <th class="text-white" style="width: 10%">Hora</th>
                        <th class="text-white" style="width: 25%">Asunto</th>
                    </tr>
            <?php
                while($filaUsuario=(mysqli_fetch_assoc($resultRealizadas))) {
            ?>
                    <tr>
                        <td class="table-secondary"><?php echo $filaUsuario['Fecha']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Codigo']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['NCuenta']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Estudiante']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Hora']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Asunto']?></td>
                    </tr>
            <?php
            
                }
            ?>
            </table>
        </div>
        <?php require 'template/bootstrap-scripts.php'?>
    </body>
</html>