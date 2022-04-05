<?php
    require('config.php');
    if (isset($_POST['username']) and isset($_POST['password']))
    {
        $correo=$_POST['username'];
        $password=$_POST['password'];
        //Verificar registros en la tabla
        $query="select * from usuarios where correo='$correo' and password='$password'";
        $result=mysqli_query($connection,$query) or die (mysqli_error($connection));
        $contador=$result->num_rows;
        
        $row=(mysqli_fetch_assoc($result));
        $userID=$row["userID"];
        $userTipo=$row["tipoUsuarioID"];

        if ($contador==1 && $userTipo == 1)
        {
            $query2 ="select a.areaID, m.medicoID from medico as m inner join area as a on m.areaID = a.AreaID where userID='$userID'";
            $result2=mysqli_query($connection,$query2) or die (mysqli_error($connection));
            $row2=(mysqli_fetch_assoc($result2));
            $areaID=$row2["areaID"];
            $medicoID=$row2["medicoID"];

            //Crear una cookie
            $cookie_user = 'userID';
            $cookie_value = $userID;

            $cookie_area = 'areaID';
            $cookie_value2 = $areaID;

            $cookie_medico = 'medicoID';
            $cookie_value3 = $medicoID;

            setcookie($cookie_user, $cookie_value);
            setcookie($cookie_area, $cookie_value2);
            setcookie($cookie_medico, $cookie_value3);
            header("location:home-doctor.php");
        }
        elseif ($contador==1 && $userTipo == 2)
        {   
            $query2 ="SELECT alumnoID FROM alumno where userID='$userID'";
            $result2=mysqli_query($connection,$query2) or die (mysqli_error($connection));
            $row2=(mysqli_fetch_assoc($result2));
            $alumnoID=$row2["alumnoID"];
            //Crear una cookie
            $cookie_user = 'userID';
            $cookie_value = $userID;
            $cookie_alumnoID = 'alumnoID';
            $cookie_value1 = $alumnoID;

            setcookie($cookie_user, $cookie_value);
            setcookie($cookie_alumnoID, $cookie_value1);
            header("location:home-student.php");
        }
        else
        {
            header("location:index.html");
        }
    }
?>
