<?php
	if (isset($_POST['key'])) {

		$conn = new mysqli('localhost', 'root', '', 'mundoyotox');

		if ($_POST['key'] == 'getRowData') {
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT nombre, descripcion FROM nivel WHERE idNivel='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
				'nombre' => $data['nombre'],
				'descripcion' => $data['descripcion'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT idNivel, nombre FROM nivel LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idNivel"].'</td>
							<td idNivel="nivel_'.$data["idNivel"].'">'.$data["nombre"].'</td>
							<td>
								<input type="button" onclick="viewORedit('.$data["idNivel"].', \'edit\')" value="Editar" class="btn btn-primary">
								<input type="button" onclick="viewORedit('.$data["idNivel"].', \'view\')" value="Consultar" class="btn">
								<input type="button" onclick="deleteRow('.$data["idNivel"].')" value="Eliminar" class="btn btn-danger">
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
			$conn->query("DELETE FROM nivel WHERE idNivel='$rowID'");
			exit('El nivel ha sido eliminado!');
		}
        
        /*Toma los datos de las variables y las envia en un metodo */
        
		$nombre = $conn->real_escape_string($_POST['nombre']);
		$descripcion = $conn->real_escape_string($_POST['descripcion']);
		

        
        /*Si el boton de guardar cambios es precionado este modificara los datos de la base de datos*/
        
        if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE nivel SET nombre='$nombre', descripcion='$descripcion' WHERE idNivel='$rowID'");
			exit('success');
		}

        /*Si el boton para agregar un nuevo pais es presionado guarda los datos en la base de datos*/
        
		if ($_POST['key'] == 'addNew') {
			$sql = $conn->query("SELECT idNivel FROM nivel WHERE nombre = '$nombre'");
			if ($sql->num_rows > 0)
				exit("Ya existe un nivel con este nombre!");
			else {
				$conn->query("INSERT INTO nivel (nombre, descripcion) 
							VALUES ('$nombre', '$descripcion')");
				exit('Se agrego el nivel exitosamente');
			}
		}
	}
?>