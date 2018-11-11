<?php
    require_once("../../main/funciones.php");
    
    if($_POST["Response"][2]=="uploadTar"){
        insert_tarea($_POST["Response"][0],$_POST["Response"][1]);
    }

    function insert_tarea($nombreTarea,$descripcionTarea){
        $con = connect();
        $sql = "INSERT INTO tarea(nombre,descripcion) VALUES ('$nombreTarea','$descripcionTarea');";
        
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