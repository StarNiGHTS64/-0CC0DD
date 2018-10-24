 <?php
    session_start();
    require("../main/funciones.php");
    
    if (isset($_SESSION["usuario"])) {
        header("location:../main/index.php");
    } else if (isset($_POST["usuario"])) {
        
        $usuario = htmlspecialchars($_POST["usuario"]);
        $contrasena = htmlspecialchars($_POST["contrasena"]);
        $contrasena_confirm = htmlspecialchars($_POST["contrasena_confirm"]);
        
        if ($contrasena === $contrasena_confirm && isset($_POST["contrasena"]) 
            && $usuario != "" && $contrasena != "" ) {
            
            if(crear_cuenta($usuario, $contrasena)) {
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