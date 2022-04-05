<?php
    require('config.php');
    $areaID=$_COOKIE['areaID'];

    $queryNArea="select Area from Area where AreaID='$areaID'";
    $resultNArea=mysqli_query($connection,$queryNArea) or die (mysqli_error($connection));
    $filaNArea=(mysqli_fetch_assoc($resultNArea));
    $NArea=$filaNArea['Area'];
?>
<?php require 'template/head.php'; ?>
        <link rel="stylesheet" href="css/home-doctor.css">
        <title>Inicio</title>
    </head>
    <body>
    <?php include 'template/nav.php'; ?>
        <div class="jumbotron">
            <h1>SUDECAD UNAH-VS</h1>
            <?php echo '<h2> Departamento de '.$NArea.'</h2>'?>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                Pariatur reiciendis amet vel natus libero distinctio quam 
                doloremque quae aspernatur aperiam tenetur hic dicta molestias 
                repellat unde rerum optio qui sint sit consectetur, perferendis 
                nam minus, culpa in! Repellat quod corporis sapiente nisi sint, 
                ad iure impedit molestias beatae aut eveniet.</p>
        </div> 
        <div class="container-fluid d-flex flex-column align-items-center" style="margin-top: 8rem;">
            <a href="reportes-doctor.php" class="cita-link">
                <div class="opcion">
                    <img src="img/reportes.png" alt="">
                    <p>Reportes</p>
                </div>
            </a>
        </div>
        <?php require 'template/bootstrap-scripts.php'?>
    </body>
</html>