<?php

    
   

    function crear_cuenta($usuario, $contrasena) {
        $conexion = mysqli_connect("localhost","root","","mundoyoto");
        
        // insert command specification 
        $query="INSERT INTO usuario (usuario, contrasena) VALUES ('$usuario', hash('sha256', '$contrasena'))";
        // Preparing the statement 
        $results = $conexion->query($query);
        
        echo $results;
        mysqli_close($conexion);
        return true;
    }

 function login($usuario, $contrasena) {
     
        $conexion = mysqli_connect("localhost","root","","mundoyoto");
        
        $usuario = $conexion->real_escape_string($usuario);
        $contrasena = $conexion->real_escape_string($contrasena);
        $clave = hash('sha256', $contrasena);
         //Specification of the SQL query
        $query = $conexion->query("SELECT usuario, rol FROM usuario WHERE usuario = '$usuario' AND contrasena = '$clave'");
        
        if ($query->num_rows > 0) {
            $data = $query->fetch_array();
            $_SESSION['rol'] = $data['rol'];
            $_SESSION['nombre'] = $data['usuario'];
            return true;
        } else 
            return false;
     
     
        mysqli_close($conexion);
        
    }
    

 

?>