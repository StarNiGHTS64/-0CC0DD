<?php
    require_once("../../main/funciones.php");
    
    if($_POST["Response"]=="lol"){
        query_all_tarea();
    }else if($_POST["Response"][1] == "deleteTar"){
        delete_tarea($_POST["Response"][0]);
    }else if($_POST["Response"][1] == "editTar"){
        display_tarea_edit($_POST["Response"][0]);
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
                            <input type="button" name='.$row["idTarea"].' class="something1 modal-trigger" value="Editar" data-target="modal3">
                            <input type="button" name='.$row["idTarea"].' class="something2" value="Borrar">
                        </td>
                    </tr>';
        }
        
        disconnect($con);
        
        $out.='</table>';
        
        echo $out;
        
        return true;
    }

    function delete_tarea($idTarea){
        $con = connect();

        $sql = "DELETE FROM tarea WHERE idTarea = $idTarea;";
        $result = mysqli_query($con,$sql);
        
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


    function display_tarea_edit($idTarea){
        $con = connect();
        
        $out='';

        $sql = "SELECT * FROM tarea WHERE idTarea = $idTarea;";
        
        //$sql2 = "SELECT competencia.nombre FROM competencia INNER JOIN tarea ON competencia.idCompetencia = tarea.idCompetencia;";
        
        $result = mysqli_query($con,$sql);
        //$result2 = mysqli_query($con,$sql2);
        
        $out.='
            <form id="upl-tarea">
                <div class="edit-tarea">
                    <input id="nombre-tarea" type="text" name="nombreTarea" value='.$row["nombre"].'>
                    <label for="nombre-tarea">Nombre de la tarea</label>
                </div>

                <div class="input-field">
                    <textarea id="descripcion-tarea" type="text" class="materialize-textarea" name="descripcionTarea" value='.$row["descripcion"].'></textarea>
                    <label for="descripcion-tarea">Descripción de la tarea</label>
                </div>

                <div class="input-field">
                    <select class="materialSelect browser-default" name="selectCompetencia" id="select-competencia">
                        <option value="'.$row["idCompetencia"].'">Competencia a evaluar</option>   
                        <div id="update-comp-select"></div>
                    </select>
                </div>
                <button class="btn waves-effect waves-light black" type="submit" name="subir-tarea">Subir Tarea
                    <i class="material-icons right">send</i>
                </button>
            </form>';
        
        disconnect($con);
        
        echo $out;
        
        return true;
        
    }
?>