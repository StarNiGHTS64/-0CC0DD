<?php
    
    function connect() {
                                //servidor_bd, usuario, passwd, nombre_bd
        $conexion = mysqli_connect("localhost","root","","mundoyoto");
        
        if($conexion == NULL) {
            die("Error al conectarse con la base de datos");
        }
        $conexion->set_charset("utf8");
        return $conexion;
    }
    
    function disconnect($conexion) {
        mysqli_close($conexion);
    }
    
    function login($usuario, $password) {
        $conexion = connect();
        
        $usuario = $conexion->real_escape_string($usuario);
        $password = $conexion->real_escape_string($password);
        
         //Specification of the SQL query
        $query='SELECT nombre FROM usuarios WHERE nombre = "'.$usuario.
                '" AND password = "'.$password.'"';
         // Query execution; returns identifier of the result group
         
        $results = $conexion->query($query);
         // cycle to explode every line of the results
        while ($row = mysqli_fetch_array($results, MYSQLI_BOTH)) {
                                        // Options: MYSQLI_NUM to use only numeric indexes
                                        //          MYSQLI_ASSOC to use only name (string) indexes
                                        //          MYSQLI_BOTH, to use both

            mysqli_free_result($results);
            disconnect($conexion);
            return $row["nombre"];
        }
        // it releases the associated results
        mysqli_free_result($results);
        disconnect($conexion);
        return false;
    }
    
    function getConciertos() {
        $conexion = connect();
        
        $tarjetas = '<div class="row">';
        
         //Specification of the SQL query
        $query='SELECT nombre, fecha, lugar, imagen FROM conciertos';
         // Query execution; returns identifier of the result group
         
        $results = $conexion->query($query);
        
         // cycle to explode every line of the results
        while ($row = mysqli_fetch_array($results, MYSQLI_BOTH)) {
            
            $tarjetas .= '<div class="col s12 m4 l4"><div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                  <img class="activator" src="uploads/'.$row["imagen"].'">
                </div>
                <div class="card-content">
                  <span class="card-title activator grey-text text-darken-4">'.$row["nombre"].'<i class="material-icons right">more_vert</i></span>
                  <p><a href="#">'.$row["fecha"].'</a></p>
                </div>
                <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">'.$row["nombre"].'<i class="material-icons right">close</i></span>
                  <p>'.$row["lugar"].'</p>
                </div>
              </div></div>';
        }
        
        $tarjetas .= '</div>';
        // it releases the associated results
        mysqli_free_result($results);
        disconnect($conexion);
        return $tarjetas;
    }
    
    function crear_cuenta($usuario, $password) {
        $conexion = connect();
        
        // insert command specification 
        $query='INSERT INTO usuarios (nombre,password) VALUES (?,?) ';
        // Preparing the statement 
        if (!($statement = $conexion->prepare($query))) {
            disconnect($conexion); 
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        // Binding statement params 
        $usuario = $conexion->real_escape_string($usuario);
        $password = $conexion->real_escape_string($password);
            
        if (!$statement->bind_param("ss", $usuario, $password)) {
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
    
    
    function gerate_select($tabla, $campo_id, $campo_texto) {
        $conexion = connect();
        
        $select = '<div class="input-field col s12">
                    <select>';
        
         //Specification of the SQL query
        $query='SELECT '.$campo_id.','.$campo_texto.' FROM '.$tabla;
         // Query execution; returns identifier of the result group
         
        $results = $conexion->query($query);
        
         // cycle to explode every line of the results
        while ($row = mysqli_fetch_array($results, MYSQLI_BOTH)) {
            
            $select .= '<option value="'.$row["$campo_id"].'">'.
                        $row["$campo_texto"].'</option>';
        }
        
        $select .= '</select>
                    <label>Seleccionar '.$tabla.'</label>
                    </div>';
        // it releases the associated results
        mysqli_free_result($results);
        disconnect($conexion);
        return $select;
    }
    
?>