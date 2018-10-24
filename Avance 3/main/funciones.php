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
        
         //Specification of the SQL query
        $query='SELECT usuario FROM `usuario` WHERE usuario = "'.$usuario.
                '" AND contrasena = "'.$contrasena.'"';
         // Query execution; returns identifier of the result group
         
        $results = $conexion->query($query);
         // cycle to explode every line of the results
        while ($row = mysqli_fetch_array($results, MYSQLI_BOTH)) {
                                        // Options: MYSQLI_NUM to use only numeric indexes
                                        //          MYSQLI_ASSOC to use only name (string) indexes
                                        //          MYSQLI_BOTH, to use both

            mysqli_free_result($results);
            disconnect($conexion);
            return $row["usuario"];
        }
        // it releases the associated results
        mysqli_free_result($results);
        disconnect($conexion);
        return false;
    }
    
    function crear_cuenta($usuario, $contrasena) {
        $conexion = connect();
        
        // insert command specification 
        $query='INSERT INTO usuario (nombre,contrasena) VALUES (?,?) ';
        // Preparing the statement 
        if (!($statement = $conexion->prepare($query))) {
            disconnect($conexion); 
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        // Binding statement params 
        $usuario = $conexion->real_escape_string($usuario);
        $contrasena = $conexion->real_escape_string($contrasena);
            
        if (!$statement->bind_param("ss", $usuario, $contrasena)) {
            disconnect($conexion); 
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
        }
         // Executing the statement
         if (!$statement->execute()) {
            disconnect($conexion); 
            return false;
          } 
        
        disconnect($conexion);
        return true;
    }
    
    function add_mision($idMision,$nombre, $descripcion){
        $conexion = connect();
        
        $sql = "INSERT INTO tareas(idMision,nombre,descripcion) VALUES ('$idMision','$nombre','$descripcion');";
        
        if(mysqli_query($conexion,$sql)){
            echo "Registro de mision exitosa";
            disconnect($conexion);
            return true;
        }else{
            echo "Error: ".$sql."<br>".mysqli_error($conexion);
            disconnect($conexion);
            return false;
        }
        
        disconnect($conexion);
    }

    function del_mision($idMision){
        $conexion = connect();
        
        $sql = "DELETE FROM tareas WHERE idMision = '$idMision'";
        
        if(mysqli_query($conexion,$sql)){
            echo "Mision Borrada Exitosamente";
            disconnect($conexion);
            return true;
        }else{
            echo "Error: ".$sql."<br>".mysqli_error($conexion);
            disconnect($conexion);
            return false;
        }
        
        disconnect($conexion);
    }

    function add_competencia($idCompetencia,$nombre,$descripcion){
        $conexion = connect();
        
        $sql = "INSERT INTO competencia(idCompetencia,nombre,descripcion) VALUES ('$idCompetencia','$nombre','$descripcion');";
        
        if(mysqli_query($conexion,$sql)){
            echo "Registro de competencia exitosa";
            disconnect($conexion);
            return true;
        }else{
            echo "Error: ".$sql."<br>".mysqli_error($conexion);
            disconnect($conexion);
            return false;
        }
        
        disconnect($conexion);        
    }

    function del_competencia($idCompetencia){
        $conexion = connect();
        
        $sql = "DELETE FROM competencia WHERE idCompetencia = '$idCompetencia'";
        
        if(mysqli_query($conexion,$sql)){
            echo "Competencia Borrada Exitosamente";
            disconnect($conexion);
            return true;
        }else{
            echo "Error: ".$sql."<br>".mysqli_error($conexion);
            disconnect($conexion);
            return false;
        }
        
        disconnect($conexion);
    }

    function del_usuario($usuario){
        $conexion = connect();
        
        $sql = "DELETE FROM usuario WHERE usuario = '$usuario'";
        
        if(mysqli_query($conexion,$sql)){
            echo "Usuario Borrado Exitosamente";
            disconnect($conexion);
            return true;
        }else{
            echo "Error: ".$sql."<br>".mysqli_error($conexion);
            disconnect($conexion);
            return false;
        }
        
        disconnect($conexion);       
    }

?>