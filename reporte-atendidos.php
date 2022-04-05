<?php
    require('config.php');
    $areaID=$_COOKIE['areaID'];
    $medicoID=$_COOKIE['medicoID'];

    $queryTabla="select PNombre as 'Primer Nombre', SNombre as 'Segundo Nombre', PApellido as 'Primer Apellido', SApellido as 'Segundo Apellido', NCuenta as '# Cuenta', 
    c.Nombre as Carrera, Correo, TIMESTAMPDIFF(year,Nacimiento,now()) as Edad from alumno as a inner join carrera as c on a.carreraID = c.CarreraID where a.AlumnoID 
    in (select AlumnoID from cita where AreaID = '$areaID' and EstadoID=2 and MedicoID = '$medicoID') order by PNombre,SNombre,PApellido,SApellido";
    $resultTabla=mysqli_query($connection,$queryTabla) or die (mysqli_error($connection));

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
        <title>Atendidos</title>
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
                        $queryReporte="select max(ReporteID) as ID from reporte";
                        $resultReporte=mysqli_query($connection,$queryReporte) or die (mysqli_error($connection));
                        $filaReporte=(mysqli_fetch_assoc($resultReporte));
                        $id=$filaReporte['ID'];
                        $id=$id+1;
                        echo '<p class="font-weight-bold"></p>';
                    ?>
                </div>
                <div>
                    <h3 class="pb-3">Reporte de Estudiantes Atendidos en <?php echo $NArea?></h3>
                    <h3 class="pb-3 text-center">Medico - <?php echo $medico?></h3>
                </div>
                <div>
                    <?php
                        $queryFecha="select CURDATE() as Fecha";
                        $resultFecha=mysqli_query($connection,$queryFecha) or die (mysqli_error($connection));
                        $fecha=(mysqli_fetch_assoc($resultFecha));
                        echo '<p class="font-weight-bold"> Fecha: '.$fecha['Fecha'].'</p>';
                    ?>
                </div>
            </div>
            <table class="table table-responsive-sm">
                <thead style="background-color: rgb(0,44,158">
                    <tr>
                        <th class="text-white">Primer Nombre</th>
                        <th class="text-white">Segundo Nombre</th>
                        <th class="text-white">Primer Apellido</th>
                        <th class="text-white">Segundo Apellido</th>
                        <th class="text-white"># Cuenta</th>
                        <th class="text-white">Carrera</th>
                        <th class="text-white">Edad</th>
                        <th class="text-white">Correo</th>
                    </tr> 
            <?php
                while($filaUsuario = (mysqli_fetch_assoc($resultTabla))) {
            ?>
                    <tr>
                        <td class="table-secondary"><?php echo $filaUsuario['Primer Nombre']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Segundo Nombre']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Primer Apellido']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Segundo Apellido']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['# Cuenta']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Carrera']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Edad']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Correo']?></td>
                    </tr>
            <?php
                }
            ?>
            </table>
        </div>
        <?php require 'template/bootstrap-scripts.php'?>
    </body>
</html>