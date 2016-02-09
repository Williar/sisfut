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


require('../conexion.php');
$con = Conectar();

$sql = 'SELECT * FROM partido WHERE idestadio=:idestadio AND fecha=:fecha AND hora=:hora';
$q = $con->prepare($sql);
$q->execute(array(':idestadio'=>$idestadio, ':fecha'=>$fecha, ':hora'=>$hora));

$rows = $q->fetchAll(\PDO::FETCH_OBJ);	

$programado = false;

foreach($rows as $row){
	$programado = true;
	echo 'Ya hay un partido programado: '.$row->fecha.' --- '.$row->hora;
}

if(!$programado){

	$sql2 = 'INSERT INTO partido (fecha, hora, equipolocal, equipovisita, arbitro, idestadio, idtipopartido, estado) 
	VALUES (:fecha,:hora,:equipolocal,:equipovisita,:arbitro, :idestadio, :idtipopartido, :estado)';

	$q2 = $con->prepare($sql2);
	$q2->execute(array(':fecha'=>$fecha, ':hora'=>$hora, ':equipolocal'=>$equipolocal, 
		':equipovisita'=>$equipovisita,':arbitro'=>$arbitro, ':idestadio'=>$idestadio, 
		':idtipopartido'=>$tipo, ':estado'=>'HABILITADO'));

	
	$sql = 'SELECT * FROM partido ORDER BY idpartido DESC LIMIT 1';

	$q = $con->prepare($sql);
	$q->execute();

	$rows = $q->fetchAll(\PDO::FETCH_OBJ);	

	$idpartido = 0;
	foreach($rows as $row){
		$idpartido = $row->idpartido;
	}

	

	if($precioVIP!='undefined'){
		$sql = 'INSERT INTO costo (costo, idpartido, idseccion) VALUES (:costo,:idpartido,1)';
		$q = $con->prepare($sql);
		$q->execute(array(':costo'=>$precioVIP, ':idpartido'=>$idpartido));
	}

	if($precioPalco!='undefined'){
		$sql = 'INSERT INTO costo (costo, idpartido, idseccion) VALUES (:costo,:idpartido,2)';
		$q = $con->prepare($sql);
		$q->execute(array(':costo'=>$precioPalco, ':idpartido'=>$idpartido));
	}

	if($precioPreferencial!='undefined'){
		$sql = 'INSERT INTO costo (costo, idpartido, idseccion) VALUES (:costo,:idpartido,3)';
		$q = $con->prepare($sql);
		$q->execute(array(':costo'=>$precioPreferencial, ':idpartido'=>$idpartido));
	}

	if($precioTribuna!='undefined'){
		$sql = 'INSERT INTO costo (costo, idpartido, idseccion) VALUES (:costo,:idpartido,4)';
		$q = $con->prepare($sql);
		$q->execute(array(':costo'=>$precioTribuna, ':idpartido'=>$idpartido));
	}

	if($precioGeneral!='undefined'){
		$sql = 'INSERT INTO costo (costo, idpartido, idseccion) VALUES (:costo,:idpartido,5)';
		$q = $con->prepare($sql);
		$q->execute(array(':costo'=>$precioGeneral, ':idpartido'=>$idpartido));
	}



	echo 'BIEN';

	
}










?>