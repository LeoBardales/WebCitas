<?php
    require('config.php');
    require('cn.php');
    $areaID=$_COOKIE['areaID'];

    $queryUsuarios="call HorasDis($areaID);";
    $resultUsuarios=mysqli_query($conexion,$queryUsuarios);
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
        <title>Horas Libres</title>
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
                    <h3 class="pb-3 pl-5">Reporte de Horas Libres de <?php echo $NArea?></h3>
                </div>
                <div class="d-flex" >
                    <div class="d-flex flex-column pr-5 ">
                        <div>
                            <p class="font-weight-bold mb-1">ND: No Disponible</p>
                        </div>
                        <div>
                            <p class="font-weight-bold">L: Libre</p>
                        </div>
                    </div>
                    <div>
                        <?php
                            echo '<p class="font-weight-bold"> Para hoy: '.$fecha.'</p>';
                        ?>
                    </div>
                </div>
            </div>
           <table class="table table-responsive-sm">
                    <thead style="background-color: rgb(0,44,158">
                    <tr>
                        <th class="text-white">Medico</th>
                        <th class="text-white">Numero Empleado</th>
                        <th class="text-white">07</th>
                        <th class="text-white">08</th>
                        <th class="text-white">09</th>
                        <th class="text-white">10</th>
                        <th class="text-white">11</th>
                        <th class="text-white">12</th>
                        <th class="text-white">13</th>
                        <th class="text-white">14</th>
                        <th class="text-white">15</th>
                        <th class="text-white">16</th>
                        <th class="text-white">17</th>
                        <th class="text-white">18</th>
                        <th class="text-white">19</th>
                    </tr>
            <?php
                while($filaUsuario=(mysqli_fetch_assoc($resultUsuarios))) {
             ?>
                    <tr>
                        <td class="table-secondary"><?php echo $filaUsuario['Medico']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['NEmpleado']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['07']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['08']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['09']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['10']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['11']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['12']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['13']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['14']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['15']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['16']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['17']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['18']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['19']?></td>
                    </tr>
            <?php
                }
            ?>
            </table>
        </div>
        <?php require 'template/bootstrap-scripts.php'?>
    </body>
</html>