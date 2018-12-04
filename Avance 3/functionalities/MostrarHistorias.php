<?php
    if (isset($_POST['key'])) {
        
        $conn = new mysqli('localhost', 'root', '', 'mundoyoto');
        
        $titulo = $conn->real_escape_string($_POST['titulo']);
        $descripcion = $conn->real_escape_string($_POST['descripcion']);
        $autor = $conn->real_escape_string($_POST['autor']);
        $tierra = $conn->real_escape_string($_POST['tierra']);
        $rowID = $conn->real_escape_string($_POST['rowID']);
        
        if ($_POST['key'] == 'showStory'){
            $sql = $conn->query("SELECT titulo, descripcion, autor FROM historia WHERE tierra = '$rowID'");
            $response = "";
            while($data = $sql->fetch_array()) {
                $response .= '
                <h4 class="texto"><strong> '$titulo'</strong></h4>
                <p class="texto"> '$descripcion' </p><br><p class="signed"> '$autor'</p><br><br>
                ';
            }
            exit ($response);
        }
    }
?>