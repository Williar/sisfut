<?php
function GenerarCR(){
	require_once('lib/nusoap.php');
	header('Content-type: text/html');

	//$client = new nusoap_client('http://localhost/webservice/server_registro.php');
	$urlWebService = 'http://127.0.0.1/sisfut/WebServiceReserva/servereserva.php';
	$urlWSDL = $urlWebService . '?wsdl';

	// Creo el objeto soapclient
	$client = new nusoap_client($urlWSDL, 'wsdl');


	//$response=array();
	$response = $client->call('consulta_reserva',array('' => ''));
	$response1=json_decode($response,true);
	echo "<pre>";

	//print_r(json_decode($response));

	$codreserva=$response1['codreserva'];
	//print_r($response1['codreserva']);
	echo "<input type='text'>";
	return $codreserva;
	//$myVar = json_decode($response['nombres']);
	//print_r($myVar);	
}
echo GenerarCR();
?>