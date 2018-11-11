<?php
    require_once("../../main/funciones.php");


    if($_POST["Response"] == "lol"){
        select_all_competencia();
    }

    if($_POST["Response"][2] == "uploadComp"){
        insert_competencia($_POST["Response"][0],$_POST["Response"][1]);
    }

    function insert_competencia($nombreCompetencia,$descripcionCompetencia){
        $con = connect();
        $sql = "INSERT INTO competencia(nombre,descripcion) VALUES ('$nombreCompetencia','$descripcionCompetencia');";
        
        if(mysqli_query($con,$sql)){
            echo "Registro de competencia exitosa";
            disconnect($con);
            return true;
        }else{
            echo "Error: ".$sql."<br>".mysqli_error($conexion);
            disconnect($con);
            return false;
        }
        
        disconnect($con);
    }

    function select_all_competencia(){
        $con = connect();
        $out = '';
        $sql = "SELECT * FROM competencia";
        $result = mysqli_query($con,$sql);
        
        while($row = mysqli_fetch_array($result)){
            $out .= '<option value="'.$row["idCompetencia"].'">'.$row["nombre"].'</option>';
        }
            
        disconnect($con);
        
        echo $out;
        
        return $out;
    }
?>