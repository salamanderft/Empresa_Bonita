<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<h1>Crear producto</h1>
	<?php
		include("archivodeconexion.php");
		$haycat = "SELECT * FROM categorias ORDER BY nom_cat ASC";
		$ejecutar = $conexion->query($haycat);
		if($ejecutar->num_rows > 0)
		{
			?>

				<form action="grabapro.php" method="POST">
					<select name="categoria">
						<option value="">Selecciona Categoría</option>
						<?php
							foreach ($ejecutar as $registro) 
							{
								$nomcat= $registro["nom_cat"];
								$idcat = $registro["id_cat"];
								echo "<option value='$idcat'>$nomcat</option>";
							}

						?>
					</select>
					<br>
					<input type="text" name="nombre" placeholder="Producto:">
					<br>
					<input type="text" name="precio" placeholder="Precio:">
					<br>
					<input type="submit" value="Grabar">
				</form>


			<?php
		}	
		else
		{
			?>
			<h3>No hay categorías registradas</h3>
			<a href="creacat.php">Crear categoría</a>
			<?php
		}	

	?>
</body>
</html>