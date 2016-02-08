<?php
require_once('lib/nusoap.php');
require("conexioncs.php");
$server = new nusoap_server;
$server->configureWSDL('RESERVA', 'urn:phpcentral');
$server->wsdl->schemaTargetNamespace = 'urn:reserva';

$server->register('consulta_reserva', array('codreserva' => 'xsd:string'), array('return' => 'xsd:string'));

 
 function consulta_reserva($cosa)
 {
  	
   	/* if(!$codreserva){
    		return new soap_fault('Client','','Sanjoy Dey!');
   	} */ 
   	
	$con = Conectar();
	$sql = $con->prepare("SELECT codreserva FROM reserva order by rand() limit 1");//preparamos nuestra sentencia SQL
	$sql->execute();//EJECUTAMOS LA SENTENCIA
	$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);//fetchAll Devuelve un array que contiene todas las filas del conjunto de resultados
	
	foreach ($resultado as $row) {// FOREACH RECORRE ARRAYS, $resultado contiene un array de la consulta
	
		
		$result = array('codreserva'=>$row['codreserva']);
	}

  	return json_encode($result);

 }

$HTTP_RAW_POST_DATA = (isset($HTTP_RAW_POST_DATA)) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
exit();

?>
