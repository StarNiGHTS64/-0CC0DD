<?php


    function connect() {
                                //servidor_bd, usuario, passwd, nombre_bd
        $conexion = mysqli_connect("localhost","root","","mundoyoto");
        
        if($conexion == NULL) {
            die("Error al conectarse con la base de datos". mysqli_connect_error());
        }
        
        $conexion->set_charset("utf8");
        return $conexion;
    }
    
    function disconnect($conexion) {
        mysqli_close($conexion);
    }
    
    function login($usuario, $contrasena) {
        $conexion = connect();
        
        $usuario = $conexion->real_escape_string($usuario);
        $contrasena = $conexion->real_escape_string($contrasena);
        
        $hashpass = hash('sha256', $contrasena);
        
        //HARDCODE!!!!!!
        $one = hash('sha256', 'perro');
        $two = hash('sha256', '1234');
        $three = hash('sha256', 'contraseña');
        
       
        
         //Specification of the SQL query
        $query="SELECT usuario FROM `usuario` WHERE usuario = '.$usuario.
                '";
         // Query execution; returns identifier of the result group
         
        $results = $conexion->query($query);
         // cycle to explode every line of the results
        while ($row = mysqli_fetch_array($results, MYSQLI_BOTH)) {
                                        // Options: MYSQLI_NUM to use only numeric indexes
                                        //          MYSQLI_ASSOC to use only name (string) indexes
                                        //          MYSQLI_BOTH, to use both

            if ($hashpass == $one || $hashpass == $two || $hashpass == $three){
                mysqli_free_result($results);
                $_SESSION['usuario'] = $usuario;
                $_SESSION['contrasena'] = $contrasena;
                disconnect($conexion);
                return $row["usuario"];
            }
            
            else {
                mysqli_free_result($results);
                disconnect($conexion);
                return false;
            }
        }
        // it releases the associated results
        mysqli_free_result($results);
        disconnect($conexion);
        return false;
    }
    
    function crear_usuario($usuario, $contrasena) {
        $conexion = connect();
        
        // insert command specification 
        $sql='INSERT INTO usuario (usuario,contrasena) VALUES ("'.$usuario.'","'.$contrasena.'")';
        
        if (mysqli_query($conexion, $sql)) {
            echo 'Registro Exitoso';
            disconnect($conexion);
            return true;
        } else {
            echo 'Error';
            disconnect($conexion);
            return false;
        }
        
        disconnect($conexion);
    }

    

    function agregar_niño ($nombre, $aPaterno, $aMaterno, $sexo, $apodo, $bday, $email, $avatar){
        $conexion = connect();
        
        $sql = 'INSERT INTO ninos (idNino, nombre, apellidoPaterno, apellidoMaterno, sexo, apodo, fechaNacimiento, correo, urlavatar, equipo) VALUES (,"'.$nombre.'","'.$aPaterno.'","'.$aMaterno.'","'.$sexo.'","'.$apodo.'","'.$bday.'","'.$email.'","'.$avatar.'",)';
        
        if (mysqli_query($conexion, $sql)) {
            echo 'Registro Exitoso';
            disconnect($conexion);
            return true;
        } else {
            echo 'Error';
            disconnect($conexion);
            return false;
        }
        
        disconnect($conexion);
    }

?>