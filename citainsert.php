<?php 
$hoy = date("Y-m-d");
$conexion=mysqli_connect('localhost','root','','cita');

$doctor=$_COOKIE['doctor'];
$fecha=$_COOKIE['fecha'];
$horai=$_COOKIE['Horai'];
$alumnoID=$_COOKIE['alumnoID'];
$area=$_COOKIE["area"];
$asunto=$_COOKIE['asunto'];

$temp = explode(":", $horai);
$hora=$temp[0]+1;
$horaf="";
$horaf=$horaf.$hora.':00:00';


$temp=explode("-", $fecha);
$ano=$temp[0];
$mes=$temp[1];

$codigo="";
$codigo=$codigo.$ano.$mes;

header("location:agendar-cita.php?Area=$area&doctor=$doctor&fecha=$fecha&horai=$horai&horaf=$horaf&alumno=$alumnoID&asunto=$asunto");
    if($hoy<=$fecha){  
        if(date('l',strtotime($fecha))=='Sunday' || date('l',strtotime($fecha))=='Saturday'){
            setcookie('error', 2);
             header("location:agendar-cita.php?Area=$area");
        }else{
            $at="SELECT max(CitaID) FROM cita";  
            $result2=mysqli_query($conexion,$at); 
            while ($row=mysqli_fetch_row($result2)) {  
            $max=utf8_encode($row[0]);   
            }
            $nuevo=$max+1;


            $act="SELECT max(ActividadID),curdate() FROM `actividades` ";  
            $result4=mysqli_query($conexion,$act); 
            while ($row=mysqli_fetch_row($result4)) {  
            $maxAct=utf8_encode($row[0]);
            $feact=utf8_encode($row[1]);    
            }
            $nActividad=$maxAct+1;

            $cod="select COUNT(*) from cita where MedicoID='$doctor' and year(Fecha)='$ano' and MONTH(Fecha)='$mes'";  
            $result3=mysqli_query($conexion,$cod); 
            while ($row=mysqli_fetch_row($result3)) {  
            $numcita=utf8_encode($row[0]);   
            }
            $ncita=$numcita+1;

            $arr1 = str_split($ncita);
            $tam=sizeof($arr1);

            if($tam==1){
                $codigo=$codigo.'00'.$ncita.$doctor;
            }else{
                if($tam==2){
                    $codigo=$codigo.'0'.$ncita.$doctor;
                }else{
                    $codigo=$codigo.$ncita.$doctor;
                }

            }

            
            $insert="INSERT INTO `cita`(`CitaID`, `Fecha`, `Hora_I`, `Hora_F`, `Asunto`, `EstadoID`, `AreaID`, `MedicoID`, `AlumnoID`,`Codigo`) 
            VALUES ('$nuevo','$fecha','$horai','$horaf','$asunto',1,'$area','$doctor','$alumnoID','$codigo')";  
            $result2=mysqli_query($conexion,$insert);

            $insertAct="INSERT INTO `actividades`(`ActividadID`, `Fecha`, `AccionID`, `AlumnoID`, `CitaID`) 
            VALUES ('$nActividad','$feact',1,'$alumnoID','$nuevo')";  
            $result2=mysqli_query($conexion,$insertAct);




            header("location:confirmado.php?Area=$area&Codigo=$codigo");
        }
    }
    else{
        $cookie_error = 'error';
        $cookie_valuee = 1;
        setcookie($cookie_error, $cookie_valuee);
        header("location:agendar-cita.php?Area=$area");
    } 
    // header("location:agendar-cita.php?Area=$area");
?>