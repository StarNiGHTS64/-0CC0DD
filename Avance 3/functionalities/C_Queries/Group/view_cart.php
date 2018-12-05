 <?php 
session_start();
include("inc/config.inc.php");
include("inc/header.php"); 
?>
<title>Demo</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/cart.js"></script>
<?php include('inc/container.php');?>
<div class="container" id="view_cart">	
	<h2>Crear Equipos</h2>
	<div class="text-left">					
		<div class="col-md-8">
			<h3>Niños en el Equipo (<span id="cart-items-count"><?PHP if(isset($_SESSION["products"])){echo count($_SESSION["products"]); } ?></span>)</h3>			
			<?php		
			if(isset($_SESSION["products"]) && count($_SESSION["products"])>0) { 
			?>
				<table class="table" id="shopping-cart-results">
				<thead>
				<tr>
				<th>Nombre</th>
				<th>Edad</th>
				<th>Info Relevante</th>
				<th>Info Relevante</th>
				<th>&nbsp;</th>
				</tr>
				</thead>
				<tbody>
			<?php
				$cart_box = '<ul class="cart-products-loaded">';
				$total = 0;
				foreach($_SESSION["products"] as $product){					
					$product_name = $product["product_name"]; 
					$product_price = $product["product_price"];
					$product_code = $product["product_code"];
					$product_qty = $num=1;
					$product_color = "azul";					
					$subtotal = $num=1;
					$total = ($total + $subtotal);
				?>
				<tr>
				<td><?php echo $product_name; echo "&mdash;"; echo $product_color; ?></td>
				<td><?php echo $num=10; ?></td>
				<td><?php echo $num=1; ?></td>
				<td><?php echo $num=1; ?></td>
				<td>				
				<a href="#" class="btn btn-danger remove-item" data-code="<?php echo $product_code; ?>"><i class="glyphicon glyphicon-trash"></i></a>
				</td>
				</tr>
			 <?php } ?>
			<tfoot>
			<br>
			<br>
			<tr>
			<td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continuar agregando Niños</a></td>
			<td colspan="2"></td>
			<?php 
			if(isset($total)) {
			?>	
			<td class="text-center cart-products-total"><strong>Total Niños: <?php echo $total; ?></strong></td>
			<td><a href="checkout.php" class="btn btn-success btn-block">Terminar<i class="glyphicon glyphicon-menu-right"></i></a></td>
			<?php } ?>
			</tr>
			</tfoot>			
			<?php		
			} else {
				echo "El Equipo esta vacio";
			?>
			<tfoot>
			<br>
			<br>
			<tr>
			<td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continuar Agregando Niños</a></td>
			<td colspan="2"></td>
			</tr>
			</tfoot>
			<?php } ?>				
			</tbody>
			</table>			
		</div>			
	</div>
</div>
<?php include('inc/footer.php');?>




