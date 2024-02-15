<?php
	session_start();
	$idcli= $_SESSION["cliente"][0];
	$iddir = $_POST["direccion"];
	include("./php/archivodeconexion.php");
	$pontodoa0 = "UPDATE direcciones SET preferida_dir =0 WHERE id_cli='$idcli'";
	$conexion->query($pontodoa0);
	$ponpreferida = "UPDATE direcciones SET preferida_dir=1 WHERE id_dir='$iddir'";
	$conexion->query($ponpreferida);
?>