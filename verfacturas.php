<?php

	session_start();
	if(isset($_SESSION["cliente"]))
	{
		$idcli = $_SESSION["cliente"][0];
	}
	elseif(isset($_POST["email"]))
	{
		$idcli = $_POST["email"];
	}
	else
	{
		//no hay ni session ni hay recepción de post, por tanto la persona que está en este documento no es bienvenida

		//Si queremos reenviar sin avisar de nada:
		//header("location:index.php");
		//Si queremos avisar de estar mal ubicado
		echo "
			<script>
				alert('Espacio restringido');
				window.location.href='index.php';
			</script>
		";
	}

	include("./php/archivodeconexion.php");

	//VAMOS A BUSCAR EN FACTURAS EL IDCLI
	$sql = "SELECT id_fac, fecha_fac, SUM(cant_profac * precio_profac) as total FROM facturas INNER JOIN detalle_facturas USING(id_fac) WHERE id_cli = '$idcli' GROUP BY id_fac";
	$ejecutar = $conexion->query($sql);
	if($ejecutar->num_rows > 0)
	{
		//tiene facturas
		echo "<table border=1>
					<tr>
						<th>Factura</th>
						<th>Fecha</th>
						<th>Total</th>
						<th>Descargar</th>
					</tr>";
		foreach($ejecutar as $registro)
		{
			$idfac = $registro["id_fac"];
			$fechafac = $registro["fecha_fac"];
			$fecha = explode("-", $fechafac);
			$total = $registro["total"];
			echo "	<tr>
						<td>$idfac</td>
						<td>$fecha[2]/$fecha[1]/$fecha[0]</td>
						<td>$total €</td>
						<td><button onclick='window.location.href=`montapdf.php?if=$idfac`'>Descargar</button></td>
					</tr>";

		}
		echo "</table>";
	}
	else
	{
		//no tiene facturas
		echo "<h3>No tienes pedidos realizados</h3>";
	}	




?>