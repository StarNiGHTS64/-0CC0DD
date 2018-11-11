<?php
    require_once("../../main/funciones.php");
    
    if($_POST["Response"][3]=="uploadTar"){
        insert_tarea($_POST["Response"][0],$_POST["Response"][1],$_POST["Response"][2]);
    }

    function insert_tarea($nombreTarea,$descripcionTarea,$idCompetencia){
        $con = connect();
        $sql = "INSERT INTO tarea(nombre,descripcion,idCompetencia) VALUES ('$nombreTarea','$descripcionTarea','$idCompetencia');";
        
        if(mysqli_query($con,$sql)){
            echo "Registro de tarea exitosa";
            disconnect($con);
            return true;
        }else{
            echo "Error: ".$sql."<br>".mysqli_error($conexion);
            disconnect($con);
            return false;
        }
        
        disconnect($con);
    }
?>