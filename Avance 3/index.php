<?php
    session_start();

    require_once("funciones.php");
    require_once("util.php");

    if (isset($_POST["usuario"])) {
        $_POST["usuario"] = limpia_entrada($_POST["usuario"]);
    }
    
    if (isset($_POST["password"])) {
        $_POST["password"] = limpia_entrada($_POST["password"]);
    }
    
    if (isset($_SESSION["usuario"])) {
        include("header-footer/_header.html");
        include("Yoto-Main.html");
        
        /*echo "<br><br>";
        echo gerate_select("conciertos","id","nombre");
        echo "<br><br>";*/
        
    } else if (login($_POST["usuario"], hash("sha256",$_POST["password"])) != false) {
        
        $_SESSION["usuario"] = $_POST["usuario"];
        include("header-footer/_header.html");
        include("Yoto-Main.html");
        
    } else if ($_POST["usuario"] == "" && $_POST["password"] == "" 
                && isset($_POST["usuario"])  && isset($_POST["password"]) ) {
        
        $error = "Ingresa tu usuario y contraseña";
        include("header-footer/_header.html");
        
    } else if(isset($_POST["usuario"]) || isset($_POST["password"]) ) {
        
        sleep(3);
        $error = "Usuario y/o password incorrectos";
        include("header-footer/_header.html");
        
    } else {
        
        include("header-footer/_header.html");
        include("Yoto-Main.html");
    }
    
 
    include("header-footer/_footer.html");
?>