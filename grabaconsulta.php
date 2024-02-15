<?php

	$voyahacer = $_POST["loquetienesquehacer"];

	include("./php/archivodeconexion.php");

	switch ($voyahacer) 
	{
		case 'graba':
				//recoger por post lo que me envía el formulario
				$nom = $_POST["nombrepost"];
				$ema = $_POST["emailpost"];
				$pas = $_POST["passwordpost"];
				//ciframos contraseña
				$pas = password_hash($pas, PASSWORD_DEFAULT);

				$sql = "INSERT INTO clientes (nom_cli, email_cli, pass_cli) VALUES ('$nom','$ema','$pas')";
				if($conexion->query($sql))
				{
					$mensaje = "Registro con éxito";
				}
				else
				{
					$mensaje = "Error al registrar";
				}	

			break;
		
		case 'consulta':
				$ema = $_POST["emailpost"];
				$sql = "SELECT * FROM clientes WHERE email_cli='$ema'";
				$ejecutar = $conexion->query($sql);
				if($ejecutar->num_rows > 0)
				{
					$mensaje = "Email no disponible";
				}
				else
				{
					$mensaje = "Email disponible";
				}	

			break;

		case 'login':
				$ema = $_POST["email"];
				$pas = $_POST["pass"];
				$sql = "SELECT * FROM clientes WHERE email_cli='$ema'";
				$ejecutar = $conexion->query($sql);
				if($ejecutar->num_rows > 0)
				{
					//hemos enconotrado el email
					foreach($ejecutar as $registro)
					{
						$pasbd = $registro["pass_cli"];
					}

					if(password_verify($pas, $pasbd))
					{
						session_start();



						//$_SESSION["cliente"] = $registro["id_cli"]; //CREO UNA SESIÓN CLIENTE METIENDO DENTRO EL: OYE REGISTRO SERÍAS TAN AMABLE POR FAVOR.... EL ID_CLI

						//estas dos líneas que siguen son la misma que la anterior
						//$idcli = $registro["id_cli"];
						//$_SESSION["cliente"] = $idcli;

						//vamos a ver cómo creamos la session con un array:
						//$_SESSION["cliente"] = array($registro["id_cli"],$registro["nom_cli"]);

						//estas tres líneas que siguen son la misma que la anterior
						$idcli = $registro["id_cli"];
						$nomcli = $registro["nom_cli"];
						$_SESSION["cliente"] = array($idcli,$nomcli);

						header("location:index.php");
					}
					else
					{
						$mensaje = "la contraseña está mal";
					}	
				}
				else
				{
					//no hemos encontrado el email
					$mensaje = "Email está mal";
				}	
			break;	

	}
	echo "$mensaje";
?>