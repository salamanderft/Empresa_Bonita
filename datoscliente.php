<?php

	session_start();
	$idcli = $_SESSION["cliente"][0];
	$nomcli = $_SESSION["cliente"][1];
	include("./php/archivodeconexion.php");
	$sql = "SELECT * FROM clientes WHERE id_cli='$idcli'";
	$ejecutar = $conexion->query($sql);
	foreach ($ejecutar as $registro) 
	{
		$email = $registro["email_cli"];
		$pass = $registro["pass_cli"];
	}

?>
<button onclick="activarform()" id="aplicar">Modificar</button>
<table border="1">
	<tr>
		<th>Nombre</th>
		<th>Email</th>
		<th>Password</th>

	</tr>
	<tr>
		<td><?php echo $nomcli; ?></td>
		<td><?php echo $email; ?></td>
		<td><?php echo $pass?></td>	
	</tr>
</table>



<form  style="display: none">
	<input type="text" name="nombre" placeholder="Nombre" value="<?php echo $nomcli;?>">
	<br>
	<input type="text" name="email" placeholder="Email" value="<?php echo $email?>">
	<br>
	<input type="text" name="password" placeholder="****..." value="">
	<br>
	<input type="submit" value="Actualizar">
</form>

<script type="text/javascript">
	function activarform()
	{
		$("table").toggle();
		$("form").toggle();

	}
</script>