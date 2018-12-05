<?php
	if (isset($_POST['key'])) {

		$conn = new mysqli('localhost', 'root', '', 'mundoyoto');
        
        if ($_POST['key'] == 'getRowDataNino') {
            
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  nombre, apellidoPaterno, apellidoMaterno, correo FROM nino WHERE idNino ='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
                'nombreNino' => $data['nombre'],
				'aPaternoNino' => $data['apellidoPaterno'],
				'aMaternoNino' => $data['apellidoMaterno'],
				'correoNino     ' => $data['correo'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingDataNino') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT idNino, nombre, apellidoPaterno, apellidoMaterno, correo FROM nino LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idNino"].'</td>
                            
                            <td id="nombreNino_'.$data["idNino"].'">'.$data["nombre"].'</td>
                            
                            <td id="aPaternoNino_'.$data["idNino"].'">'.$data["apellidoPaterno"].'</td>
                            
                            <td id="aMaternoNino_'.$data["idNino"].'">'.$data["apellidoMaterno"].'</td>
                            
							<td id="correoNino_'.$data["idNino"].'">'.$data["correo"].'</td>
                            
							<td>


                                <input type="button" style="margin: 3%;"onclick="viewOReditNino('.$data["idNino"].', \'viewNino\')" value="Ver" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewOReditNino('.$data["idNino"].', \'editNino\')" value="Editar" class="btn btn-edd">
								
								<input type="button" style="margin-left: 25%;"onclick="deleteRowNino('.$data["idNino"].')" value="X" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">

							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('reachedMax');
		}

		$rowID = $conn->real_escape_string($_POST['rowID']);

		if ($_POST['key'] == 'deleteRowNino') {
			$conn->query("DELETE FROM nino WHERE idNino='$rowID'");
			exit('¡La fila fue eliminada con éxito!');
		}

		$nombreNino = $conn->real_escape_string($_POST['nombreNino']);
        $aPaternoNino = $conn->real_escape_string($_POST['aPaternoNino']);
		$aMaternoNino = $conn->real_escape_string($_POST['aMaternoNino']);
		$correoNino = $conn->real_escape_string($_POST['correoNino']);

		if ($_POST['key'] == 'updateRowNino') {
			$conn->query("UPDATE nino SET nombre='$nombreNino', apellidoPaterno='$aPaternoNino', apellidoMaterno='$aMaternoNino', correo ='$correoNino' WHERE idNino='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNewNino') {
			$sql = $conn->query("SELECT idNino, apellidoPaterno, apellidoMaterno FROM nino WHERE nombre = '$nombreNino' AND apellidoPaterno = '$aPaternoNino' AND apellidoMaterno = '$aMaternoNino'");
			if ($sql->num_rows > 0)
				exit("¡El nombre del niño ya existe!");
			else {
				$conn->query("INSERT INTO nino (nombre, apellidoPaterno, apellidoMaterno, correo) 
							VALUES ('$nombreNino', '$aPaternoNino', '$aMaternoNino', '$correoNino')");
				exit('¡Niño Agregado exitosamente!');
			}
		}
	}
?>