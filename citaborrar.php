<?php 
    $conexion=mysqli_connect('localhost','root','','cita');
    $json = filter_input(INPUT_POST, 'json');
    $decoded_json = json_decode($json);
    $citaID = $decoded_json->id;
    $alumnoID = $decoded_json->alumno;

    $act="SELECT max(ActividadID),curdate() FROM `actividades` ";  
            $result4=mysqli_query($conexion,$act); 
            while ($row=mysqli_fetch_row($result4)) {  
            $maxAct=utf8_encode($row[0]);   
            $fecha=utf8_encode($row[1]);
            }
            $nActividad=$maxAct+1;

    
            
	
    // echo 'citaID='.$citaID.' alumnoID='.$alumnoID;
    // $delete="delete from cita where CitaID = '$citaID' and alumnoID= '$alumnoID'";  
    $delete="update cita set EstadoID=3 where CitaID = '$citaID' and alumnoID= '$alumnoID'";  
    $result2=mysqli_query($conexion,$delete);


    $insertAct="INSERT INTO `actividades`(`ActividadID`, `Fecha`, `AccionID`, `AlumnoID`, `CitaID`) 
            VALUES ('$nActividad','$fecha',2,'$alumnoID','$citaID')";  
            $result3=mysqli_query($conexion,$insertAct);

    echo 'detalles-cita.php';

    

?>