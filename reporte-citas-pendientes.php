<?php
    require('config.php');
    $areaID=$_COOKIE['areaID'];
    $medicoID=$_COOKIE['medicoID'];

    $queryRealizadas="select c.Codigo,concat(a.PNombre,' ',a.SNombre,' ',a.PApellido,' ',a.SApellido) as Estudiante, a.NCuenta as '#Cuenta',concat(m.Nombre,' ',m.Apellido) as Medico,
    c.Hora_I as Hora, c.Asunto, c.CitaID from cita as c inner join alumno as a on a.AlumnoID = c.AlumnoID inner join medico as m on m.MedicoID=c.MedicoID inner join area as ar 
    on ar.AreaID=c.AreaID where c.EstadoID=1 and c.AreaID = '$areaID' and c.Fecha = CURDATE() and m.medicoID = '$medicoID' order by Hora";
    $resultRealizadas=mysqli_query($connection,$queryRealizadas) or die (mysqli_error($connection));
    
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

    $queryMedico="select concat(Nombre,' ',Apellido) as Medico from medico where medicoID='$medicoID'";
    $resultMedico=mysqli_query($connection,$queryMedico) or die (mysqli_error($connection));
    $filaMedico=(mysqli_fetch_assoc($resultMedico));
    $medico=$filaMedico['Medico'];


?>
<?php require 'template/head.php'; ?>
        <link rel="stylesheet" href="css/reportes.css">
        <title>Citas Pendientes</title>
    </head>
    <script>
        function completarCita(cita){
            const citaID = document.querySelector("#citaValueCompletar").value;
            // const citaID = $(cita).data('value');

            var citaObj = {
                id: citaID,
                medico: <?php echo $medicoID ?>,
            }
            $.ajax({
                type:"POST",
                url:"citacompletar.php",
                data: {
                    json: JSON.stringify(citaObj)
                },
                success: function (response) {
                    window.location.href = `${response}`;
                }
            });
        }
        function borrarCita(cita){
                const citaID = document.querySelector("#citaValueBorrar").value;
                // const citaID = $(cita).data('value');

                var citaObj = {
                    id: citaID,
                    medico: <?php echo $medicoID ?>,
                }
                $.ajax({
                    type:"POST",
                    url:"citaborrarmedico.php",
                    data: {
                        json: JSON.stringify(citaObj)
                    },
                    success: function (response) {
                        window.location.href = `${response}`;
                    }
                });
            }
    </script>
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
                    <h2 class="pb-3 text-center">Citas Pendientes del dia en <?php echo $NArea?></h2>
                    <h3 class="pb-3 text-center">Medico - <?php echo $medico?></h3>
                </div>
                <div>
                    <?php
                        echo '<p class="font-weight-bold"> Para Hoy: '.$fecha.'</p>';
                    ?>
                </div>
            </div>
            <table class="table">
                <thead style="background-color: rgb(0,44,158">
                    <tr>
                        <th class="text-white" style="width: 20%">Codigo</th>
                        <th class="text-white" style="width: 20%">Estudiante</th>
                        <th class="text-white" style="width: 30%">#Cuenta</th>
                        <th class="text-white" style="width: 10%">Hora</th>
                        <th class="text-white" style="width: 35%">Asunto</th>
                        <th class="text-white" style="width: 5%"></th>
                    </tr>
            <?php
                while($filaUsuario=(mysqli_fetch_assoc($resultRealizadas))) {
            ?>   
                    <tr>
                    <td class="table-secondary"><?php echo $filaUsuario['Codigo']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Estudiante']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['#Cuenta']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Hora']?></td>
                        <td class="table-secondary"><?php echo $filaUsuario['Asunto']?></td>
                        <td class="table-secondary">
                            <div class="d-flex">
                                <div id="btnCancelar" class="no-print btn btn-outline-danger mr-3" data-value="<?php echo $filaUsuario['CitaID']?>" data-toggle="modal" data-target="#deleteCita">Cancelar Cita</div>
                                <div id="btnCompletar" class="no-print btn btn-outline-success" data-value="<?php echo $filaUsuario['CitaID']?>" data-toggle="modal" data-target="#completarCita">Finalizar Cita</div>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            ?>
            </table>
            <div class="modal fade" id="completarCita">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" style="font-size: 1.5rem">Finalizacion de Cita</h2>
                        </div>
                        <div class="modal-body">
                            <h4 style="font-size: 1rem">Esta a punto de finalizar la cita. Esta seguro de su decision?</h4>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="hidden" name="citaValueCompletar" id="citaValueCompletar">
                            <button type="button" class="btn btn-outline-dark mx-3 my-3" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success mx-3 my-3"  onclick="return completarCita()">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteCita">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" style="font-size: 1.5rem">Cancelacion de Cita</h2>
                        </div>
                        <div class="modal-body">
                            <h4 style="font-size: 1rem">Esta a punto de borrar la cita. Esta seguro de su decision?</h4>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="hidden" name="citaValueBorrar" id="citaValueBorrar">
                            <button type="button" class="btn btn-outline-dark mx-3 my-3" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger mx-3 my-3"  onclick="return borrarCita()">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
        <?php require 'template/bootstrap-scripts.php'?>
    </body>
</html>
<script>
    $('#completarCita').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    let citaID = $(e.relatedTarget).data('value');
    //populate the textbox
    $(e.currentTarget).find('input[name="citaValueCompletar"]').val(citaID);
    });
</script>
<script>
    $('#deleteCita').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    let citaID = $(e.relatedTarget).data('value');
    //populate the textbox
    $(e.currentTarget).find('input[name="citaValueBorrar"]').val(citaID);
    });
</script>