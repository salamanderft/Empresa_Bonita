<?php

	//tenemos que conectarnos la BD
	//Tenemos que recoger lo que me viene por la URL (ip)
	//Tenemos que saber si existe sesión de pedido
	//EN CASO DE QUE EXISTA:
		//SACO LA ID DEL PEDIDO 
		//TENGO QUE SABER SI EN EL DETALLE DE PEDIDO PARA ESE PEDIDO EXISTE ESE PRODUCTO (ip)
			//SI Existe ese producto, actualizo ese registro sumándole uno a la cantidad
			//SI NO Exsite, grabo normal en detalle con on la id del pedido que tenía
	//EN CASO DE QUE NO EXISTA
		//saco la fecha
		//saco la hora
		//Grabo un pedido nuevo
		//necesito saber qué id tiene ese pedido que acabo de grabar
		//creo una sesión de pedido y le meto la id del pedido
		//grabo en detalle de pedidos el producto (ip) con la id_ped que acabo de conseguir

	include("./php/archivodeconexion.php");	

	$idpro = $_GET["ip"];

	session_start(); // tenemos que escuchar las sesiones

	if(isset($_SESSION["pedido"]))
	{
		//aquí hay session, por tanto ya hay un pedido iniciado
		$idped = $_SESSION["pedido"];
		
		$buscaproendetped = "SELECT * FROM detalle_pedidos WHERE id_ped='$idped' AND id_pro='$idpro'";

		$ejecutar = $conexion->query($buscaproendetped);

		if($ejecutar->num_rows > 0)
		{
			//ya hay ese producto en el pedido
			$actualizar = "UPDATE detalle_pedidos SET cant_pro=cant_pro+1 WHERE id_ped='$idped' AND id_pro='$idpro'";
			if($conexion->query($actualizar))
			{
				//se actualizó el registro
				header("location:verpedido.php");
			}
			else
			{
				//no se actualizó
				echo "<script>
							alert('Error al añadir el producto');
							window.location.href='index.php';
					</script>";	
			}
		}	
		else
		{
			//no hay ese producto en el pedido
			//vamos a grabar el producto en detalle
			$grabadetalle = "INSERT INTO detalle_pedidos (id_ped, id_pro, cant_pro) VALUES ('$idped','$idpro',1)";
			if($conexion->query($grabadetalle))
			{
				//se grabó el detalle
				header("location:verpedido.php");
			}
			else
			{
				//no se grabó el detalle
				echo "
						<script>
							alert('Error al añadir el producto');
							window.location.href='index.php';
						</script>";
			}
		}	
	}
	else
	{
		//no hay session de pedido
		$fecha = date("Y-m-d");
		$hora = date("H:i:s");

		$grabaped = "INSERT INTO pedidos (fecha_ped, hora_ped, estado_ped) VALUES ('$fecha','$hora','0')";
		if($conexion->query($grabaped))
		{
			//se crea el pedido
			//Necesito saber que id tiene el pedido que se acaba de grabar
			$idped = $conexion->insert_id;

			$_SESSION["pedido"] = $idped;

			//ya podemos grabar el detalle

			$grabadetalle = "INSERT INTO detalle_pedidos (id_ped, id_pro, cant_pro) VALUES ('$idped','$idpro',1)";
			if($conexion->query($grabadetalle))
			{
				header("location:verpedido.php");
			}
			else
			{
				echo "<script>
						alert('Error al añadir el prodcuto');
						window.location.href='index.php';
					</script>";
			}

		}
		else	
		{
			//no se crea el pedido, error
			echo "<script>
						alert('Error al añadir el prodcuto');
						window.location.href='index.php';
					</script>";

		}	
	}	




?>