<?php

	include("./php/archivodeconexion.php");

	session_start();
	
	$idped = $_SESSION["pedido"];

	$idpro = $_GET["ip"];

	$hay = "SELECT * FROM detalle_pedidos WHERE id_pro = '$idpro' AND cant_pro > 1 AND id_ped='$idped'";
	$ejecutar = $conexion->query($hay);
	if ($ejecutar->num_rows > 0) 
	{
		$sql = "UPDATE detalle_pedidos SET cant_pro= cant_pro - 1 WHERE id_pro='$idpro' AND id_ped='$idped'";
	}
	else
	{
		$sql = "DELETE FROM detalle_pedidos WHERE id_pro='$idpro' AND id_ped='$idped'";
	}	

	$conexion->query($sql);

	header("location:verpedido.php");


?>