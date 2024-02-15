<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>A PARDELA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="index.php" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">PARDELA</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<h2>Menu</h2>
						<ul>
							<li><a href="index.php">Inicio</a></li>
							<li><a href="todos.php">Todos los productos</a></li>
						<?php
							session_start();
							if(isset($_SESSION["cliente"]))
							{
								//HAY SESIÓN: MOSTRAR UN MENÚ PARA PODER VER SU PERFIL (DIRECCIONES...), SUS PEDIDOS Y DESCONECTARSE
								$nomcli = $_SESSION["cliente"][1];

								echo "<li><a href='perfil.php'>$nomcli</a></li> ";
								echo "<li><a href='salir.php'>Desconectarse</a></li>";
							}
							else
							{

								//NO HAY SESSION DEL CLIENTE POR TANTO MUESTRO EL REGISTRO Y EL LOGIN
								echo '<li><a href="registro.php">Registro</a></li>
										<li><a href="login.php">Login</a></li>';
							}
							if(isset($_SESSION["pedido"]))
							{	
						?>
								<li><a href="verpedido.php">Ver pedido</a></li>
						<?php	
							}
						?>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<header>
								<h1>Mi pedido</h1>
								<hr>
								
							</header>
							<section>
									<div class="table-wrapper">
										<table>
											<thead>
												<tr>
													<th>Nombre</th>
													<th>Precio</th>
													<th>Cantidad</th>
													<th></th>
													<th></th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												
												<?php
		
												if(isset($_SESSION["pedido"]))
												{

													//incluimos la conexion
													include("./php/archivodeconexion.php");

													//tenemos pedido, así que tenemos que mostrarlo
													$idped = $_SESSION["pedido"];
													//inicio una variable pata calcular el total del pedido a 0
													$totalpedido = 0;
													// tenemos que conocer qué tiene este pedido
													$sql = "SELECT * FROM pedidos
																INNER JOIN detalle_pedidos USING(id_ped)
																INNER JOIN productos ON productos.id_pro = detalle_pedidos.id_pro
																WHERE id_ped='$idped'";
													$ejecutar = $conexion->query($sql);
													foreach($ejecutar as $registro)
													{
														$nompro = $registro["nom_pro"];
														$cant = $registro["cant_pro"];
														$precio = $registro["precio_pro"];
														$total = $cant * $precio;
														$idpro = $registro["id_pro"];
														$totalpedido = $totalpedido + $total;
														$estado = $registro["estado_ped"];

														echo "
																<tr>
																	<td>$nompro</td>
																	<td>$precio €</td>
																	<td>$cant</td>
																	<td><button onclick='window.location.href=`crearpedido.php?ip=$idpro`'>+</button></td>
																	<td><button onclick='window.location.href=`restarproducto.php?ip=$idpro`'>-</button></td>
																	<td>$total €</td>
																</tr>
														";
														



													}

													$base = $totalpedido;
													$iva = $base * 0.21;
													$totaltotal = $base + $iva;

													if($totaltotal <=10)
													{
														$totaltotal = $totaltotal + 5;
														$mensaje = "5 €";
													}
													else
													{
														
														$mensaje = "Gratis";	
													}	
												}	
											?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="4"></td>
													<th>Base</th>
													<td><?php echo $base?></td>
												</tr>
												<tr>
													<td colspan="4"></td>
													<th>Iva</th>
													<td><?php echo $iva?></td>
												</tr>
												<tr>
													<td colspan="4"></td>
													<th>Gastos de envío</th>
													<td><?php echo $mensaje?></td>
												</tr>
												<tr>
													<td colspan="4"></td>
													<th>Total</th>
													<td><?php echo $totaltotal?></td>
												</tr>
											</tfoot>
										</table>
									</div>

									<button onclick='window.location.href=`index.php`'>Seguir comprando</button>
									<button onclick='window.location.href=`elegir.php`'>Finalizar pedido</button>

								</section>
						</div>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							
							<ul class="copyright">
								<li>&copy; A Pardela. <?php echo date("Y")?></li>
							</ul>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>