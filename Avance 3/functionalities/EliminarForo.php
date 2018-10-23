<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "Lab18");
	$sql = "DELETE FROM tbl_sample WHERE id = '".$_POST["id"]."'";  
	if(mysqli_query($connect, $sql))  
	{  
		echo 'Entrada Eliminada';  
	}  
?>