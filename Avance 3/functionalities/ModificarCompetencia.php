<?php
session_start();
require_once ("util_danny.php");
<<<<<<< HEAD
   
    $datos = getGrupodeMaestro($_GET['idMaestro']);
    $data = getEquipodeGrupo($_GET['idEquipo']);
    echo $datos, $data; 
    

/*    $data = getEquipodeGrupo($_GET['idEquipo']);
    echo $data; */
=======

    $request = $_GET["drop"];
    if($request=="grupo"){
        $datos = getGrupodeMaestro($_GET['idMaestro']);
    }else if($request=="equipo"){
        $datos = getEquipodeGrupo($_GET['idGrupo']);
    }else if($request=="nino"){
        $datos= getNinodeEquipo($_GET['idEquipo']);
        
    }else if($request=="competencia"){
        $datos = getCompetencia();
    }

    echo $datos; 
>>>>>>> RamaDanny
?>