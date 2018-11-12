<?php
session_start();
require_once ("util_danny.php");


    $request = $_GET["drop"];
    if($request=="grupo"){
        $datos = getGrupodeMaestro($_GET['idMaestro']);
        
    }else if($request="graphgrupo"){
        $datos=generaGraficaGrupo($_GET['idGrupo']);
        
    
     /*   
    }else if($request=="equipo"){
        $datos = getEquipodeGrupo($_GET['idGrupo']);
        
        
    }else if($request=="nino"){
        $datos= getNinodeEquipo($_GET['idEquipo']);
      */  
    }
    echo $datos; 
    

?>