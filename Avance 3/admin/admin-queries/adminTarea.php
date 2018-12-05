<?php
    if (isset($_POST['key'])) {

		$conn = new mysqli('localhost', 'root', '', 'mundoyoto');
        
        if ($_POST['key'] == 'getRowDataTarea') {
            
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  nombre, municipio,direccion FROM Tarea WHERE idTarea ='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
                'nombreTarea' => $data['nombreTarea'],
				'descripcionTarea' => $data['descripcionTarea'],
                'nombreCompetencia' => $data['nombreCompetencia'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingDataTarea') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT tarea.idTarea, tarea.nombre AS nombreTarea, tarea.descripcion, competencia.nombre AS nombreCompetencia FROM competencia INNER JOIN tarea LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idTarea"].'</td>
                            
                            <td id="nombreTarea_'.$data["idTarea"].'">'.$data["nombreTarea"].'</td>
                            
                            <td id="descripcionTarea_'.$data["idTarea"].'">'.$data["descripcion"].'</td>
                            
                            <td id="nombreCompetencia_'.$data["idTarea"].'">'.$data["nombreCompetencia"].'</td>
                            
							<td>


                                <input type="button" style="margin: 3%;"onclick="viewOReditTarea('.$data["idTarea"].', \'viewTarea\')" value="Ver" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewOReditTarea('.$data["idTarea"].', \'editTarea\')" value="Editar" class="btn btn-edd">
								
								<input type="button" style="margin-left: 25%;"onclick="deleteRowTarea('.$data["idTarea"].')" value="X" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">

							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('reachedMax');
		}

		$rowID = $conn->real_escape_string($_POST['rowID']);

		if ($_POST['key'] == 'deleteRowTarea') {
			$conn->query("DELETE FROM Tarea WHERE idTarea='$rowID'");
			exit('¡La fila fue eliminada con éxito!');
		}

		$nombreTarea = $conn->real_escape_string($_POST['nombreTarea']);
        $descripcion = $conn->real_escape_string($_POST['descripcionTarea']);
        $idCompetencia = $conn->real_escape_string($_POST['competenciaTarea']);

		if ($_POST['key'] == 'updateRowTarea') {
			$conn->query("UPDATE tarea SET nombre='$nombreTarea', descripcion='$descripcionTarea', idCompetencia='$direccionTarea' WHERE idTarea='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNewTarea') {
			$sql = $conn->query("SELECT idTarea, municipio, direccion FROM Tarea WHERE nombre = '$nombreTarea' AND municipio = '$municipioTarea' AND '$direccionTarea'");
			if ($sql->num_rows > 0)
				exit("¡El nombre del Tarea ya existe!");
			else {
				$conn->query("INSERT INTO Tarea (nombre, municipio, direccion) 
							VALUES ('$nombreTarea', '$municipioTarea', '$direccionTarea')");
				exit('¡Tarea agregado exitosamente!');
			}
		}
        
        if($_POST['key'] == 'updateSelect'){
            
            $sql = $conn->query("SELECT nombre FROM competencia WHERE 1");
			
            if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '<option value="'.$data["nombre"].'">'.$data["nombre"].'</option>';
				}
				exit($response);
			} 
        }
	}
?>
