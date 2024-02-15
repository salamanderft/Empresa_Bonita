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
							<button onclick="cargadatos()">Mis datos</button>
	<button onclick="cargadirecciones()">Mis direcciones</button>
	<button onclick="cargapedidos()">Mis pedidos</button>
	<div id="resultados"></div>

	<script type="text/javascript">
		function cargadatos()
		{
			$.post(
					"datoscliente.php",
					{},
					function(echosdelphp)
					{
						$("#resultados").html(echosdelphp);
					}
				);
		}

		function cargadirecciones()
		{
			
			var formulario = "<button onclick='enciendeform()'>Añadir dirección</button><form id='fdir' style='display:none' action='grabadir.php' method='POST'><input type='text' name='direccion' placeholder='Dirección'><br><input type='text' name='cp' placeholder='Código Postal'><br><input type='submit' value='Grabar'></form>";
			$("#resultados").html("");
			$("#resultados").append(formulario);
			$.post(
					"verdirecciones.php",
					{},
					function(echosdelphp)
					{
						$("#resultados").append(echosdelphp);
					}
				);

			
		}

		function enciendeform()
		{
			$("#fdir").toggle();
		}

		function cargapedidos()
		{
			$.post(
					"verfacturas.php",
					{},
					function(echosdelphp)
					{
						$("#resultados").html(echosdelphp);
					}	
				);
		}





	</script>

							
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