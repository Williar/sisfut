<?php
$idcliente = $_POST['idcliente'];

$cedula = $_POST['cedula'];

$nombre = $_POST['nombre'];

$apellido = $_POST['apellido'];

$direccion = $_POST['direccion'];

$telefono = $_POST['telefono'];

$correo = $_POST['correo'];

$tipocliente = $_POST['tipocliente'];

require('conexion.php');
$con = Conectar();

$sql = 'UPDATE cliente SET cedula=:cedula, nombre=:nombre, apellido=:apellido, direccion=:direccion, 
telefono=:telefono, correo=:correo, tipocliente=:tipocliente WHERE idcliente=:idcliente';

$q = $con->prepare($sql);

$q->execute(array(':idcliente'=>$idcliente,':cedula'=>$cedula, ':nombre'=>$nombre, ':apellido'=>$apellido, ':direccion'=>$direccion, ':telefono'=>$telefono, 
	':correo'=>$correo, ':tipocliente'=>$tipocliente));
?>
