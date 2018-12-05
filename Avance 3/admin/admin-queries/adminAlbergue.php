<?php
	if (isset($_POST['key'])) {

		$conn = new mysqli('localhost', 'root', '', 'mundoyoto');
        
        if ($_POST['key'] == 'getRowDataAlbergue') {
            
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  nombre, municipio,direccion FROM Albergue WHERE idAlbergue ='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
                'nombreAlbergue' => $data['nombre'],
				'municipioAlbergue' => $data['municipio'],
                'direccionAlbergue' => $data['direccion'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingDataAlbergue') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT * FROM Albergue LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idAlbergue"].'</td>
                            
                            <td id="nombreAlbergue_'.$data["idAlbergue"].'">'.$data["nombre"].'</td>
                            
                            <td id="municipioAlberge_'.$data["idAlbergue"].'">'.$data["municipio"].'</td>
                            
                            <td id="direccionAlbergue_'.$data["idAlbergue"].'">'.$data["direccion"].'</td>
                            
							<td>


                                <input type="button" style="margin: 3%;"onclick="viewOReditAlbergue('.$data["idAlbergue"].', \'viewAlbergue\')" value="&#128065;" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewOReditAlbergue('.$data["idAlbergue"].', \'editAlbergue\')" value="&#x270E;" class="btn btn-edd">
								
								<input type="button" style="margin-left: 25%;"onclick="deleteRowAlbergue('.$data["idAlbergue"].')" value="&#x2715;" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">

							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('reachedMax');
		}

		$rowID = $conn->real_escape_string($_POST['rowID']);

		if ($_POST['key'] == 'deleteRowAlbergue') {
			$conn->query("DELETE FROM Albergue WHERE idAlbergue='$rowID'");
			exit('¡La fila fue eliminada con éxito!');
		}

		$nombreAlbergue = $conn->real_escape_string($_POST['nombreAlbergue']);
        $municipioAlbergue = $conn->real_escape_string($_POST['municipioAlbergue']);
        $direccionAlbergue = $conn->real_escape_string($_POST['direccionAlbergue']);

		if ($_POST['key'] == 'updateRowAlbergue') {
			$conn->query("UPDATE Albergue SET nombre='$nombreAlbergue', descripcion='$municipioAlbergue', direccionAlbergue='$direccionAlbergue' WHERE idAlbergue='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNewAlbergue') {
			$sql = $conn->query("SELECT idAlbergue, municipio, direccion FROM Albergue WHERE nombre = '$nombreAlbergue' AND municipio = '$municipioAlbergue' AND '$direccionAlbergue'");
			if ($sql->num_rows > 0)
				exit("¡El nombre del albergue ya existe!");
			else {
				$conn->query("INSERT INTO Albergue (nombre, municipio, direccion) 
							VALUES ('$nombreAlbergue', '$municipioAlbergue', '$direccionAlbergue')");
				exit('¡Albergue agregado exitosamente!');
			}
		}
	}
?>