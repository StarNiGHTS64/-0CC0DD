<?php
    require_once("../../main/funciones.php");
    
    if($_POST["Response"]=="lol"){
        query_all_tarea();
    }else if($_POST["Response"][1] == "deleteTar"){
        delete_tarea($_POST["Response"][0]);
    }else if($_POST["Response"][3]=="uploadTar"){
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


    function query_all_tarea(){
        $con = connect();
        
        $out = '';
        
        $sql = "SELECT * FROM tarea";
        $result = mysqli_query($con,$sql);
        
        
        $out .= '<table><tr><th>Tarea:</th><th>Descripcion:</th><th>Competencia que se esta evaluando:</th><th>Opciones</th></tr>';
        
        
        while($row = mysqli_fetch_array($result)){
            $out .='<tr>
                        <td>'.$row["nombre"].'</td>
                        <td>'.$row["descripcion"].'</td>
                        <td>'.$row["idCompetencia"].'</td>
                        <td>
                            <input type="button" name='.$row["idTarea"].' class="something1" value="Editar">
                            <input type="button" name='.$row["idTarea"].' class="something2" value="Borrar">
                        </td>
                    </tr>';
        }
        
        disconnect($con);
        
        $out.='</table>';
        
        echo $out;
        
        return $out;
    }

    function delete_tarea($idTarea){
        $con = connect();

        $sql = "DELETE FROM tarea WHERE idTarea = $idTarea;";
        
        if(mysqli_query($con,$sql)){
            echo "Tarea borrada exitosamente";
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