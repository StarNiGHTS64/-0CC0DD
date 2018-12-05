<?php
session_start();


require_once ("util_danny.php");

     $request = $_GET["drop"];
    if($request=="carritoNinosSinEquipo"){
        $datos = dispNinosNoEquipo();
        
    }
    echo $datos; 
    

?>