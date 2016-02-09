<?php

session_start();

$cantidadVIP = $_POST['cantidadVIP'];
$cantidadPalco = $_POST['cantidadPalco'];
$cantidadPreferencial = $_POST['cantidadPreferencial'];
$cantidadTribuna = $_POST['cantidadTribuna'];
$cantidadGeneral = $_POST['cantidadGeneral'];

$idestadio = $_SESSION['IDESTADIO'];


require('../conexion.php');
$con = Conectar();

$temp = 0;

for($i=0;$i<$cantidadVIP;$i++){
	$temp ++;
	$nroasiento = "E-".$temp;
	$sql = 'INSERT INTO asiento (nroasiento, idseccion, idestadio) VALUES (:nroasiento, 1, :idestadio)';
	$q = $con->prepare($sql);
	$q->execute(array(':nroasiento'=>$nroasiento, ':idestadio'=>$idestadio));
}

for($i=0;$i<$cantidadPalco;$i++){
	$temp ++;
	$nroasiento = "E-".$temp;
	$sql = 'INSERT INTO asiento (nroasiento, idseccion, idestadio) VALUES (:nroasiento, 2, :idestadio)';
	$q = $con->prepare($sql);
	$q->execute(array(':nroasiento'=>$nroasiento, ':idestadio'=>$idestadio));
}

for($i=0;$i<$cantidadPreferencial;$i++){
	$temp ++;
	$nroasiento = "E-".$temp;
	$sql = 'INSERT INTO asiento (nroasiento, idseccion, idestadio) VALUES (:nroasiento, 3, :idestadio)';
	$q = $con->prepare($sql);
	$q->execute(array(':nroasiento'=>$nroasiento, ':idestadio'=>$idestadio));
}

for($i=0;$i<$cantidadTribuna;$i++){
	$temp ++;
	$nroasiento = "E-".$temp;
	$sql = 'INSERT INTO asiento (nroasiento, idseccion, idestadio) VALUES (:nroasiento, 4, :idestadio)';
	$q = $con->prepare($sql);
	$q->execute(array(':nroasiento'=>$nroasiento, ':idestadio'=>$idestadio));
}

for($i=0;$i<$cantidadGeneral;$i++){
	$temp ++;
	$nroasiento = "E-".$temp;
	$sql = 'INSERT INTO asiento (nroasiento, idseccion, idestadio) VALUES (:nroasiento, 5, :idestadio)';
	$q = $con->prepare($sql);
	$q->execute(array(':nroasiento'=>$nroasiento, ':idestadio'=>$idestadio));
}







?>
