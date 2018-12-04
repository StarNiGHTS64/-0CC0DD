<?php
session_start();

require_once("../main/funciones.php");
        
    if (isset($_SESSION['nombre'])) {

        header("location:../main/index.php");
    } else if (isset($_POST['contrasena']) && isset($_POST['contrasena_confirm'])) {
        
        $conexion = mysqli_connect("localhost","root","","mundoyoto");
        
        $password = htmlspecialchars($_POST['contrasena']);
        $password_confirm = htmlspecialchars($_POST['contrasena_confirm']);
        $clave = hash('sha256', $password_confirm );
        
        
        $apodo = $conexion->real_escape_string($_POST['apodo']);
        
        
        if ($password === $password_confirm && isset($_POST['contrasena']) && $apodo != "" && $password != "") {

            $consulta = $conexion->query("SELECT usuario FROM usuario WHERE rol = 'nene' AND usuario = '$apodo'");
                
           /* if (isset($_POST['nombre']))
                $nombre = $conexion->htmlspecialchars($_POST['nombre']);
            if (isset($_POST['aPaterno']))
                $aPaterno = $conexion->htmlspecialchars($_POST['aPaterno']);
            if (isset($_POST['aMaterno']))
                $aMaterno = $conexion->htmlspecialchars($_POST['aMaterno']);
            if (isset($_POST['email']))
                $email = $conexion->htmlspecialchars($_POST['email']);
            */
            
            
            
            if($consulta->num_rows > 0){
                $error = 'USUARIO YA REGISTRADO. SELECCIONA OTRO NOMBRE DE HEROE';
                include("../header-footer/_header.html");
                include("_registro.html");
                include("../header-footer/_footer.html");
            }
                    
            else {
            // insert command specification 
                $query= $conexion->query("INSERT INTO usuario (usuario, contrasena, rol) VALUES ('$apodo', '$clave', 'nene')");
                
            
                
                //$query2 = $conexion->query("INSERT INTO nino (nombre, apellidoPaterno, apellidoMaterno, correo, apodo, contrasena, rol) VALUES ('$nombre', '$aPaterno', '$aMaterno', '$email', '$apodo', '$clave', 'nene')");

                mysqli_close($conexion);

                header("location:../main/index.php");
            }

        } else {
            $error = 'FALTA INFORMACIÓN!!';
            include("../header-footer/_header.html");
            include("_registro.html");
            include("../header-footer/_footer.html");
        }
        
               
    } else {
        
        include("../header-footer/_header.html");
        include("_registro.html");
        include("../header-footer/_footer.html");
    }
  ?>

