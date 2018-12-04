<?php
    require_once("../../main/funciones.php");


    if($_POST["Response"] == "competencia-view"){
        query_all_competencia();
    }

    if($_POST["Response"][1] == "competencia-delete"){
        delete_competencia($_POST["Response"][0]);
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

    function delete_competencia($idCompetencia){
        
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

    function query_all_competencia(){
        $con = connect();
        $out = '';

        $sql = "SELECT * FROM competencia";
        $result = mysqli_query($con,$sql);

        while($row = mysqli_fetch_array($result)){
            $out .='<tr><td>'.$row["idCompetencia"].'</td><td>'.$row["nombre"].'</td><td>'.$row["descripcion"].'</td><td>
                                    
                                <input type="button" style="margin: 3%;"onclick="viewORedit('.$row["idCompetencia"].', \'view\')" value="Ver" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewORedit('.$row["idCompetencia"].', \'edit\')" value="Editar" class="btn btn-edd">
								
								<input type="button" style="margin-left: 20%;"onclick="deleteRow('.$row["idCompetencia"].')" value="X" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">
                                
                                </td></tr>';
        }

        disconnect($con);

        echo $out;

        return $out;
    }
?>