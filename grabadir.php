<?php

	$dire = $_POST["direccion"];
	$cp = $_POST["cp"];
	include("./php/archivodeconexion.php");

	//voy a saber si esta persona??? cliente??? (MIRARÉ la SESION) tiene alguna dirección registrada

	session_start();
	$idcli = $_SESSION["cliente"][0];

	$busca = "SELECT * FROM direcciones WHERE id_cli='$idcli'";
	$ejecutar = $conexion->query($busca);
	if($ejecutar->num_rows > 0)
	{
		//ya tiene direcciones
		$sql = "INSERT INTO direcciones (id_cli, dir_dir, cp_dir, preferida_dir) VALUES ('$idcli','$dire','$cp',0)";
	}
	else
	{
		//no tiene direcciones
		$sql = "INSERT INTO direcciones (id_cli, dir_dir, cp_dir, preferida_dir) VALUES ('$idcli','$dire','$cp',1)";
	}	

	if($conexion->query($sql))
	{
		echo "<script>
				alert('Dirección registrada con éxito');
				window.location.href='perfil.php';
		</script>";
	}
	else
	{
		echo "<script>
				alert('Error');
				window.location.href='perfil.php';
		</script>";	
	}
?>