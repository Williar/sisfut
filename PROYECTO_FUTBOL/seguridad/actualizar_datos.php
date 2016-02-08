<?php
session_start();

$idpersona = $_SESSION['IDPERSONA'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$genero = $_POST['genero'];
$fechanacimiento = $_POST['fechanacimiento'];


if($nombre!='' && $apellido!='' && $direccion!='' && $telefono!='' && $fechanacimiento!=''){
	require('../conexion.php');

	$con = Conectar();
	$sql = 'UPDATE persona SET nombre=:nombre, apellido=:apellido, direccion=:direccion, telefono=:telefono, fechanacimiento=:fechanacimiento, genero=:genero WHERE idpersona=:idpersona';

	$q = $con->prepare($sql);
	$q->execute(array(':idpersona'=>$idpersona, ':nombre'=>$nombre, ':apellido'=>$apellido, ':direccion'=>$direccion, ':telefono'=>$telefono, ':fechanacimiento'=>$fechanacimiento, ':genero'=>$genero));

	$_SESSION['NOMBRE']=$nombre;

	echo 'BIEN';

}else{
	echo 'Todos los campos son obligatorios.';
}



?>
