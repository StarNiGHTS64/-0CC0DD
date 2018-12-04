<?php
if(isset($_POST['key'])){
    
    $conn = new mysqli('localhost','root','','mundoyoto');
    
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