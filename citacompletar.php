<?php 
    $conexion=mysqli_connect('localhost','root','1234567','cita');
    $json = filter_input(INPUT_POST, 'json');
    $decoded_json = json_decode($json);
    $citaID = $decoded_json->id;
    $medicoID = $decoded_json->medico;
	
    // echo 'citaID='.$citaID.' alumnoID='.$alumnoID;
    $delete="update cita set EstadoID=2 where CitaID = '$citaID' and medicoID= '$medicoID'";  
    $result2=mysqli_query($conexion,$delete);
    echo 'reporte-citas-pendientes.php';
?>