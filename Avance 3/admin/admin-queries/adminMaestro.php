<?php
if(isset($_POST['key'])){
    
    $conn = new mysqli('localhost','root','','mundoyoto');
    
    if ($_POST['key'] == 'getRowDataMtro') {
            
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  nombre, apellidoPaterno, apellidoMaterno, correo, contrasena FROM maestro WHERE idMaestro ='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
                'nombreMtro' => $data['nombre'],
				'aPaternoMtro' => $data['apellidoPaterno'],
				'aMaternoMtro' => $data['apellidoMaterno'],
				'correoMtro' => $data['correo'],
				'contrasenaMtro' => $data['contrasena'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingDataMtro') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT idMaestro, nombre, apellidoPaterno, apellidoMaterno, correo, contrasena FROM maestro LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
                    $pwd = hash('sha256', $data["contrasena"]);
					$response .= '
						<tr>
							<td>'.$data["idMaestro"].'</td>
                            
                            <td id="nombreMtro_'.$data["idMaestro"].'">'.$data["nombre"].'</td>
                            
							<td id="aPaternoMtro_'.$data["idMaestro"].'">'.$data["apellidoPaterno"].'</td>
                            
							<td id="aMaternoMtro_'.$data["idMaestro"].'">'.$data["apellidoMaterno"].'</td>
                            
                            <td id="correoMtro_'.$data["idMaestro"].'">'.$data["correo"].'</td>
                            
                            <td id="contrasenaMtro_'.$data["idMaestro"].'">'.$pwd.'</td>
                            
                            
							<td>


                                <input type="button" style="margin: 3%;"onclick="viewOReditMtro('.$data["idMaestro"].', \'viewMtro\')" value="Ver" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewOReditMtro('.$data["idMaestro"].', \'editMtro\')" value="Editar" class="btn btn-edd">
								
								<input type="button" style="margin-left: 25%;"onclick="deleteRowMtro('.$data["idMaestro"].')" value="X" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">

							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('reachedMax');
		}

		$rowID = $conn->real_escape_string($_POST['rowID']);

		if ($_POST['key'] == 'deleteRowMtro') {
			$conn->query("DELETE FROM maestro WHERE idMaestro='$rowID'");
			exit('¡La fila fue eliminada con éxito!');
		}

		$nombre = $conn->real_escape_string($_POST['nombreMtro']);
        $aPaterno = $conn->real_escape_string($_POST['aPaternoMtro']);
		$aMaterno = $conn->real_escape_string($_POST['aMaternoMtro']);
		$correo = $conn->real_escape_string($_POST['correoMtro']);
		$contrasena = $conn->real_escape_string($_POST['contrasenaMtro']);
    
        $passhash = hash('sha256', $contrasena);

		if ($_POST['key'] == 'updateRowMtro') {
			$conn->query("UPDATE maestro SET nombre='$nombre', apellidoPaterno='$aPaterno', apellidoMaterno='$aMaterno', correo ='$correo', contrasena = '$passhash' WHERE idHistoria='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNewMtro') {
			$sql = $conn->query("SELECT idMaestro FROM maestro WHERE correo = '$correo'");
			if ($sql->num_rows > 0)
				exit("¡El correo ya ha sido registrado para otro profesor!");
			else {
				$conn->query("INSERT INTO maestro (nombre, apellidoPaterno, apellidoMaterno, correo, contrasena, rol) 
							VALUES ('$nombre', '$aPaterno', '$aMaterno', '$correo', '$passhash', 'pro')");
                $conn->query("INSERT INTO usuario (usuario, contrasena, rol) VALUES ('$nombre', '$passhash', 'pro')");
				exit('¡Profesor Registrado con éito!');
			}
		}
    } 
?>