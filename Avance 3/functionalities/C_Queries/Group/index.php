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
	<div class="text-center">	
		<div class="col-md-8 text-right header-box">
		<a href="view_cart.php" class="cart-counter" id="cart-info" title="Ver Equipo">            
			<span class="cart-item" id="cart-container"><?php 
			if(isset($_SESSION["products"])){
				echo count($_SESSION["products"]); 
			} else {
				echo 0; 
			}
			?></span>
		</a>
		</div>
		<div class="col-md-8 text-center">			
			<ul class="products-container">
			<?php			
			$sql_query = "SELECT product_name, product_desc, product_code, product_image, product_price FROM shop_products";	
		    $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
			while( $row = mysqli_fetch_assoc($resultset) ) {
			?>
			<li>
				<form class="product-form">
					<h4><?php echo $row["product_name"]; ?></h4>
					<div><img class="product_image" src="images/<?php echo $row["product_image"]; ?>"></div>
					<div>Info : <?php echo $edad="Informacion Relevante"; ?></div>
					<div class="product-box">
						<div>
							<!--Color :
							<select name="product_color">
							<option value="Competencia 1">Competencia 1</option>
							<option value="Competencia 2">Competencia 2</option>
							<option value="Competencia 3">Competencia 3</option>
                            <option value="Competencia 4">Competencia 4</option>
							<option value="Competencia 5">Competencia 5</option>
							<option value="Competencia 6">Competencia 6</option>
                            <option value="Competencia 7">Competencia 7</option>
							</select>-->
						</div>	
						<div>
							<!--Qty :
							<select name="product_qty">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							</select>-->
						</div>				
						<input name="product_code" type="hidden" value="<?php echo $row["product_code"]; ?>">
						<button type="submit">Agregar Niño</button>
					</div>
				</form>
				</li>
			<?php } ?>
			</ul>
		</div>	
		<div class="col-md-8 text-left">
			<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="#">Regresar</a>		
		</div>	
	</div>
</div>
<?php include('inc/footer.php');?>