 <?php
    session_start();
    require("../main/funciones.php");
    
    
    if (isset($_SESSION["usuario"])) {
        header("location:../main/index.php");
    } else if (isset($_POST["usuario"])) {
        
        $nombre = $_POST['nombre'];
        $aPaterno = $_POST['aPaterno'];
        $aMaterno = $_POST['aMaterno'];
        $sexo = 1;

        $bday = $_POST['bday'];
        $email = $_POST['email'];
        $avatar = 'www.link/algomas/imagen.png';
        
        $usuario = htmlspecialchars($_POST["usuario"]);
        $contrasena = htmlspecialchars($_POST["contrasena"]);
        $contrasena_confirm = htmlspecialchars($_POST["contrasena_confirm"]);
        
        if (strlen($nombre) > 0 && strlen($aPaterno) > 0 && strlen($bday) > 0 && strlen($email) > 0 && strlen($avatar) > 0 && strlen($usuario) > 0 ){
            if (agregar_niño ($nombre, $aPaterno, $aMaterno, $sexo, $usuario, $bday, $email, $avatar)){
                $_SESSION["mensaje"] = "Registro completo";
            }
        }
        
        if ($contrasena === $contrasena_confirm && isset($_POST["contrasena"]) 
            && $usuario != "" && $contrasena != "" ) {
            
            if(crear_usuario($usuario, $contrasena)) {
                $_SESSION["mensaje"] = "Tu usuario se creó";
                header("location:../main/index.php");
            } else {
                $error = "Ocurrió un error al crear la cuenta";
            include("../header-footer/_header.html");
            include("_registro.html");
            include("../header-footer/_footer.html");
            }
            
            
        } else {
            $error = "Los passwords no coinciden o faltó información";
            include("../header-footer/_header.html");
            include("_registro.html");
            include("../header-footer/_footer.html");
        }
        
    } else {
            include("../header-footer/_header.html");
            include("_registro.html");
            include("../header-footer/_footer.html");
    }

  ?>