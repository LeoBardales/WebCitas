<?php require 'template/head.php'; ?>
    <link rel="stylesheet" href="css/home-user.css">
    <title>Inicio</title>
</head>
<body>
<?php include 'template/navStudent.php'; ?>
    <div class="jumbotron">
        <h1>SUDECAD UNAH-VS</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi iusto repellat cum.
            Labore amet laboriosam quos neque saepe sunt. Molestiae fugit est, nostrum optio
            quasi minus consectetur libero quo illum?</p>
    </div>   
    <div class="container-fluid">        
            <div class="row min-vh-100 justify-content-center" style="margin-top: 8rem;">
                <div class="col-2 text-center">
                    <a href="citas.html">
                        <h2>Agendar Cita</h2>
                        <img src="img/cita.png" alt="">
                    </a>
                </div>
                <div class="col-2 text-center">
                    <a href="detalles-cita.php">
                        <h2>Detalles de citas</h2>
                        <img src="img/detalle2.png" alt="">
                    </a>                
                </div>
                <div class="col-2 text-center">
                    <a href="historial.php">
                        <h2>Historial de citas</h2>
                        <img src="img/historial.png" alt="">
                    </a>
                </div>
            </div>
    </div>
    <?php require 'template/bootstrap-scripts.php'?>
</body>
</html>