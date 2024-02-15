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
								<h1>Selecciona categoría</h1>
								<hr>
								
							</header>
							


							<?php

	include("./php/archivodeconexion.php");
	
	$idped = $_SESSION["pedido"];

	//Vamos a grabar la factura
	$fecha = date("Y-m-d");
	$hora = date("H:i:s");


	//vamos a ver si hay session de cliente: SI LA HAY, ,en la session tenemos el nombre y nos envió por POST la dirección a dónde enviar el pedido(RECORDAR QUE TENEMOS QUE EXPLOTAR POR @%). SI NO LA HAY, me envió el nombre, el email, la dirección y el cp por POST
	if(isset($_SESSION["cliente"]))
	{
		//tenemos sessión
		$nomcli = $_SESSION["cliente"][1];
		$idoemail = $_SESSION["cliente"][0]; //sé que tengo el id
		$direccion = $_POST["direccion"]; //PROBLEMA, me viene: $id@%$dire@%$cp
		//vamos a explotar la dirección por @%, para obtener cada una de las partes
		$trozosdir = explode("@%", $direccion);
		$dire = $trozosdir[1];
		$cp = $trozosdir[2];
	}
	else
	{
		//no tenemos session. VENIMOS DEL FORMULARIO COMPLETO
		$nomcli = $_POST["nombre"];
		$dire = $_POST["direccion"];
		$cp = $_POST["cp"];
		$idoemail = $_POST["email"]; //sé que tngo el mail
	}	



	$grabafac = "INSERT INTO facturas (fecha_fac, hora_fac, nom_cli, dir_dir, cp_dir, id_cli) VALUES ('$fecha','$hora', '$nomcli','$dire','$cp','$idoemail')";
	if($conexion->query($grabafac))
	{
		//se grabó la factura
		$idfac = $conexion->insert_id;

		//vamos a crear un array vacío para almacenar los datos que me da la BD
		$elpedido = array();

		//vamos a crear una variable total inicializada en 0 para que acumule el total del pedido
		$totalpedido = 0;

		//vamos a consultar el detalle de pedidos y grabamos en detalle de facturas sus datos
		$verdetallespedido = "SELECT * FROM detalle_pedidos
										INNER JOIN productos USING(id_pro)
										WHERE id_ped='$idped'";
		$ejecutar = $conexion->query($verdetallespedido);
		foreach($ejecutar as $registro)
		{
			$nombre = $registro["nom_pro"];
			$precio = $registro["precio_pro"];
			$cant = $registro["cant_pro"];

			$total = $precio * $cant;

			$totalpedido = $totalpedido + $total;


			//tenemos que hacer que se guarden los datos del pedido en el array

			$filadetalle = array($nombre, $precio, $cant);

			array_push($elpedido, $filadetalle); 

			//tengo que grabar estos datos en el detalle de facturas:
			$grabadet = "INSERT INTO detalle_facturas (id_fac,nom_profac,precio_profac,cant_profac) VALUES ('$idfac','$nombre','$precio','$cant')";
			$conexion->query($grabadet);
		}
		//mensaje de pedido finalizado
		echo "HEMOS RECIBIDO TU PEDIDO nº $idped";		

		//VAMOS A ACTUALIZAR EL ESTADO DEL PEDIDO a Preparando
		$actualiza = "UPDATE pedidos SET estado_ped='Preparando pedido' WHERE id_ped='$idped'";
		$conexion->query($actualiza);

		//terminamos la session de pedido

		//session_destroy(); //rompe, destruye todas las sesiones que estén activas

		unset($_SESSION["pedido"]); //mata la sesión que se llama pedido 

		echo "<table border=1>";
		//vamos a pintar el array con los datos
		foreach($elpedido as $elemento)
		{
			echo "<tr>";
				foreach($elemento as $dato)
				{
					echo "<td>$dato</td>";
				}
			echo "</tr>";
		}
		echo "</table>";

		// LO MISMO QUE ANTES PERO CON BUCLE FOR
		// for($i=0;$i<count($elpedido);$i++)
		// {
		// 	echo "<tr>";
		// 		for($j=0;$j<count($elpedido[$i]);$j++)
		// 		{
		// 			echo "<td>".$elpedido[$i][$j]."</td>";
		// 		}
		// 	echo "</tr>";
		// }

		echo "Será entregado en: $dire $cp <br>";

		$iva = $totalpedido * 0.21;
		$totaltotal = $totalpedido + $iva;
		echo "Base imponible: $totalpedido €<br>
				Iva (21%): $iva <br>
				Total: $totaltotal €";



	}
	else
	{}


?>


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