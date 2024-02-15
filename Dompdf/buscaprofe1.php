 <label for="prof2" class="form-label">Subcategoría:</label>
    <select id="prof2" class="select2 form-select" onchange="buscaprof2()">
                            
                            
<?php
	$cod = $_POST["codigo"];
	
	include("./../clases/clases.php");
	$datousu= new Consulta("profesiones1","WHERE cod_prof = '$cod'");
	
		echo '<option value="">Selecciona</option>';
		foreach($datousu->hconquery() as $row)
		{
			$codprof = $row["cod_prof1"];
            $nomprof = $row["nom_prof1"];
            
            echo '<option value="'.$codprof.'">'.$nomprof.'</option>';	 
		}	
	}
	
		
?>
</select>