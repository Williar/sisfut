<?php

require_once('lib/nusoap.php');
header('Content-type: text/html');

//$client = new nusoap_client('http://localhost/webservice/server_registro.php');
$urlWebService = 'http://localhost/PROYECTO_FUTBOL/WebServiceEquipos/servereserva.php';
$urlWSDL = $urlWebService . '?wsdl';

// Creo el objeto soapclient
$client = new nusoap_client($urlWSDL, 'wsdl');


//$response=array();
$response = $client->call('consulta_reserva',array('' => ''));
$response1=json_decode($response,true);
echo "<pre>";

//print_r(json_decode($response));


print_r($response1['codreserva']);


//$myVar = json_decode($response['nombres']);
//print_r($myVar);
?>