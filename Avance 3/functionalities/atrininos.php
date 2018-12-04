<?php
session_start();


require_once ("util_danny.php");

     $request = $_GET["drop"];
    if($request=="ninoatributos"){
        $datos = dispnino($_GET['idNino']);
        
    }
    echo $datos; 
    

?>