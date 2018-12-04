<?php
session_start();


require_once ("util_danny.php");

     $request = $_GET["drop"];
    if($request=="misiones"){
        $datos = dispMision($_GET['idComp']);
        
    }
    echo $datos; 
    

?>