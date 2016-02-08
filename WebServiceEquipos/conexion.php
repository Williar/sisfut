<?php
function conectar(){
	$conexion = null;
	$host = '127.0.0.1'; //tambien puede ir localhost
	$db = 'ws_reserva'; //nombre de la base de datos
	$user = 'root'; //usuario de la base de datos
	$password = ''; //password de la base de datos

	try{
		$conexion = new PDO('mysql:host='.$host.';dbname='.$db,$user,$password);
	}
	catch(PDOException $e){
		echo "Error: ". $e -> getMessage();
	}
	return $conexion; //aqui es donde la funcion retorna la funcion PDO
}


?>