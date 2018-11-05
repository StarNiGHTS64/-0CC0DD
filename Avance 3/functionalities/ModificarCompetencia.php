<?php
session_start();
require_once ("util_danny.php");
   
    $datos = getGrupodeMaestro($_GET['idMaestro']);
    echo $datos; 
?>