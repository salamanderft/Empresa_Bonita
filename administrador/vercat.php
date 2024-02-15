<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<h1>Listado de categorías</h1>
	<table border=1>
		<tr>
			<th>Nombre Categoría</th>
			<th></th>
			<th></th>
		</tr>
		<?php
			include("archivodeconexion.php");
			$sql = "SELECT * FROM categorias ORDER BY nom_cat ASC";
			$ejecutar = $conexion->query($sql);
			if($ejecutar->num_rows > 0)
			{
				foreach($ejecutar as $registro)
				{
					$nombre = $registro["nom_cat"];
					$idcat = $registro["id_cat"];
					echo "
						<tr>
							<td>$nombre</td>
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