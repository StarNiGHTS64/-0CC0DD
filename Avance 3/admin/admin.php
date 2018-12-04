<?php
	if (isset($_POST['key'])) {

		$conn = new mysqli('localhost', 'root', '', 'mundoyoto');
        
        ///////////////////////// BEGIN NIÑOS  ////////////////////////////////////////////////////////////
        
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
        
        /////////////////////////////  END NINOS  /////////////////////////////////////////////////////////////////////////////////
        
        /////////////////////////////  BEGIN NIVELES /////////////////////////////////////////////////////////////////////////////////
        
        
        if ($_POST['key'] == 'getRowData') {
            
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  tierra, titulo, autor, descripcion FROM historia WHERE idHistoria ='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
                'tierra' => $data['tierra'],
				'titulo' => $data['titulo'],
				'autor' => $data['autor'],
				'descripcion' => $data['descripcion'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT idHistoria, tierra, titulo FROM historia LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idHistoria"].'</td>
                            
                            <td id="tierra_'.$data["idHistoria"].'">'.$data["tierra"].'</td>
                            
							<td id="titulo_'.$data["idHistoria"].'">'.$data["titulo"].'</td>
                            
							<td>


                                <input type="button" style="margin: 3%;"onclick="viewORedit('.$data["idHistoria"].', \'view\')" value="Ver" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewORedit('.$data["idHistoria"].', \'edit\')" value="Editar" class="btn btn-edd">
								
								<input type="button" style="margin-left: 25%;"onclick="deleteRow('.$data["idHistoria"].')" value="X" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">

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
			$conn->query("DELETE FROM historia WHERE idHistoria='$rowID'");
			exit('¡La fila fue eliminada con éxito!');
		}

		$titulo = $conn->real_escape_string($_POST['titulo']);
        $tierra = $conn->real_escape_string($_POST['tierra']);
		$autor = $conn->real_escape_string($_POST['autor']);
		$descripcion = $conn->real_escape_string($_POST['descripcion']);

		if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE historia SET tierra='$tierra', titulo='$titulo', autor='$autor', fechaPublicacion=NOW(), descripcion ='$descripcion' WHERE idHistoria='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNew') {
			$sql = $conn->query("SELECT idHistoria FROM historia WHERE titulo = '$titulo'");
			if ($sql->num_rows > 0)
				exit("¡El nombre de la historia ya existe!");
			else {
				$conn->query("INSERT INTO historia (tierra, titulo, autor, fechaPublicacion, descripcion) 
							VALUES ('$tierra', '$titulo', '$autor', NOW(), '$descripcion')");
				exit('¡Historia publicada con éito!');
			}
		}
        ///////////////////////////  END NIVELES  ////////////////////////////////////////////////////
        
        ///////////////////////////  BEGIN PLANESTUDIOS  ////////////////////////////////////////////////////
        
        if ($_POST['key'] == 'getRowData') {
            
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  tierra, titulo, autor, descripcion FROM historia WHERE idHistoria ='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
                'tierra' => $data['tierra'],
				'titulo' => $data['titulo'],
				'autor' => $data['autor'],
				'descripcion' => $data['descripcion'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT idHistoria, tierra, titulo FROM historia LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idHistoria"].'</td>
                            
                            <td id="tierra_'.$data["idHistoria"].'">'.$data["tierra"].'</td>
                            
							<td id="titulo_'.$data["idHistoria"].'">'.$data["titulo"].'</td>
                            
							<td>


                                <input type="button" style="margin: 3%;"onclick="viewORedit('.$data["idHistoria"].', \'view\')" value="Ver" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewORedit('.$data["idHistoria"].', \'edit\')" value="Editar" class="btn btn-edd">
								
								<input type="button" style="margin-left: 25%;"onclick="deleteRow('.$data["idHistoria"].')" value="X" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">

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
			$conn->query("DELETE FROM historia WHERE idHistoria='$rowID'");
			exit('¡La fila fue eliminada con éxito!');
		}

		$titulo = $conn->real_escape_string($_POST['titulo']);
        $tierra = $conn->real_escape_string($_POST['tierra']);
		$autor = $conn->real_escape_string($_POST['autor']);
		$descripcion = $conn->real_escape_string($_POST['descripcion']);

		if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE historia SET tierra='$tierra', titulo='$titulo', autor='$autor', fechaPublicacion=NOW(), descripcion ='$descripcion' WHERE idHistoria='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNew') {
			$sql = $conn->query("SELECT idHistoria FROM historia WHERE titulo = '$titulo'");
			if ($sql->num_rows > 0)
				exit("¡El nombre de la historia ya existe!");
			else {
				$conn->query("INSERT INTO historia (tierra, titulo, autor, fechaPublicacion, descripcion) 
							VALUES ('$tierra', '$titulo', '$autor', NOW(), '$descripcion')");
				exit('¡Historia publicada con éito!');
			}
		}
        
        //////////////////////////////////  END PLAN ESTUDIOS  /////////////////////////////////////////////////////////////////////
        
        //////////////////////////////////  BEGIN REPORTES/////////////////////////////////////////////////////////////////////
        
        if ($_POST['key'] == 'getRowData') {
            
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  tierra, titulo, autor, descripcion FROM historia WHERE idHistoria ='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
                'tierra' => $data['tierra'],
				'titulo' => $data['titulo'],
				'autor' => $data['autor'],
				'descripcion' => $data['descripcion'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT idHistoria, tierra, titulo FROM historia LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idHistoria"].'</td>
                            
                            <td id="tierra_'.$data["idHistoria"].'">'.$data["tierra"].'</td>
                            
							<td id="titulo_'.$data["idHistoria"].'">'.$data["titulo"].'</td>
                            
							<td>


                                <input type="button" style="margin: 3%;"onclick="viewORedit('.$data["idHistoria"].', \'view\')" value="Ver" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewORedit('.$data["idHistoria"].', \'edit\')" value="Editar" class="btn btn-edd">
								
								<input type="button" style="margin-left: 25%;"onclick="deleteRow('.$data["idHistoria"].')" value="X" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">

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
			$conn->query("DELETE FROM historia WHERE idHistoria='$rowID'");
			exit('¡La fila fue eliminada con éxito!');
		}

		$titulo = $conn->real_escape_string($_POST['titulo']);
        $tierra = $conn->real_escape_string($_POST['tierra']);
		$autor = $conn->real_escape_string($_POST['autor']);
		$descripcion = $conn->real_escape_string($_POST['descripcion']);

		if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE historia SET tierra='$tierra', titulo='$titulo', autor='$autor', fechaPublicacion=NOW(), descripcion ='$descripcion' WHERE idHistoria='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNew') {
			$sql = $conn->query("SELECT idHistoria FROM historia WHERE titulo = '$titulo'");
			if ($sql->num_rows > 0)
				exit("¡El nombre de la historia ya existe!");
			else {
				$conn->query("INSERT INTO historia (tierra, titulo, autor, fechaPublicacion, descripcion) 
							VALUES ('$tierra', '$titulo', '$autor', NOW(), '$descripcion')");
				exit('¡Historia publicada con éito!');
			}
		}
        
        ///////////////////////////////  END REPORTES ////////////////////////////////////////////////////////////////////////
        
        ///////////////////////////////  BEGIN TAREAS  ////////////////////////////////////////////////////////////////////////
        
        if ($_POST['key'] == 'getRowData') {
            
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  tierra, titulo, autor, descripcion FROM historia WHERE idHistoria ='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
                'tierra' => $data['tierra'],
				'titulo' => $data['titulo'],
				'autor' => $data['autor'],
				'descripcion' => $data['descripcion'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT idHistoria, tierra, titulo FROM historia LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idHistoria"].'</td>
                            
                            <td id="tierra_'.$data["idHistoria"].'">'.$data["tierra"].'</td>
                            
							<td id="titulo_'.$data["idHistoria"].'">'.$data["titulo"].'</td>
                            
							<td>


                                <input type="button" style="margin: 3%;"onclick="viewORedit('.$data["idHistoria"].', \'view\')" value="Ver" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewORedit('.$data["idHistoria"].', \'edit\')" value="Editar" class="btn btn-edd">
								
								<input type="button" style="margin-left: 25%;"onclick="deleteRow('.$data["idHistoria"].')" value="X" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">

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
			$conn->query("DELETE FROM historia WHERE idHistoria='$rowID'");
			exit('¡La fila fue eliminada con éxito!');
		}

		$titulo = $conn->real_escape_string($_POST['titulo']);
        $tierra = $conn->real_escape_string($_POST['tierra']);
		$autor = $conn->real_escape_string($_POST['autor']);
		$descripcion = $conn->real_escape_string($_POST['descripcion']);

		if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE historia SET tierra='$tierra', titulo='$titulo', autor='$autor', fechaPublicacion=NOW(), descripcion ='$descripcion' WHERE idHistoria='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNew') {
			$sql = $conn->query("SELECT idHistoria FROM historia WHERE titulo = '$titulo'");
			if ($sql->num_rows > 0)
				exit("¡El nombre de la historia ya existe!");
			else {
				$conn->query("INSERT INTO historia (tierra, titulo, autor, fechaPublicacion, descripcion) 
							VALUES ('$tierra', '$titulo', '$autor', NOW(), '$descripcion')");
				exit('¡Historia publicada con éito!');
			}
		}
        
        //////////////////////////////////  END TAREAS /////////////////////////////////////////////////////////////////////
        
        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        
        if ($_POST['key'] == 'getRowData') {
            
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT  tierra, titulo, autor, descripcion FROM historia WHERE idHistoria ='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
                'tierra' => $data['tierra'],
				'titulo' => $data['titulo'],
				'autor' => $data['autor'],
				'descripcion' => $data['descripcion'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT idHistoria, tierra, titulo FROM historia LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["idHistoria"].'</td>
                            
                            <td id="tierra_'.$data["idHistoria"].'">'.$data["tierra"].'</td>
                            
							<td id="titulo_'.$data["idHistoria"].'">'.$data["titulo"].'</td>
                            
							<td>


                                <input type="button" style="margin: 3%;"onclick="viewORedit('.$data["idHistoria"].', \'view\')" value="Ver" class="btn btn-yass">
                                
								<input type="button"  style="margin: 3%;" onclick="viewORedit('.$data["idHistoria"].', \'edit\')" value="Editar" class="btn btn-edd">
								
								<input type="button" style="margin-left: 25%;"onclick="deleteRow('.$data["idHistoria"].')" value="X" class="btn btn-danger ttip" data-toggle="tooltip" data-placement="right" title="Eliminar">

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
			$conn->query("DELETE FROM historia WHERE idHistoria='$rowID'");
			exit('¡La fila fue eliminada con éxito!');
		}

		$titulo = $conn->real_escape_string($_POST['titulo']);
        $tierra = $conn->real_escape_string($_POST['tierra']);
		$autor = $conn->real_escape_string($_POST['autor']);
		$descripcion = $conn->real_escape_string($_POST['descripcion']);

		if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE historia SET tierra='$tierra', titulo='$titulo', autor='$autor', fechaPublicacion=NOW(), descripcion ='$descripcion' WHERE idHistoria='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNew') {
			$sql = $conn->query("SELECT idHistoria FROM historia WHERE titulo = '$titulo'");
			if ($sql->num_rows > 0)
				exit("¡El nombre de la historia ya existe!");
			else {
				$conn->query("INSERT INTO historia (tierra, titulo, autor, fechaPublicacion, descripcion) 
							VALUES ('$tierra', '$titulo', '$autor', NOW(), '$descripcion')");
				exit('¡Historia publicada con éito!');
			}
		}
        
	}
?>