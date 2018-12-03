<?php
session_start();

require_once("../main/funciones.php");
        
    if (isset($_SESSION['nombre'])) {
        header("location:../main/index.php");
    } else if (isset($_POST['apodo'])) {
        
        $usuario = htmlspecialchars($_POST['apodo']);
        $password = htmlspecialchars($_POST['contrasena']);
        $password_confirm = htmlspecialchars($_POST['contrasena_confirm']);
        echo $usuario, $password, $password_confirm;
        
        $clave = hash('sha256', $password_confirm );
        
        if ($password === $password_confirm && isset($_POST['contrasena']) 
            && $usuario != "" && $password != "" ) {
            
        $conexion = mysqli_connect("localhost","root","","mundoyoto");
        
        // insert command specification 
        $query="INSERT INTO usuario (usuario, contrasena) VALUES ('$usuario', '$clave')";
        // Preparing the statement 
        $conexion->query($query);
        mysqli_close($conexion);
        echo $clave;
        
            header("location:../main/index.php");
        
        } else {
                $error = "Los passwords no coinciden o faltó información";
                include("../header-footer/_header.html");
                include("_registro.html");
                include("../header-footer/_footer.html");
            }
        
    } else {
        $error = "IRRECONOCIBLE";
        include("../header-footer/_header.html");
        include("_registro.html");
        include("../header-footer/_footer.html");
    }





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