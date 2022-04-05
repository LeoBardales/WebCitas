<?php 
$conexion=mysqli_connect('localhost','root','','cita');
$doctor=$_POST['doctor'];
$temp = explode(" ", $doctor);

	$sql="SELECT Hora_I as Hora from cita WHERE Fecha='$temp[1]' and MedicoID= '$temp[0]'";
    $at="SELECT Hora_I,Hora_F from consultoriomedico where MedicoID='$temp[0]'";  
    $result2=mysqli_query($conexion,$at); 
    while ($row=mysqli_fetch_row($result2)) {
        $horai=utf8_encode($row[0]);
        $horaf=utf8_encode($row[1]);
    }
    $temp= explode(":", $horai);
    $horai=$temp[0];
    $temp= explode(":", $horaf);
    $horaf=$temp[0];
    
    $cont=7;
    while($cont < 20){
        if($cont>=$horai && $cont<$horaf){
            $item[$cont]=0;
        }
        else{
            $item[$cont]=1;
        }
        $cont+=1;
    }

	$result=mysqli_query($conexion,$sql);
    
    while ($ver=mysqli_fetch_row($result)) {
		$prue=utf8_encode($ver[0]); 
        
        if($prue == "07:00:00"){
            $item[7]=1;
        }
        if($prue == "08:00:00"){
            $item[8]=1;
        }
        if($prue == "09:00:00"){
            $item[9]=1;
        }
        if($prue == "10:00:00"){
            $item[10]=1;
        }
        if($prue == "11:00:00"){
            $item[11]=1;
        }
        if($prue == "12:00:00"){
            $item[12]=1;
        }
        if($prue == "13:00:00"){
            $item[13]=1;
        }
        if($prue == "14:00:00"){
            $item[14]=1;
        }
        if($prue == "15:00:00"){
            $item[15]=1;
        }
        if($prue == "16:00:00"){
            $item[16]=1;
        }
        if($prue == "17:00:00"){
            $item[17]=1;
        }
        if($prue == "18:00:00"){
            $item[18]=1;
        }
        if($prue == "19:00:00"){
            $item[19]=1;
        }
    }  
    $cadena='';
    if($item[7] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="07:00:00" onclick="horaCita(this)">07:00:00</div></div>';
    }
    if($item[8] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="08:00:00" onclick="horaCita(this)">08:00:00</div></div>';
    }
    if($item[9] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="09:00:00" onclick="horaCita(this)">09:00:00</div></div>';
    }
    if($item[10] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="10:00:00" onclick="horaCita(this)">10:00:00</div></div>';
    }
    if($item[11] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="11:00:00" onclick="horaCita(this)">11:00:00</div></div>';
    }
    if($item[12] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="12:00:00" onclick="horaCita(this)">12:00:00</div></div>';
    }
    if($item[13]== 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="13:00:00" onclick="horaCita(this)">13:00:00</div></div>';
    }
    if($item[14]== 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="14:00:00" onclick="horaCita(this)">14:00:00</div></div>';
    }
    if($item[15] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="15:00:00" onclick="horaCita(this)">15:00:00</div></div>';
    }
    if($item[16] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="16:00:00" onclick="horaCita(this)">16:00:00</div></div>';
    }
    if($item[17] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="17:00:00" onclick="horaCita(this)">17:00:00</div></div>';
    }
    if($item[18] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="18:00:00" onclick="horaCita(this)">18:00:00</div></div>';
    }
    if($item[19] == 0)
    {
        $cadena=$cadena.'<div class="col-3 m-1"><div class="btn btn-outline-primary btn-block" data-value="19:00:00" onclick="horaCita(this)">19:00:00</div></div>';
    }
    
	echo  $cadena;
?>