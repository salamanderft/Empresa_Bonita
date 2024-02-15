<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<h1>Listado de prodcutos</h1>
	<table border=1>
		<tr>
			<th>Nombre Producto</th>
			<th>Precio Producto</th>
			<th>Categoría Producto</th>
			<th></th>
			<th></th>
		</tr>
		<?php
			include("archivodeconexion.php");
			$sql = "SELECT * FROM productos INNER JOIN categorias USING(id_cat) ORDER BY nom_pro ASC";
			$ejecutar = $conexion->query($sql);
			if($ejecutar->num_rows > 0)
			{
				foreach($ejecutar as $registro)
				{
					$nombrecat = $registro["nom_cat"];
					$nombrepro = $registro["nom_pro"];
					$preciopro = $registro["precio_pro"];
					$idcat = $registro["id_cat"];
					$idpro = $registro["id_pro"];
					echo "
						<tr>
							<td>$nombrepro</td>
							<td>$preciopro €</td>
							<td>$nombrecat</td>
							<td>
								<button><i class='fa fa-edit'></i></button>
							</td>
							<td>
								<button><i class='fa fa-trash'></i></button>
							</td>
						</tr>
					";
				}	
			}
			else
			{
				echo "No hay categorías registradas";
			}	
		?>
	</table>
</body>
</html>