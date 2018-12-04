<?php
	if (isset($_POST['key'])) {

		$conn = new mysqli('localhost', 'root', '', 'personajes');

		if ($_POST['key'] == 'getRowData') {
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT nombrePersonaje, biografia, fuerza, mente, simpatia, magia, cultivos, tecnologia, carisma FROM personaje WHERE id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
				'nombrePersonaje' => $data['nombrePersonaje'],
				'biografia' => $data['biografia'],
				'fuerza' => $data['fuerza'],
                'mente' => $data['mente'],
                'simpatia' => $data['simpatia'],
                'magia' => $data['magia'],
                'cultivos' => $data['cultivos'],
                'tecnologia' => $data['tecnologia'],
                'carisma' => $data['carisma'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') {
			$start = $conn->real_escape_string($_POST['start']);
			$limit = $conn->real_escape_string($_POST['limit']);

			$sql = $conn->query("SELECT id, nombrePersonaje, biografia, img FROM personaje LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["id"].'</td>
							<td id="personaje_'.$data["id"].'">'.$data["nombrePersonaje"].'</td>
                            <td id="personaje_'.$data["id"].'">'.$data["biografia"].'</td>
                            <td id="personaje_'.$data["id"].'"><img style="height:100; width:100;" src="'.$data["img"].'.png "></td>
							<td>
								<input type="button" onclick="viewORedit('.$data["id"].', \'edit\')" value="Edit" class="btn btn-primary">
								<input type="button" onclick="viewORedit('.$data["id"].', \'view\')" value="View" class="btn">
								<input type="button" onclick="deleteRow('.$data["id"].')" value="Delete" class="btn btn-danger">
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
			$conn->query("DELETE FROM personaje WHERE id='$rowID'");
			exit('The Row Has Been Deleted!');
		}
        
        /*Toma los datos de las variables y las envia en un metodo */
        
		$nombrePersonaje = $conn->real_escape_string($_POST['nombrePersonaje']);
		$biografia = $conn->real_escape_string($_POST['biografia']);
		$fuerza = $conn->real_escape_string($_POST['fuerza']);
        $mente = $conn->real_escape_string($_POST['mente']);
		$simpatia = $conn->real_escape_string($_POST['simpatia']);
		$magia = $conn->real_escape_string($_POST['magia']);
        $cultivos = $conn->real_escape_string($_POST['cultivos']);
		$tecnologia = $conn->real_escape_string($_POST['tecnologia']);
		$carisma = $conn->real_escape_string($_POST['carisma']);
		

        
        /*Si el boton de guardar cambios es precionado este modificara los datos de la base de datos*/
        
        if ($_POST['key'] == 'updateRow') {
			$conn->query("UPDATE country SET nombrePersonaje='$nombrePersonaje', biografia='$biografia', fuerza='$fuerza', mente='$mente', simpatia='$simpatia', magia='$magia', cultivos='$cultivos', tecnologia='$tecnologia', carisma='$carisma' WHERE id='$rowID'");
			exit('success');
		}

        /*Si el boton para agregar un nuevo pais es presionado guarda los datos en la base de datos*/
        
		if ($_POST['key'] == 'addNew') {
			$sql = $conn->query("SELECT id FROM personaje WHERE nombrePersonaje = '$nombrePersonaje'");
			if ($sql->num_rows > 0)
				exit("Country With This Name Already Exists!");
			else {
				$conn->query("INSERT INTO personaje (nombrePersonaje, biografia, fuerza, mente, simpatia, magia, cultivos, tecnologia, carisma) 
							VALUES ('$nombrePersonaje', '$biografia', '$fuerza', '$mente', '$simpatia', '$magia', '$cultivos', '$tecnologia', '$carisma')");
				exit('Country Has Been Inserted!');
			}
		}
	}
?>