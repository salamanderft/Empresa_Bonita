<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		table{
			width: 100%;
		}
		
		th{
			background-color: grey;
			color:white;
		}
	</style>
</head>
<body>
		<?php
			include("./php/archivodeconexion.php");
			$sql = "SELECT * FROM facturas WHERE id_fac='$idfac'";
			$ejecutar = $conexion->query($sql);
			foreach($ejecutar as $registro)
			{
				$nomcli = $registro["nom_cli"];
				$dire = $registro["dir_dir"];
				$cp = $registro["cp_dir"];
				$email = $registro["id_cli"];
			}
		?>
		<table border=1>
			<tr>
				<th>Nombre</th>
				<td colspan="3"><?php echo $nomcli;?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td colspan="3"><?php echo $email;?></td>
			</tr>
			<tr>
				<th>Factura nº</th>
				<td colspan="3"><?php echo $idfac;?></td>
			</tr>
			<tr>
				<th>Dirección</th>
				<td><?php echo $dire;?></td>
				<th>C.P.</th>
				<td><?php echo $cp;?></td>
			</tr>
			<tr>
				<th colspan="4" style="background-color: grey;">Detalle de la factura</th>
			</tr>
			<tr>
				<th>Cantidad</th>
				<th>Producto</th>
				<th>Precio</th>
				<th>Total</th>
			</tr>

			
			<!-- AQUÍ VAN PRODUCTOS -->
			<?php
				//esta variable va a acumular el total de la factura
				$totalfactura = 0;
				$sqldetalle = "SELECT * FROM detalle_facturas WHERE id_fac='$idfac'";
				$ejecutardetalle = $conexion->query($sqldetalle);
				foreach($ejecutardetalle as $registrodetalle)
				{
					$nompro = $registrodetalle["nom_profac"];
					$cant = $registrodetalle["cant_profac"];
					$precio = $registrodetalle["precio_profac"];
					$totallinea = $cant * $precio;
					$totalfactura = $totalfactura + $totallinea;
					echo "
							<tr>
								<td>$cant</td>
								<td>$nompro</td>
								<td>$precio €</td>
								<td>$totallinea €</td>
							</tr>";
				}
				$iva = $totalfactura * 0.21;
				$totaltotal = $totalfactura + $iva;
			?>

			<tr>
				<td colspan="2" rowspan="3"></td>
				<th>Base</th>
				<td><?php echo $totalfactura;?> €</td>
			</tr>
			<tr>
				<th>IVA</th>
				<td><?php echo $iva;?> €</td>
			</tr>
			<tr>
				<th>TOTAL</th>
				<td><?php echo $totaltotal;?> €</td>
			</tr>
		</table>
</body>	
</html>