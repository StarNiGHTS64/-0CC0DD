<?php

funcion connectDb(){
    
$server = "localhost";
$username = "root";
$password = "";
$dbname = "mundoyoto";

$con=mysqli_connect($servename, $username, $password, $dbname);

if(!$con){
    die("Connection failed: ". mysqli_connect_error()); 
    
}

return $con;
}



funcion_closeDb($mysql){
    mysqli_close($mysql);
    
}



function getGruposCompetenciasbyId($group_id, $atributo_id){
    
    $conn= conectDb(); 
    $sql= "SELECT N.nombre, NC.valor FROM grupos G, ninos N, ninos_competencia NC, ninos_grupos NG, competencia C WHERE G.idClan = NG.idClan AND N.idNino = NG.idNino AND N.idNino = NC.idNino AND C.idCompetencia = NC.idCompetencia 
    AND g.idClan = '".$group_id."' 
    AND c.idCompetencia = '".$atributo_id."'";
    
    $result = mysqli_query($conn, $sql);
    closeDb($conn);
    return $result;
    
}

function getGruposNinosbyId($group_id, $nino_id){
    
    $conn=conectDb();
    $sql="SELECT C.nombre, NC.valor 
    FROM grupos G, ninos N, ninos_competencia NC, ninos_grupos NG, competencia C 
    WHERE G.idClan = NG.idClan 
    AND N.idNino = NG.idNino 
    AND N.idNino = NC.idNino 
    AND C.idCompetencia = NC.idCompetencia 
    AND g.idClan = '".$group_id."' 
    AND N.idNino = '".$nino_id."'";
    
    result=mysqli_query($conn, $sql);
    closeDb($conn);
    return $result;
    
    
}

function getGrupoNinoAtributobyId($group_id, $nino_id, $atributo_id){
    
    $conn=conectDb();
    $sql="SELECT C.nombre, NC.valor 
    FROM grupos G, ninos N, ninos_competencia NC, ninos_grupos NG, competencia C 
    WHERE G.idClan = NG.idClan 
    AND N.idNino = NG.idNino 
    AND N.idNino = NC.idNino 
    AND C.idCompetencia = NC.idCompetencia 
    AND g.idClan = '".$group_id."' 
    AND N.idNino = '".$nino_id."'
    AND C.idCompetencia = '".$atributo_id."'";
    
    result=mysqli_query($conn, $sql);
    closeDb($conn);
    return $result; 
    
}

function updateAtributo($nino_id, $atributo_id, $valor){
    
    $conn=conectoDb();
    $sql = "UPDATE ninos_competencia SET valor=$valor WHERE idNino= '".$nino_id."'
    AND idCompetencia = '".$atributo_id."'";
    
    result=mysqli_query($conn, $sql);
    closeDb($conn);
    return $result; 
    
    
}

function deleteClanbyName($clanName){
    $conn = connectDb();
    
    $sql = "DELETE FROM grupos WHERE nombre = '".$chanName."'";
        
    $result=mysqli:query($conn, $sql);
    
    closeDb($conn);
    
    return $result;
       
}

function createClan ($nombre, $nombreAlbergue, $municipio, $idNivel ){
    
    $conn = conectDb();
    $idClan=uniqid();
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
    
}



?>