<?php
session_start();
require_once ("util_danny.php");



    $request = $_GET["drop"];
    if($request=="grupo"){
        $datos = getGrupodeMaestro($_GET['idMaestro']);
    }else if($request=="equipo"){
        $datos = getEquipodeGrupo($_GET['idGrupo']);
    }else if($request=="nino"){
        $datos= getNinodeEquipo($_GET['idEquipo']);
        
    }else if($request=="competencia"){
        $datos = getCompetencia();
    }else if ($request="tablaNino"){
        $datos=getCompetenciaValordeNino($_GET['idNino']);  
    }else id($request="tablaComp"){
        $datos = getNinoValordeCompetencia($_GET['idEquipo'], $_GET['idCompetencia']); 
    }




    echo $datos; 
    

?>