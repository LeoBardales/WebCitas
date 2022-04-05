<?php
     $connection=mysqli_connect('localhost','root','','cita');
     if (!$connection)
                     {
                      die ("Conexion DB fallo" .mysqli_error($connection));
                     }
     $select_db=mysqli_select_db($connection,'cita');
     if (!$select_db)
                    {
                     die ("Seleccion DB fallo" .mysqli_error($connection));
                    }
?> 
