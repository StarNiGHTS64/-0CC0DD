 <?php 
session_start();
include_once("inc/db_connect.php");
include("inc/config.inc.php"); 
include("inc/header.php"); 
?>
<title>Demo</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/cart.js"></script>
<?php include('inc/container.php');?>
<div class="container">	
	<h2>Crear Equipos</h2>
	<div class="text-left">	
		<br><br>
		El equipo fue registrado de manera exitosa
		<br><br><br>
		<a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Registrando Equipos</a>
		
	</div>
</div>
<?php include('inc/footer.php');?>




