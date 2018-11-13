<?php
	if (isset($_POST['key'])) {

		$conn = new mysqli('localhost', 'root', '', 'mundoyotox');

		if ($_POST['key'] == 'getRowData') {
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT nombre, municipio FROM albergue WHERE idAlbergue='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
				'nombre' => $data['nombre'],
				'municipio' => $data['municipio'],
                'direccion' => $data['direccion'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT idAlbergue, nombre FROM albergue LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idAlbergue"].'</td>
							<td idAlbergue="albergue_'.$data["idAlbergue"].'">'.$data["nombre"].'</td>
							<td>
								<input type="button" onclick="viewORedit('.$data["idAlbergue"].', \'edit\')" value="Edit" class="btn btn-primary">
								<input type="button" onclick="viewORedit('.$data["idAlbergue"].', \'view\')" value="View" class="btn">
								<input type="button" onclick="deleteRow('.$data["idAlbergue"].')" value="Delete" class="btn btn-danger">
							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('reachedMax');
		}
        
        $rowID = $conn->real_escape_string($_POST['rowID']);

        if ($_POST['key'] == 'deleteRow') {
			$conn->query("DELETE FROM albergue WHERE idAlbergue='$rowID'");
			exit('The Row Has Been Deleted!');
		}
        
        /*Toma los datos de las variables y las envia en un metodo */
        
		$nombre = $conn->real_escape_string($_POST['nombre']);
		$municipio = $conn->real_escape_string($_POST['municipio']);
        $direccion = $conn->real_escape_string($_POST['direccion']);
		

        
        /*Si el boton de guardar cambios es precionado este modificara los datos de la base de datos*/
        
        if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE albergue SET nombre='$nombre', municipio='$municipio', direccion='$direccion' WHERE idAlbergue='$rowID'");
			exit('success');
		}

        /*Si el boton para agregar un nuevo pais es presionado guarda los datos en la base de datos*/
        
		if ($_POST['key'] == 'addNew') {
			$sql = $conn->query("SELECT idAlbergue FROM albergue WHERE nombre = '$nombre'");
			if ($sql->num_rows > 0)
				exit("albergue With This Name Already Exists!");
			else {
				$conn->query("INSERT INTO albergue (nombre, municipio) 
							VALUES ('$nombre', '$municipio', '$direccion')");
				exit('albergue Has Been Inserted!');
			}
		}
	}
?>