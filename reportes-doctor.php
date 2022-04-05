<?php
    require('config.php');
    $areaID=$_COOKIE['areaID'];
    $medicoID=$_COOKIE['medicoID'];

    $queryAdmin="select MedicoID from admin where areaID = $areaID";
    $resultAdmin=mysqli_query($connection,$queryAdmin) or die (mysqli_error($connection));
    $filaAdmin=(mysqli_fetch_assoc($resultAdmin));
    $medicoAdmin=$filaAdmin['MedicoID'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/tipo-reportes.css">
    <link rel="shortcut icon" href="voae.ico" type="image/x-icon">
    <title>Reportes</title>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-sm" style="background: linear-gradient(270deg, rgba(0,44,158,1) 0%, rgba(0,42,92,1) 100%);">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburger">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="hamburger" class="collapse navbar-collapse justify-content-center">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="home-doctor.php">Home</a>
            <a class="nav-item nav-link active" href="reportes-doctor.php">Reportes</a>
            <a class="nav-item nav-link" href="index.html">Cerrar Sesion</a>
          </div>
        </div>
    </nav>
        <div class="container d-flex text-center justify-content-center mt-5">
            <div>
                <a href="home-doctor.php" style="position: absolute; left: 1rem; top: 5rem;">
                    <img style="width: 3rem; height: 3rem; " src="img/go-back.png">
                </a>
            </div>
            <div class="reportes mt-5">
                <h1 class="mb-5">Tipos de Reportes</h1>
                <div class="report-item">
                    <h5>Citas pendientes del dia</h5>
                    <a class="report-btn" href="reporte-citas-pendientes.php">Generar Reporte</a>
                </div> 
                <div class="report-item">
                    <h5>Citas Realizadas</h5>
                    <a class="report-btn" href="reporte-citas-realizadas.php">Generar Reporte</a>
                </div> 
                <div class="report-item">
                    <h5>Calendario de citas</h5>
                    <a class="report-btn" href="reporte-citas-pendientes-mes.php">Generar Reporte</a>
                </div>
                <div class="report-item">
                    <h5>Horas Disponibles</h5>
                    <a class="report-btn" href="reporte-horas-libres.php">Generar Reporte</a>
                </div>
                <div class="report-item">
                    <h5>Estudiantes Atendidos</h5>
                    <a class="report-btn" href="reporte-atendidos.php">Generar Reporte</a>
                </div> 
                <?php 
                if ($medicoID == $medicoAdmin){
                    echo 
                    "<div class=\"report-item\">
                        <h5>Demanda por horas</h5>
                        <a class=\"report-btn\" href=\"tipo-horas.html\">Ver Tipos de Reportes</a>
                    </div>
                    <div class=\"report-item\">
                        <h5>Edad de Pacientes</h5>
                        <a class=\"report-btn\" href=\"tipo-edad.html\">Ver Tipos de Reportes</a>
                    </div> 
                    <div class=\"report-item\">
                        <h5>Demanda de citas por departamento</h5>
                        <a class=\"report-btn\" href=\"tipo-dep.html\">Ver Tipos de Reportes</a>
                    </div>
                    <div class=\"report-item\">
                        <h5>Registro de Actividades</h5>
                        <a class=\"report-btn\" href=\"reporte-actividades.php\">Generar Reporte</a>
                    </div>
                    ";
                }
                ?>
            </div>
        </div>
    <script src="js/tether.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>