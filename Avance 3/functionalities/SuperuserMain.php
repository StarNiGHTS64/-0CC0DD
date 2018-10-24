<?php
    session_start();
    
    require_once("../main/funciones.php");
    require("../main/util.php");
    
    include("../header-footer/_header.html");
    include("_superuserMain.html");

    if(isset($_POST['submit_mision'])){ 
        insert_mission();

    }else if(isset($_POST['delete_mision'])){
        delete_mission_by_id();
        
    }else if(isset($_POST['submit_competencia'])){
        insert_competencia();
        
    }else if(isset($_POST['delete_competencia'])){
        delete_competencia_by_id();
        
    }else if(isset($_POST['delete_usuario'])){
        delete_usuario();
    }






    function insert_mission(){
        $idMision = $_POST['idMision'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion']; 
        
        add_mision($idMision,$nombre,$descripcion);
    }

    function delete_mission_by_id(){
        $idMision = $_POST['idMision'];
        
        del_mision($idMision);
    }

    function insert_competencia(){
        $idCompetencia = $_POST['idCompetencia'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        
        add_competencia($idCompetencia,$nombre,$descripcion);
    }

    function delete_competencia_by_id(){
        $idCompetencia = $_POST['idCompetencia'];
        
        del_competencia($idCompetencia);
    }

    function delete_usuario(){
        $usuario = $_POST['usuario'];
        
        del_usuario($usuario);
    }

?>