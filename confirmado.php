<?php
    $area=$_GET["Area"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="voae.ico" type="image/x-icon">
    <title>Confirmado</title>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-sm" style="background: linear-gradient(270deg, rgba(0,44,158,1) 0%, rgba(0,42,92,1) 100%);">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburger">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="hamburger" class="collapse navbar-collapse justify-content-center">
        <div class="navbar-nav">
            <a class="nav-item nav-link active">Confirmacion de cita</a>
        </div>
        </div>
    </nav>
    <div class="container d-flex align-items-center" style="height: 80vh;">
        <div class="d-flex flex-column align-items-center">
                <img src="img/ok.png" style="width: 30%;">
                <h1 class="mt-3">Su cita se ha creado exitosamente!</h1>
        </div>
    </div>
    <script>
        (setTimeout(function(){
            window.location.href = "agendar-cita.php?Area=<?php echo $area ?>";
        }, 2500))();
    </script>
</body>
</html>