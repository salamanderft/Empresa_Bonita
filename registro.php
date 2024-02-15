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

				

				<!-- Menu -->
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
								<h1>Registro</h1>
								<hr>
								
							</header>
							<section>
								
								<form method="post" action="grabaconsulta.php">
									<div class="fields">
										<div class="field">
											<input type="text" name="" id="nombre" placeholder="Nombre" />
										</div>
										<div class="field half">
											<input type="email" name="" id="email" placeholder="Email" onblur="recoger()"/>
										</div>
										<div class="field half">
											<input type="password" name="" id="pass" placeholder="Contraseña" />
										</div>
										
										
									</div>
									<ul class="actions">
										<li><input type="button" value="Registrarse" class="primary" onclick="crear()"/></li>
									</ul>
								</form>
							<a href="login.php">Ya tengo cuenta</a>
							
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

			<script type="text/javascript">
		function crear()
		{
			//tengo que crear unas variables y en ellas meteré los values que tengan los inputs
			var nom = $("#nombre").val();
			var ema = $("#email").val();
			var pas = $("#pass").val();

			//si las variables están vacías marco error, de lo contrario se lo doy a cocina
			if(nom != "" && ema != "" && pas != "")
			{
				//los campos están llenos, vamos a enviarlos por .post a documento que registra
				// $.post("parametro1","parametro2",function(){})
				$.post(
						"grabaconsulta.php", //a dónde voy?
						{nombrepost:nom, emailpost:ema, passwordpost:pas, loquetienesquehacer:"graba"}, //lo que envío
						function(echosdelphp)
						{
							alert(echosdelphp);
						}

					);
			}
			else
			{
				//dejó algún dato vacío, mensaje
				alert("Tienes que rellenar todos los campos");
			}
		}

		function recoger()
		{
			var ema = $("#email").val();
			if(ema != "")
			{
				$.post(
						"grabaconsulta.php",
						{emailpost:ema, loquetienesquehacer:"consulta"},
						function(echosdelphp)
						{
							alert(echosdelphp);
						}
					);
			}
			else
			{
				alert("Tienes que escribir un email");
				
			}

		}

	</script>

	</body>
</html>