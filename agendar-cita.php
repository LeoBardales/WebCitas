<?php
    require('config.php');
    require('cn.php');

    if( isset( $_COOKIE['error']) ){
      $error=$_COOKIE['error'];

      if($error == 1){
        echo '<script type="text/javascript">alert("Lo sentimos. La fecha no puede ser hoy o anterior, intente de nuevo");</script>';
        setcookie('error', 0);
      }
      if($error == 2){
        echo '<script type="text/javascript">alert("Lo sentimos. No realizamos citas los fines de semana, debe selecionar un dia habil");</script>';
        setcookie('error', 0);
      }
    }

    $alumnoID=$_COOKIE['alumnoID'];
    $area=$_GET["Area"];
    $usuarios="select MedicoID,concat(Nombre,' ',Apellido) as Medico from medico where AreaID='$area'";

    $queryUsuarios=("select CONCAT(a.PNombre,' ',a.SNombre,' ',a.PApellido,' ',a.SApellido) as Nombre,a.NCuenta as Cuenta,c.Nombre as Carrera,
    a.Telefono, a.Correo,a.Nacimiento
    from alumno as a 
    inner join carrera as c on c.CarreraID=a.carreraID
    where a.AlumnoID='$alumnoID'");
    $resultUsuarios=mysqli_query($connection,$queryUsuarios) or die (mysqli_error($connection));
    $filausuario=(mysqli_fetch_assoc($resultUsuarios));
    $Nombre=$filausuario['Nombre'];
    $Cuenta=$filausuario['Cuenta'];
    $Carrera=$filausuario['Carrera'];
    $Telefono=$filausuario['Telefono'];
    $Correo=$filausuario['Correo'];
    $Nacimiento=$filausuario['Nacimiento'];


    $queryFecha="select CURDATE() as Fecha, (case month(CURDATE()) when 1 then 'Enero' when 2 then 'Febrero' 
    when 3 then 'Marzo' when 4 then 'Abril' when 5 then 'Mayo' when 6 then 'Junio' 
    when 7 then 'Julio' when 8 then 'Agosto' when 9 then 'Septiembre' when 10 then 'Octubre' 
    when 11 then 'Noviembre' else 'Diciembre' end ) as Mes, year(CURDATE()) as Anio";
    $resultFecha=mysqli_query($connection,$queryFecha) or die (mysqli_error($connection));
    $filaFecha=(mysqli_fetch_assoc($resultFecha));
    $fecha=$filaFecha['Fecha'];
    $mes=$filaFecha['Mes'];
	  $anio=$filaFecha['Anio'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script	src="https://code.jquery.com/jquery-3.3.1.min.js"	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="	crossorigin="anonymous"></script>
    <title>Agendamiento de cita</title>
  </head>
  <style>
    body {
      font-family: 'Karla', sans-serif;
    }
  </style>
  <script>
    var currentSelectedTime = null;
    
    function horaCita(detalleHora){
      const estado = $(detalleHora).hasClass("selected");

      if(estado){
        $(detalleHora).removeClass("bg-primary text-white selected");
        $(detalleHora).addClass("btn-outline-primary");
        document.querySelector("#fieldHora").value = "";
      }
      else{
        $(currentSelectedTime).removeClass("bg-primary text-white selected");
        $(currentSelectedTime).addClass("btn-outline-primary");

        $(detalleHora).removeClass("btn-outline-primary");
        $(detalleHora).addClass("bg-primary text-white selected");
        currentSelectedTime = detalleHora;
        document.querySelector("#fieldHora").value = $(detalleHora).data('value');
      }
    }

    function mostrarFechaHora() {
      const fecha = document.querySelector("#date").value;
      const hora = document.querySelector("#fieldHora").value;
      alert(fecha + " " + hora);
    }
    function actualizar(){
      var ID;
      ID=document.Formulario.doctor[document.Formulario.doctor.selectedIndex].value;
      console.log(ID);
    }
  </script>
  <body>
    <nav class="navbar navbar-dark navbar-expand-sm" style="background: linear-gradient(270deg, rgba(0,44,158,1) 0%, rgba(0,42,92,1) 100%);">
      <div class="container justify-content-center">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="home-student.php">Home</a>
          <a class="nav-item nav-link" href="citas.html">Agendar Cita</a>
          <a class="nav-item nav-link" href="detalles-cita.php">Detalle de Cita</a>
          <a class="nav-item nav-link" href="historial.php">Historial</a>
          <a class="nav-item nav-link" href="index.html">Cerrar Sesion</a>
        </div>
      </div>
    </nav>
    <div class="container">
      <div>
        <a href="citas.html" style="position: absolute; left: 4rem; top: 5rem;">
            <img style="width: 3rem; height: 3rem; " src="img/go-back.png">
        </a>
      </div>
      <h1 class="mb-3 mt-5 text-info text-center">Formulario para la cita</h1>
      <form id="form-cita" class="mt-4"  method="post" action="citainsert.php" name="Formulario">
        <!-- Datos Personales -->  
        <fieldset class="form-group">
          <legend>Datos Personales</legend>
            <div class="form-group row">
              <div class="form-group col-6">
                <label class="form-control-label" for="fullName">Nombre Completo</label>
                <input class="form-control" value= "<?php echo $Nombre?>" name="fullName" type="text" id="fullName" readonly>
              </div>
              
              <div class="form-group col-6">
                <label class="form-control-label" for="cuenta">Numero de Cuenta</label>
                <input class="form-control" value= <?php echo $Cuenta?> name="cuenta" type="text" id="cuenta" pattern="[0-9]{11}" readonly>
              </div>  
            </div>
            
            <div class="form-group row">
              <div class="form-group col-6">
                <label class="form-control-label" for="career">Carrera</label>
                <input class="form-control" value="<?php echo $Carrera?>" readonly>
                <!-- <input class="form-control" name="career" type="text" id="carrera" pattern="[a-zA-Z]+" required> -->
              </div>
              <div class="form-group col-6">
                <label class="form-control-label mr-3" for="phone">Numero de Telefono:</label>
                <input class="form-control" value= <?php echo $Telefono?> name="phone" type="tel" id="phone" pattern="[0-9]{8}" required>
                <!-- <small class="form-text text-muted">Ex: 12345678</small> -->
              </div>
            </div>
            <div class="form-group row">
              <div class="form-group col-6">
                <label class="form-control-label" for="email">Correo Electronico</label>
                <input class="form-control" value= <?php echo $Correo?> name="email" type="email" id="email" placeholder="example@domain.com" readonly>
                <small class="form-text text-muted">Se enviará una confirmacion a este correo</small>
              </div>
              <div class="form-group col-6">
                <label class="form-control-label" for="birthday">Fecha de Nacimiento</label>
                <input class="form-control" value= <?php echo $Nacimiento?> name="birthday" type="date" id="bday" readonly>
              </div>
            </div>
        </fieldset>
        <!-- Datos de la cita -->
        <fieldset class="form-group">
          <legend>Datos de la cita</legend>
            <div class="form-group">
              <label class="form-control-label" for="doctor">Doctor</label>
              <select class="form-control" id="doctor" name="doctor" required>
                <option value="">Elija doctor para la cita</option>
                <?php $resultado=mysqli_query($conexion,$usuarios);
                  while($row=mysqli_fetch_assoc($resultado)){
                  ?>
                    <option value="<?php echo $row['MedicoID']?>"><?php echo $row['Medico']?></option>
                <?php 
                  } 
                ?>
              </select>
            </div>
            <div class="form-group row">
              <div class="form-group col-6">
                <label class="form-control-label" for="date">Dia de la cita</label>
                <input class="form-control" type="date" id="date" required>
              </div>
              <div class="form-group col-6">
                <label class="form-control-label">Seleccione la Hora</label> 
                <div id="Hora" name="Hora" class="row no-gutters">
                  <!-- <select class="form-control" id="Hora" name="Hora" required>
                  </select> </div> -->
                </div>
                <input type="hidden" id="fieldHora">
              </div>
            <div class="form-group" id="asuntoCita">
              <label class="form-control-label" for="asunto">Asunto</label>
              <textarea id="asunto" name="asunto" class="form-control" name="asunto" id="asunto" cols="100" rows="3" required></textarea>
            </div>
            <button id="btn" name="btn" class="btn btn-success btn-block" type="submit">Enviar</button>
        </fieldset>
      </form>
    </div>
    <script src="js/tether.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    // $('#doctor').val(1);
    recargarLista();
    $('#doctor').change(function(){
      console.log($('#doctor').val());
      console.log(document.querySelector("#date").value);
      console.log($('#doctor').val());
      recargarLista();
    });
    $('#date').change(function(){
      console.log(document.querySelector("#date").value);
      console.log($('#doctor').val());
      recargarLista();
    });
    $('#btn').click(function(){
      document.cookie = "fecha=" + encodeURIComponent(document.querySelector("#date").value);
      document.cookie = "doctor=" + encodeURIComponent( $('#doctor').val() );
      document.cookie = "Horai=" + encodeURIComponent( $('#fieldHora').val() );
      document.cookie = "asunto=" + encodeURIComponent( $('#asunto').val() );
      document.cookie = "area=" + encodeURIComponent( "<?php echo $area ?>");
    });
    $('#form-cita').submit(function(){
      const fecha = document.querySelector("#date").value;
      const doctor = $('#doctor').val();
      const Horai = $('#fieldHora').val();
      const asunto = $('#asunto').val();

      if(fecha == '' || doctor == '' || Horai == '' || asunto == ''){
        // alert("Por favor llene o seleccione todos los campos!");
        return false;
      }
      else{
        return true;
      }

    })
  });
</script>

<script type="text/javascript">
  function recargarLista(){
    const fecha = document.querySelector("#date").value;
    if(fecha=='' || $('#doctor').val() == "")
    {
      console.log("Debe selecionar una fecha");
    }
    else{
      $.ajax({
        type:"POST",
        url:"horas.php",
        data:"doctor=" + $('#doctor').val() +" " + document.querySelector("#date").value,
        success:function(r){
          $('#Hora').html(r);
        }
      });
    }
  }
</script>


<script type="text/javascript">
  function insert(){
    $.ajax({
      type:"POST",
      url:"citainsert.php",
      data:"datos="+ $('#doctor').val() +" "+ document.querySelector("#date").value+" "+<?php echo $area?>+" "+
      <?php echo $alumnoID ?>+" "+$('#Hora').val()+" "+$('#asunto').val(),
      success:function(e){
        $('#Prueba').html(e);
      }
    });
  }
</script>