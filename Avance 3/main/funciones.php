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
        
         //Specification of the SQL query
        $query='SELECT apodo FROM nino WHERE apodo = "'.$usuario.
                '" AND contrasena = "'.$contrasena.'"';
         // Query execution; returns identifier of the result group
         
        $results = $conexion->query($query);
         // cycle to explode every line of the results
        while ($row = mysqli_fetch_array($results, MYSQLI_BOTH)) {
                                        // Options: MYSQLI_NUM to use only numeric indexes
                                        //          MYSQLI_ASSOC to use only name (string) indexes
                                        //          MYSQLI_BOTH, to use both

            mysqli_free_result($results);
            mysqli_close($conexion);
            return $row['nombre'];
        }
        // it releases the associated results
        mysqli_free_result($results);
        mysqli_close($conexion);
        return false;
    }
    

 

?>