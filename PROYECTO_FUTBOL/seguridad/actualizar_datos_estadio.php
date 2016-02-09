<?php
session_start();

$idestadio = $_SESSION['IDESTADIO'];
$nombre = $_POST['nombre'];
$localidad = $_POST['localidad'];
$direccion = $_POST['direccion'];
$pais = $_POST['pais'];



if($nombre!='' && $localidad!='' && $direccion!=''){
	require('../conexion.php');

	$con = Conectar();
	$sql = 'UPDATE estadio SET nombre=:nombre, localidad=:localidad, direccion=:direccion, pais=:pais WHERE idestadio=:idestadio';

	$q = $con->prepare($sql);
	$q->execute(array(':idestadio'=>$idestadio, ':nombre'=>$nombre, ':localidad'=>$localidad, ':direccion'=>$direccion, ':pais'=>$pais));

	$_SESSION['NOMBRE']=$nombre;

	echo 'BIEN';

}else{
	echo 'Todos los campos son obligatorios.';
}



?>
