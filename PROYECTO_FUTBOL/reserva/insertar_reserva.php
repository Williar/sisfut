	<?php

$idpersona = $_POST['idpersona'];
$idpartido = $_POST['idpartido'];

$listaSecciones = $_POST['listaSecciones'];
$listaCantidad = $_POST['listaCantidad'];

$listaSecciones = explode(',',$listaSecciones); 
$listaCantidad = explode(',',$listaCantidad); 


$precio = 0;
$estado = 'PENDIENTE';	
require('../conexion.php');


$con = Conectar();


$crearReserva = False;	



for ($i = 0; $i < count($listaSecciones); $i++) {

	$idseccion = $listaSecciones[$i];


	echo $idseccion.'-----'.$listaCantidad[$i];

	$sql = 'SELECT * FROM partido WHERE idpartido='.$idpartido;
	$qEstadio = $con->prepare($sql);
	$qEstadio->execute();

	$idestadio = 0;

	$rowsEstadio = $qEstadio->fetchAll(\PDO::FETCH_OBJ);
	foreach($rowsEstadio as $rowEstadio){
		$idestadio = $rowEstadio->idestadio;
	}

	$sql = 'SELECT COUNT(*) FROM asiento WHERE idseccion='.$idseccion.' AND idestadio='.$idestadio;

	$qTotal = $con->prepare($sql);
	$qTotal->execute();


	$numTotal = $qTotal->fetchColumn();


	//HALLAR VALOR - PRECIO TOTAL
	$sql = 'SELECT * FROM costo WHERE idseccion='.$idseccion.' AND idpartido='.$idpartido;

	$qCosto = $con->prepare($sql);
	$qCosto->execute();

	$costo = 0;

	$rowsCosto = $qCosto->fetchAll(\PDO::FETCH_OBJ);
	foreach($rowsCosto as $rowCosto){
		$costo = $rowCosto->costo;
	}

	$precio = $precio + ($costo*$listaCantidad[$i]);
	//FIN 


	$sql = 'SELECT COUNT(*) FROM reserva R, detalle_reserva D, asiento A WHERE R.idpartido='.$idpartido.' AND D.idreserva=R.idreserva  AND D.idasiento=A.idasiento AND A.idseccion='.$idseccion.' AND A.idestadio='.$idestadio;
	$qNUm = $con->prepare($sql);
	$qNUm->execute();


	$numReservados = $qNUm->fetchColumn();
	$numDisponible = $numTotal - $numReservados;

	if($numDisponible>=$listaCantidad[$i]){
		$crearReserva = True;
	}else{
		$crearReserva = False;
	}

}
	
if($crearReserva){					
	
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
	//echo "<pre>";

	//print_r(json_decode($response));

	$codreserva=$response1['codreserva'];
		
	

	$sql = 'INSERT INTO reserva (idpersona, idpartido, precio , estado, codreserva) VALUES (:idpersona, :idpartido, :precio, :estado, :codreserva)';
	$q = $con->prepare($sql);
		
	$q->execute(array(':idpersona'=>$idpersona, ':idpartido'=>$idpartido, ':precio'=>$precio, ':estado'=>$estado, ':codreserva'=>$codreserva));

	$sql = 'SELECT * FROM reserva ORDER BY idreserva DESC LIMIT 1';

	$q2 = $con->prepare($sql);
	$q2->execute();

	$rows = $q2->fetchAll(\PDO::FETCH_OBJ);	

	$idreserva = 0;



	foreach($rows as $row){

		$idreserva = $row->idreserva;


		for ($i = 0; $i < count($listaSecciones); $i++) {

			$idseccion = $listaSecciones[$i];
			$cantidad = $listaCantidad[$i];


			if($cantidad>0){

				$sql = 'SELECT COUNT(*) FROM reserva R, detalle_reserva D, asiento A WHERE R.idpartido='.$idpartido.'  AND D.idreserva=R.idreserva AND D.idasiento=A.idasiento AND A.idseccion='.$idseccion.' AND A.idestadio='.$idestadio;
				$qNUm2 = $con->prepare($sql);
				$qNUm2->execute();


				$numReservados = $qNUm2->fetchColumn();

				if($numReservados>0){
			      $sql = "SELECT * FROM asiento WHERE idestadio=".$idestadio." AND idseccion=".$idseccion ." AND idasiento != (SELECT A.idasiento FROM reserva R, detalle_reserva D, asiento A WHERE R.idpartido=".$idpartido." AND D.idasiento=A.idasiento AND A.idseccion=".$idseccion." AND A.idestadio=".$idestadio.") ORDER BY idasiento";
			  
			    }else{
			      $sql = "SELECT * FROM asiento WHERE idestadio=".$idestadio." AND idseccion=".$idseccion." ORDER BY idasiento";
			    }

			    $qAsientos = $con->prepare($sql);
			    $qAsientos->execute();
			    $rowsAsientos = $qAsientos->fetchAll(\PDO::FETCH_OBJ);

			    
			  	$temp = 0;
			    foreach($rowsAsientos as $rowAsientos){	  

			    	if($temp<$cantidad){
			    		$idasiento = $rowAsientos->idasiento;
					    $sql = 'INSERT INTO detalle_reserva (idreserva, idasiento) VALUES (:idreserva, :idasiento)';
						$q3 = $con->prepare($sql);
						$q3->execute(array(':idreserva'=>$idreserva, ':idasiento'=>$idasiento));
			    	}
			    	echo 'PEDO'.$temp;

			    	$temp++;
			      
			    }

				
			}


			


		}
	}

	echo 'Reserva efectuada correctamente. Revise su lista de reservaciones.';


}else{
	echo 'No se pudo crear la reservación. Inténtelo nuevamente.';
}














?>
