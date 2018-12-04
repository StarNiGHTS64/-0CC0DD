<?php
session_start();


require_once ("../functionalities/util_danny.php");

     $request = $_GET["drop"];
    if($request=="historia"){
        $datos = dispHistoria($_GET['tierra']);
        
    }
    echo $datos; 
    

?>