<?php
    session_start();

  
        require_once("funciones.php");
        require_once("util.php");

        //Limpiar datos
        if (isset($_POST['nombre'])) {
            $_POST['nombre'] = limpia_entrada($_POST['nombre']);
        }

        if (isset($_POST['contrasena'])) {
            $_POST['contrasena'] = limpia_entrada($_POST['contrasena']);
        }


        if (isset($_SESSION['nombre'])) {

            include("../header-footer/_header.html");
            include("Yoto-Main.html");




        } else if (isset($_POST['nombre']) && isset($_POST['contrasena']) && login($_POST['nombre'], $_POST['contrasena']) == true) {
            $_SESSION['nombre'] = $_POST['nombre'];

            include("../header-footer/_header.html");
            include("Yoto-Main.html");

        } else if (isset($_POST['nombre'])  && isset($_POST["contrasena"]) && $_POST['nombre'] == '' && $_POST['contrasena'] == '' ) {

            $error = "Ingresa tu usuario y contraseña";
                include("../header-footer/_header.html");
                include("Yoto-Main.html");

        } else if(isset($_POST['nombre']) || isset($_POST['contrasena']) ) {

            sleep(2);
            $error = "Usuario y/o contraseña incorrectos";
            include("../header-footer/_header.html");
            include("Yoto-Main.html");

        } else {
            include("../header-footer/_header.html");
            include("Yoto-Main.html");
        }


        include("../header-footer/_footer.html");
        
  
?>