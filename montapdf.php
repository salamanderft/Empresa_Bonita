<?php

	$idfac = $_GET["if"];

	$nomfactura = "factura_$idfac";

	//empieza la librería
	include_once("./Dompdf/autoload.inc.php"); //llama al archivo autoload para tenerlo presente

	use Dompdf\Dompdf;
	use Dompdf\Options;

	$opciones = new Options();
	$opciones -> set('isHtml5ParserEnabled',true);
	$opciones -> set('isRemoteEnabled', true);

	$documento = new Dompdf($opciones);

	ob_start();

	include("tablafactura.php");
	$html = ob_get_clean();
	$documento->loadHtml($html);
	$documento->render();
	$documento->stream($nomfactura);









?>