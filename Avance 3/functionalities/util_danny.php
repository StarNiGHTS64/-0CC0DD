<?php

function connectDb(){
    
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mundodeyoto";

    $con=mysqli_connect($server, $username, $password, $dbname);

    if(!$con){
        die("Connection failed: ". mysqli_connect_error()); 

    }


    return $con;
}



function closeDb($mysql){
    
    mysqli_close($mysql);
    
}



function getGrupodeMaestro($idMaestro){
    $conn = connectDB();
    $sql="SELECT g.nombre, g.idGrupo FROM grupo g, maestro m, grupo_maestro gm WHERE g.idGrupo= gm.idGrupo AND m.idMaestro= gm.idMaestro AND m.idMaestro='".$idMaestro."'";
    $result = mysqli_query($conn,$sql);
    $return =array();
    $i=0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $return[$i]=[
         'idGrupo' => $row["idGrupo"],
         'nombre' => $row["nombre"]
     ];
        $i++;
    }
    
    
    //debug_to_console($linea);
    closeDb($conn);
    return json_encode($return);

}

function getEquipodeGrupo($idGrupo){
    $conn = connectDB();
    $sql="SELECT e.nombre, e.idEquipo FROM equipo e, grupo g, grupo_equipo ge WHERE e.idEquipo=ge.idEquipo AND g.idGrupo=ge.idGrupo and g.idGrupo='".$idGrupo."'";
    $result = mysqli_query($conn,$sql);
    $return =array();
    $i=0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $return[$i]=[
         'idEquipo' => $row["idEquipo"],
         'nombre' => $row["nombre"]
     ];
        $i++;
    }
    
    
    //debug_to_console($linea);
    closeDb($conn);
    return json_encode($return);
}


function getNinodeEquipo($idEquipo){
    $conn = connectDB();
    $sql="SELECT n.idNino, n.nombre FROM equipo e, nino n, nino_equipo ne WHERE e.idEquipo=ne.idEquipo AND ne.idNino = n.idNino AND e.idEquipo='".$idEquipo."'";

    $result = mysqli_query($conn,$sql);
    $return =array();
    $i=0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $return[$i]=[
        
         'idNino' => $row["idNino"],

         'nombre' => $row["nombre"]
     ];
        $i++;
    }
    
    
    //debug_to_console($linea);

    closeDb($conn);
    return json_encode($return);
}





function getCompetencia(){
     $conn = connectDB();
    $sql="SELECT idCompetencia, nombre FROM competencia";
    $result = mysqli_query($conn,$sql);
    $return =array();
    $i=0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $return[$i]=[
         'idCompetencia' => $row["idCompetencia"],
         'nombre' => $row["nombre"]
     ];
        $i++;
    }
    //debug_to_console($linea);
    closeDb($conn);
    return json_encode($return);
    
}

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

function getCompetenciaValordeNino($idNino){
    $conn = connectDB();
    $sql="SELECT c.nombre, nc.valor FROM nino n, competencia c, nino_competencia nc WHERE n.idNino=nc.idNino AND c.idCompetencia=nc.idCompetencia AND n.idNino='".$idNino."'";
    
    $result = mysqli_query($conn,$sql);
    $return =array();
    $i=0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $return[$i]=[
        
         'nombre' => $row["nombre"],

         'valor' => $row["valor"]
     ];
        $i++;
    }
    
    
    //debug_to_console($linea);

    closeDb($conn);
    return json_encode($return);
}

function getNinoValordeCompetencia($idEquipo, $idCompetencia){
    $conn = connectDB();
    $sql="SELECT n.idNino, n.nombre, nc.valor FROM nino n, nino_competencia nc, equipo e, nino_equipo ne, competencia c WHERE n.idNino=ne.idNino AND e.idEquipo=ne.idEquipo AND c.idCompetencia=nc.idCompetencia AND n.idNino=nc.idNino AND e.idEquipo='".$idEquipo."' AND c.idCompetencia='".$idCompetencia."'";
    
    $result = mysqli_query($conn,$sql);
    $return =array();
    $i=0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $return[$i]=[
         
         'idNino' => $row["idNino"],
        
         'nombre' => $row["nombre"],

         'valor' => $row["valor"]
     ];
        $i++;
    }
    
    
    //debug_to_console($linea);

    closeDb($conn);
    return json_encode($return);
}

function modificarCompetencia($idNino, $idCompetencia, $valor){
    $conn=connectDB();
    
    $sql ="UPDATE nino_competencia SET valor='$valor' WHERE idNino= '".$idNino."' AND idCompetencia= '".$idCompetencia."'";
    $result= mysqli_query($conn, $sql);

    closeDb($conn);
    return $sql;
}

function generaGraficaGrupo($idGrupo){
    
    $conn=connectDB();
    $sql="SELECT c.nombre, AVG(valor) as promedio FROM competencia c, nino n, nino_competencia nc, grupo g, nino_grupo ng WHERE n.idNino = ng.idNino AND n.idNino= nc.idNino AND g.idGrupo=ng.idGrupo AND c.idCompetencia=nc.idCompetencia AND g.idGrupo='".$idGrupo."' GROUP BY c.nombre";
    $result=mysqli_query($conn, $sql);
    $return =array();
    $i=0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $return[$i]=[
        
         'nombre' => $row["nombre"],

         'promedio' => $row["promedio"]
     ];
        $i++;
    }
    
    
    //debug_to_console($linea);

    closeDb($conn);
    return json_encode($return);
}

function generaGraficaEquipo($idEquipo){
    
    $conn=connectDB();
    $sql="SELECT c.nombre, AVG(valor) as promedio FROM competencia c, nino n, nino_competencia nc, equipo e, nino_equipo ne WHERE n.idNino = ne.idNino AND n.idNino= nc.idNino AND e.idEquipo=ne.idEquipo AND c.idCompetencia=nc.idCompetencia AND e.idEquipo='".$idEquipo."' GROUP BY c.nombre";
    $result=mysqli_query($conn, $sql);
    $return =array();
    $i=0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $return[$i]=[
        
         'nombre' => $row["nombre"],

         'promedio' => $row["promedio"]
     ];
        $i++;
    }
    
    
    //debug_to_console($linea);

    closeDb($conn);
    return json_encode($return);
}
    
function generaGraficaNino($idNino){
    
    $conn=connectDB();
    $sql="SELECT c.nombre, nc.valor FROM nino n, nino_competencia nc, competencia c WHERE n.idNino=nc.idNino AND c.idCompetencia=nc.idCompetencia AND n.idNino='".$idNino."'";
    $result=mysqli_query($conn, $sql);
    $return =array();
    $i=0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $return[$i]=[
        
         'nombre' => $row["nombre"],

         'valor' => $row["valor"]
     ];
        $i++;
    }
    
    
    //debug_to_console($linea);

    closeDb($conn);
    return json_encode($return);
}


/*function getDropDownGruposdeMaestro(){
    $conn=connectDB();
    $aux=(getGrupodeMaestro(1));
    while($row=mysqli_fetch_array($aux));
    $menu="";
  
}


function getEquipodeGrupo($idGrupo){
    $conn=connectDB();
    $sql="SELECT e.nombre 
    FROM equipo e, grupo g, grupo_equipo ge 
    WHERE e.idEquipo=ge.idEquipo 
    AND g.idGrupo=ge.idGrupo AND g.idGrupo='".$idGrupo."'";
    $result=mysqli_query($conn, $sql);
    closeDb($conn);
=======
    closeDb($conn);
    return json_encode($return);
}
  

function getCompetencia(){
     $conn = connectDB();
    $sql="SELECT idCompetencia, nombre FROM competencia";
    $result = mysqli_query($conn,$sql);
    $return =array();
    $i=0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $return[$i]=[
         'idCompetencia' => $row["idCompetencia"],
         'nombre' => $row["nombre"]
     ];
        $i++;
    }
    //debug_to_console($linea);
    closeDb($conn);
    return json_encode($return);
    
}
  



/*function getDropDownGruposdeMaestro(){
    $conn=connectDB();
    $aux=(getGrupodeMaestro(1));
    while($row=mysqli_fetch_array($aux));
    $menu="";
  
}


function getEquipodeGrupo($idGrupo){
    $conn=connectDB();
    $sql="SELECT e.nombre 
    FROM equipo e, grupo g, grupo_equipo ge 
    WHERE e.idEquipo=ge.idEquipo 
    AND g.idGrupo=ge.idGrupo AND g.idGrupo='".$idGrupo."'";
    $result=mysqli_query($conn, $sql);
    closeDb($conn);
>>>>>>> diego7develop
    return $result;  
    
}

function getNinodeEquipo($idEquipo){
     $conn=connectDB();
    $sql="SELECT n.nombre 
    FROM equipo e, nino n, nino_equipo ne 
    WHERE e.idEquipo=ne.idEquipo 
    AND ne.idNino = n.idNino AND e.idEquipo='".$idEquipo"'";
    $result=mysqli_query($conn, $sql);
    closeDb($conn);
    return $result; 
}

 function getAtributos(){
     
     $conn=connectDB();
     $sql="SELECT nombre FROM competencia WHERE 1";
     
     $result=mysqli_query($conn, $sql);
     closeDb($conn);
     return $result;    
 }

function competenciaNombreValordeidNino($idNino){
    
    $conn=connectDB();
     $sql="SELECT n.nombre, c.nombre, nc.valor 
     FROM nino n, competencia c, nino_competencia nc 
     WHERE n.idNino=nc.idNino AND c.idCompetencia=nc.idCompetencia 
     AND n.idNino='".$idNino"'";
     
     $result=mysqli_query($conn, $sql);
     closeDb($conn);
     return $result;    
}
 
function ninoValordeEquipoCompetencia($idEquipo, $idCompetencia){
    
    $conn=connectDb();
    $sql = "SELECT n.nombre, nc.valor 
    FROM nino n, nino_competencia nc, equipo e, nino_equipo ne, competencia c 
    WHERE n.idNino=ne.idNino AND e.idEquipo=ne.idEquipo 
    AND c.idCompetencia=nc.idCompetencia AND n.idNino=nc.idNino 
    AND e.idEquipo='".$idEquipo."' AND c.idCompetencia='".$idCompetencia."'";
    
    $result=mysqli_query($conn, $sql);
    closeDb($conn);
    return $result; 
    
    
}

function updateAtributo($nino_id, $atributo_id, $valor){
    
    $conn=connectDb();
    $sql = "UPDATE ninos_competencia SET valor=$valor WHERE idNino= '".$nino_id."'
    AND idCompetencia = '".$atributo_id."'";
    
    $result=mysqli_query($conn, $sql);
    closeDb($conn);
    return $result; 
    
    
}

/*function deleteGrupobyName($grupoName){
    $conn = connectDb();
    
    $sql = "DELETE FROM grupos WHERE nombre = '".$chanName."'";
        
    $result=mysqli_query($conn, $sql);
    
    closeDb($conn);
    
    return $result;
       
}

function createClan ($idClan,$nombre, $nombreAlbergue, $municipio){
    
    $conn = connectDb();
    $idClan=uniqid();
    
    $nivelSql = ""
    
    $sql= "INSERT INTO grupos (idClan, nombre, nombreAlbergue, municipio, idNivel) VALUES (\"" . $idClan . "\", \"".$nombre . "\",".$nombreAlbergue . "," . $municipio . ",\"" . $idNivel . "\")";
    
    if(mysqli_query($conn, $sql)) {
        echo "Un nuevo clan ha sido creado";
        closeDb($conn);
        return true;
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        closeDb($conn);
        return false;
        
        
    }
    
    closeDb($conn);
    
}*/



?>