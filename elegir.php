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
								<h1>Finalizar pedido</h1>
								<hr>
								
							</header>
							<section>
							<?php
		
		if(isset($_SESSION["cliente"]))
		{
			//SI HAY CLIENTE CON LOGIN
			include("./php/archivodeconexion.php");
			$idcli = $_SESSION["cliente"][0];
			$nomcli = $_SESSION["cliente"][1];
			echo "$nomcli, ¿A qué dirección te enviamos tu pedido?<br>";

			$sql = "SELECT * FROM direcciones WHERE id_cli='$idcli' ORDER BY preferida_dir DESC";
			$ejecutar = $conexion->query($sql);
			if($ejecutar->num_rows > 0)
			{
				//HAY DIRECCIONES!!!!!!!
				echo "<form action='finalizapedido.php' method='POST'>
				<div class='row gtr-uniform'>
				";

					foreach($ejecutar as $registro)
					{
						$iddir = $registro["id_dir"];
						$dire = $registro["dir_dir"];
						$cp = $registro["cp_dir"];
						if($registro["preferida_dir"] == 1)
						{
							echo "<div class='col-12 col-12-small'>
									<input type='radio'  id='dire$iddir' name='direccion' value='$iddir"."@%"."$dire"."@%$cp' checked required> 
									<label for='dire$iddir'>$dire $cp</label> 
								</div>";
							//Que se registre, que se loguee, que lo haga como invitado
							//para que se registr o haga login:
							
						}
						else
						{
							echo "
							<div class='col-12 col-12-small'>
								<input type='radio' id='dire$iddir' name='direccion' value='$iddir"."@%"."$dire"."@%$cp' required><label for='dire$iddir'>$dire $cp</label> 
							</div>
							";
						}
						
					}
				echo '<div class="col-12">
												<ul class="actions">
													
													<li><input type="submit" value="Finalizar Pedido" /></li>
												</ul>
											</div>';	
				echo "</div></form>";
			}
			else
			{
				// NO HAY DIRECCIONESSSSS
				echo "<h3>No tienes direcciones registradas</h3>";
				echo "<a href='perfil.php'>Añadir dirección</a>";
			}

		}
		else
		{
			//NO ESTÁ LOGUEADO
			//Que se registre, que se loguee, que lo haga como invitado
			//para que se registr o haga login:
			echo "<h3>No tienes cuenta?</h3>";
			echo "<a href='registro.php'>Crea tu cuenta</a> o 
			<a href='login.php'>Inicia sesión</a>";

			echo "<h3>O si lo prefieres, puedes comprar como invitado</h3>";
			//tenemos que preparar un formulario para que relene : Nombre, email, dirección y cp
			?>
			<form action="finalizapedido.php" method="POST">
				<input type="text" name="nombre" placeholder="Nombre">
				<br>
				<input type="text" name="email" placeholder="Email"> <i>Para recibir la información del pedido</i>
				<br>
				<h4>¿A dónde te lo enviamos?</h4>
				<textarea name="direccion" placeholder="Dirección"></textarea>
				<br>
				<input type="text" name="cp" placeholder="Código postal">
				<br>
				<input type="submit" value="Finalizar pedido">
			</form>
			<?php

		}	
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