<?php
session_start();

$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$tipo = $_POST['tipo'];
$seccion = $_POST['seccion'];
$arbitro = $_POST['arbitro'];
$equipolocal = $_POST['equipolocal'];
$equipovisita = $_POST['equipovisita'];


$precioVIP = $_POST['precioVIP'];
$precioPalco = $_POST['precioPalco'];
$precioPreferencial = $_POST['precioPreferencial'];
$precioTribuna = $_POST['precioTribuna'];
$precioGeneral = $_POST['precioGeneral'];

$idestadio = $_SESSION['IDESTADIO'];
$idpartido = $_POST['idpartido'];


require('../conexion.php');
$con = Conectar();

$sql = 'SELECT * FROM partido WHERE idestadio=:idestadio AND fecha=:fecha AND hora=:hora AND idpartido!=:idpartido';
$q = $con->prepare($sql);
$q->execute(array(':idestadio'=>$idestadio, ':fecha'=>$fecha, ':hora'=>$hora, ':idpartido'=>$idpartido));

$rows = $q->fetchAll(\PDO::FETCH_OBJ);	

$programado = false;

foreach($rows as $row){
	$programado = true;
	echo 'Ya hay un partido programado: '.$row->fecha.' --- '.$row->hora;
}

if(!$programado){

	$sql2 = 'UPDATE partido SET fecha=:fecha, hora=:hora, equipolocal=:equipolocal, equipovisita=:equipovisita, arbitro=:arbitro, idestadio=:idestadio, idseccionpartido=:idseccionpartido,idtipopartido=:idtipopartido, estado=:estado WHERE idpartido=:idpartido';

	$q2 = $con->prepare($sql2);
	$q2->execute(array(':fecha'=>$fecha, ':hora'=>$hora, ':equipolocal'=>$equipolocal, 
		':equipovisita'=>$equipovisita,':arbitro'=>$arbitro, ':idestadio'=>$idestadio, ':idseccionpartido'=>$seccion,
		':idtipopartido'=>$tipo, ':estado'=>'HABILITADO', ':idpartido'=>$idpartido));

	

	if($precioVIP!='undefined'){
		$sql = 'UPDATE costo SET costo=:costo WHERE idpartido=:idpartido AND idseccion=1';
		$q = $con->prepare($sql);
		$q->execute(array(':costo'=>$precioVIP, ':idpartido'=>$idpartido));
	}

	if($precioPalco!='undefined'){
		$sql = 'UPDATE costo SET costo=:costo WHERE idpartido=:idpartido AND idseccion=2';
		$q = $con->prepare($sql);
		$q->execute(array(':costo'=>$precioPalco, ':idpartido'=>$idpartido));
	}

	if($precioPreferencial!='undefined'){
		$sql = 'UPDATE costo SET costo=:costo WHERE idpartido=:idpartido AND idseccion=3';
		$q = $con->prepare($sql);
		$q->execute(array(':costo'=>$precioPreferencial, ':idpartido'=>$idpartido));
	}

	if($precioTribuna!='undefined'){
		$sql = 'UPDATE costo SET costo=:costo WHERE idpartido=:idpartido AND idseccion=4';
		$q = $con->prepare($sql);
		$q->execute(array(':costo'=>$precioTribuna, ':idpartido'=>$idpartido));
	}

	if($precioGeneral!='undefined'){
		$sql = 'UPDATE costo SET costo=:costo WHERE idpartido=:idpartido AND idseccion=5';
		$q = $con->prepare($sql);
		$q->execute(array(':costo'=>$precioGeneral, ':idpartido'=>$idpartido));
	}



	echo 'BIEN';

	
}










?>