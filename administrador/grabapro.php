<?php

	include("archivodeconexion.php");

	$nompro = ucfirst($_POST["nombre"]);
	$idcat = $_POST["categoria"];
	$precio = $_POST["precio"];

	$existe = "SELECT * FROM productos WHERE nom_pro='$nompro'";
	$ejecutar = $conexion->query($existe);
	if($ejecutar->num_rows > 0)
	{
		//ya existe el prodcuto
		echo "<script>
				alert('Producto $nompro ya existe');
				window.location.href='creapro.php';
			</script>";
	}
	else
	{
		//no existe, lo grabo
		$sql = "INSERT INTO productos (id_cat, nom_pro, precio_pro) VALUES ('$idcat','$nompro','$precio')";
		if($conexion->query($sql))
		{
			//se graba
			echo "<script>
				alert('Producto registrado');
				window.location.href='verpro.php';
			</script>";
		}
		else
		{
			//no se graba
			echo "<script>
				alert('Ocurrió un error');
				window.location.href='verpro.php';
			</script>";
		}	
	}	


?>