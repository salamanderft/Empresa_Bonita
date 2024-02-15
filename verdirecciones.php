<br>
<?php

	session_start();
	$idcli = $_SESSION["cliente"][0];

	include("./php/archivodeconexion.php");

	$sql = "SELECT * FROM direcciones WHERE id_cli='$idcli'";
	$ejecutar = $conexion->query($sql);
	if($ejecutar->num_rows > 0)
	{
		//se que tiene direcciones
		foreach($ejecutar as $registro)
		{
			$iddir = $registro["id_dir"];
			$dire = $registro["dir_dir"];
			$cp = $registro["cp_dir"];
			$prefe = $registro["preferida_dir"];
			if($prefe == 1)
			{
				$pintainput = "<input type='checkbox' id='direccion$iddir' onclick='activadir($iddir)' checked>";
			}
			else
			{
				$pintainput = "<input type='checkbox' id='direccion$iddir' onclick='activadir($iddir)'>";
			}	

			echo "$pintainput <label for='direccion$iddir'>$dire , CP: $cp</label> <i class='fa fa-trash' onclick='borrardireccion($iddir)' style='cursor:pointer'></i><br>";
		}

		echo "
				<script>
					function activadir(identificadordeladireccion)
					{
						$.post(
								'direccionpreferida.php',
								{direccion:identificadordeladireccion},
								function(echosdelphp)
								{
									window.location.href='perfil.php';
								}
						);
					}

					function borrardireccion(identificadordeladireccion)
					{
						$.post(
								'borrardireccion.php',
								{direccion:identificadordeladireccion},
								function(echosdelphp)
								{
									alert(echosdelphp);	
								}	
						);
					}

				</script>
		";


	}
	else
	{
		//no tiene direcciones
		echo "<h3>No tienes direcciones registradas</h3>";
	}	


?>