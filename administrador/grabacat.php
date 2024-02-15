<?php

	include("archivodeconexion.php");

	$nom = ucfirst($_POST["nombre"]);

	$existe = "SELECT * FROM categorias WHERE nom_cat='$nom'";
	$ejecutar = $conexion->query($existe);
	if($ejecutar->num_rows > 0)
	{
		//ya existe
		echo "<script>
				alert('Categoría $nom ya existe');
				window.location.href='creacat.php';
			</script>";
	}
	else
	{
		//no existe, lo grabo
		$grabar = "INSERT INTO categorias (nom_cat) VALUES ('$nom')";
		if($conexion->query($grabar))
		{
			//se grabó
			echo "<script>
				alert('Categoría $nom registrada');
				window.location.href='vercat.php';
			</script>";
		}
		else
		{
			//no se grabó
			echo "<script>
				alert('Ocurrió un error');
				window.location.href='creacat.php';
			</script>";
		}	
	} 

?>