<?php
    session_start();
    
    require_once("../main/funciones.php");
    require("../main/util.php");
    
    include("../header-footer/_header.html");
    include("_superuserMain.html");
    include("../header-footer/_footer.html");

    insert_mission();


    function insert_mission(){
        $idMision = $_POST['idMision'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        
        echo $idMision;
        echo $nombre;
        echo $descripcion;
        
        add_mision($idMision,$nombre,$descripcion);
    }
?>