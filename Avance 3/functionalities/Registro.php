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
<<<<<<< HEAD
  
  ?>
=======





/*if (isset($_SESSION['nombre'])) {
        header("location:../main/index.php");
        $error = 'USUARIO ya registrado';
    } else if (isset($_POST['nombre'])) {
        
        $conn = mysqli_connect("localhost","root","","mundoyoto");
        
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $aPaterno = $conn->real_escape_string($_POST['aPaterno']);
        $aMaterno = $conn->real_escape_string($_POST['aMaterno']);
        $sexo = $conn->real_escape_string($_POST['sexo']);
        $birth = $conn->real_escape_string($_POST['bday']);
        $email = $conn->real_escape_string($_POST['email']);
        $usuario = $conn->real_escape_string($_POST["usuario"]);
        $contrasena = $conn->real_escape_string($_POST["contrasena"]);
        $contrasena_confirm = $conn->real_escape_string($_POST["contrasena_confirm"]);
        
        echo $nombre, $contrasena, $sexo;
    
        if ($contrasena == $contrasena_confirm) {
                $pass = hash('sha512', $contrasena_confirm);

                            echo $pass;

                $sql = $conn->query("SELECT nombre, correo, apodo, contrasena FROM nino WHERE nombre = '$nombre', correo = '$email', apodo = '$usuario', contrasena = '$pass'");
            
            if ($sql->num_rows > 0)
                exit("¡Usuario ya registrado!");
            else {
                $conn->query("INSERT INTO ninos (nombre, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, correo, urlavatar, apodo, contrasena, rol) VALUES ('$nombre', '$aPaterno', '$aMaterno', '$sexo', '$bday', '$email', 'not' , '$usuario', '$pass', 'nene')");

                $_SESSION['rol'] = 'nene';
                $_SESSION['nombre'] = $usuario;
                $_SESSION['contrasena'] = $pass;
                echo 'TERMINADO';
                include("../main/index.php");
            }
        } else {
            
            $error = 'NEPE POENDEJ';
            
        }
            
    } else {
        $error = "NELPAS";
    }*/
?>
>>>>>>> diego7develop
