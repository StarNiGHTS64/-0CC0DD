<?php
session_start();
require_once ("util_danny.php");
   
    $datos = getGrupodeMaestro($_GET['idMaestro']);
    $data = getEquipodeGrupo($_GET['idEquipo']);
    echo $datos, $data; 
    

/*    $data = getEquipodeGrupo($_GET['idEquipo']);
    echo $data; */
?>