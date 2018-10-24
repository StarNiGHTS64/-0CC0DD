<?php
    session_start();

    require("funciones.php");
    require_once("util.php");

    //Limpiar datos
    if (isset($_POST["usuario"])) {
        $_POST["usuario"] = limpia_entrada($_POST["usuario"]);
    }
    
    if (isset($_POST["contrasena"])) {
        $_POST["contrasena"] = limpia_entrada($_POST["contrasena"]);
    }
    


    if (isset($_SESSION["usuario"])) {

        include("../header-footer/_header.html");
        include("Yoto-Main.html");
        
    } else if (isset($_POST["usuario"]) && login($_POST["usuario"], $_POST["contrasena"]) == true) {
        if ($_POST["usuario"] == 'SuperAdmin')
        $_SESSION["usuario"] = $_POST["usuario"];
            
        include("../header-footer/_header.html");
        include("Yoto-Main.html");
        
    } else if (isset($_POST["usuario"]) && $_POST["usuario"] == "" && $_POST["contrasena"] == "" 
                && isset($_POST["usuario"])  && isset($_POST["contrasena"]) ) {
        
        $error = "Ingresa tu usuario y contraseña";
            include("../header-footer/_header.html");
            include("Yoto-Main.html");
        
    } else if(isset($_POST["usuario"]) || isset($_POST["contrasena"]) ) {
        
        sleep(3);
        $error = "Usuario y/o contraseña incorrectos";
        include("../header-footer/_header.html");
        include("Yoto-Main.html");
        
    } else {
        include("../header-footer/_header.html");
        include("Yoto-Main.html");
    }
    
 
    include("../header-footer/_footer.html");
?>