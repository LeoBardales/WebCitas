<?php
    require('config.php');
    $userID=$_COOKIE['userID'];

    $queryAlumno="select AlumnoID, concat(PNombre,' ',SNombre,' ',PApellido,' ',SApellido) as NombreCompleto, 
                  NCuenta from alumno where userID='$userID'";
    $resultAlumno=mysqli_query($connection,$queryAlumno) or die (mysqli_error($connection));
    $filaAlumno=(mysqli_fetch_assoc($resultAlumno));
    $alumnoID=$filaAlumno['AlumnoID'];
    $nombreAlumno=$filaAlumno['NombreCompleto'];
    $ncuenta=$filaAlumno['NCuenta'];

    $queryDetalles="select c.Fecha, c.Codigo,c.Hora_I as Hora,concat(m.Nombre,' ',m.Apellido) as Medico,m.Correo, ar.Area, c.Asunto from cita as c inner join Medico as m on c.MedicoID = m.MedicoID
    inner join area as ar on c.AreaID = ar.AreaID where AlumnoID ='$alumnoID' and EstadoID = 2 order by c.Fecha, Medico";
    $resultDetalles=mysqli_query($connection,$queryDetalles) or die (mysqli_error($connection));

    $queryReporte="select max(ReporteID) as ID from reporte";
    $resultReporte=mysqli_query($connection,$queryReporte) or die (mysqli_error($connection));
    $filaReporte=(mysqli_fetch_assoc($resultReporte));
    $id=$filaReporte['ID'];
    $id=$id+1;

    $queryFecha="select CURDATE() as Fecha";
    $resultFecha=mysqli_query($connection,$queryFecha) or die (mysqli_error($connection));
    $filaFecha=(mysqli_fetch_assoc($resultFecha));
    $fecha=$filaFecha['Fecha'];  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/reportes.css">
        <link rel="shortcut icon" href="voae.ico" type="image/x-icon">
        <title>Historial de Citas</title>
        <style>
                @media print
                {    
                    .no-print {
                        display: none !important;
                    }
                }
        </style>
    </head>
    <body> 
        <?php include 'template/navStudent.php'; ?>
        <div class="d-flex justify-content-between">
                <div class="no-print pt-3 pb-0 pl-3">
                    <a href="home-student.php">
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
                <div class="text-center">
                    <h2 class="pb-3">Historial de Citas</h2>
                    <h3><?php echo $nombreAlumno.' '.$ncuenta?></h3>
                </div>
                <div>
                    <?php
                        echo '<p class="font-weight-bold"> Para hoy: '.$fecha.'</p>';
                    ?>
                </div>
            </div>
            <table class="table table-responsive-sm">
                <thead style="background-color: rgb(0,44,158">
                    <tr>
                        <th class="text-white" style="width: 8%">Fecha</th>
                        <th class="text-white" style="width: 5%">Codigo</th>
                        <th class="text-white" style="width: 5%">Hora</th>
                        <th class="text-white" style="width: 20%">Medico</th>
                        <th class="text-white" style="width: 20%">Correo</th>
                        <th class="text-white" style="width: 15%">Area</th>
                        <th class="text-white" style="width: 30%">Asunto</th>
                    </tr>
            <?php
                while($filaUsuario=(mysqli_fetch_assoc($resultDetalles))) {
            ?>
                    <tr>
                        <td class="table-secondary"><?php echo $filaUsuario['Fecha']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Codigo']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Hora']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Medico']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Correo']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Area']?></td>
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