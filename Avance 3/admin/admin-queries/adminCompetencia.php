<?php
	if (isset($_POST['key'])) {

		$conn = new mysqli('localhost', 'root', '', 'mundoyoto');
        
        if ($_POST['key'] == 'getRowDataCompetencia') {
            
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  nombre, descripcion FROM competencia WHERE idCompetencia ='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
                'nombreCompetencia' => $data['nombre'],
				'descripcionCompetencia' => $data['descripcion'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingDataCompetencia') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT * FROM competencia LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idCompetencia"].'</td>
                            
                            <td id="nombreCompetencia_'.$data["idCompetencia"].'">'.$data["nombre"].'</td>
                            
                            <td id="descripcionCompetencia_'.$data["idCompetencia"].'">'.$data["descripcion"].'</td>
                            
							<td>


                                <input type="button" style="margin: 3%;"onclick="viewOReditCompetencia('.$data["idCompetencia"].', \'viewCompetencia\')" value="&#128065;" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewOReditCompetencia('.$data["idCompetencia"].', \'editCompetencia\')" value="&#x270E;" class="btn btn-edd">
								
								<input type="button" style="margin-left: 25%;"onclick="deleteRowCompetencia('.$data["idCompetencia"].')" value="&#x2715" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">

							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('reachedMax');
		}

		$rowID = $conn->real_escape_string($_POST['rowID']);

		if ($_POST['key'] == 'deleteRowCompetencia') {
			$conn->query("DELETE FROM competencia WHERE idCompetencia='$rowID'");
			exit('¡La fila fue eliminada con éxito!');
		}

		$nombreCompetencia = $conn->real_escape_string($_POST['nombreCompetencia']);
        $descripcionCompetencia = $conn->real_escape_string($_POST['descripcionCompetencia']);

		if ($_POST['key'] == 'updateRowCompetencia') {
			$conn->query("UPDATE competencia SET nombre='$nombreCompetencia', descripcion='$descripcionCompetencia' WHERE idCompetencia='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNewCompetencia') {
			$sql = $conn->query("SELECT idCompetencia, descripcion FROM competencia WHERE nombre = '$nombreCompetencia' AND descripcion = '$descripcionCompetencia'");
			if ($sql->num_rows > 0)
				exit("¡El nombre de la competencia ya existe!");
			else {
				$conn->query("INSERT INTO competencia (nombre, descripcion) 
							VALUES ('$nombreCompetencia', '$descripcionCompetencia')");
				exit('¡Competencia Agregada exitosamente!');
			}
		}
	}
?>