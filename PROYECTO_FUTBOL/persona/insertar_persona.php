<?php

session_start();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$genero = $_POST['genero'];
$fechanacimiento = $_POST['fechanacimiento'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];


if($nombre!='' && $apellido!='' && $direccion!='' && $telefono!='' && $fechanacimiento!='' && $email!='' && $password!='' && $password2!=''){
	
	if($password==$password2){
		require('../conexion.php');

		$con = Conectar();


		//Crear usuario
		//verificar si no existe correo
		$sql = 'SELECT COUNT(*) FROM usuario WHERE email=:email';
		$qUsuario = $con->prepare($sql);
		$qUsuario->execute(array(':email'=>$email));

		$existeCorreo = $qUsuario->fetchColumn();

		if($existeCorreo!=0){
			echo 'Esta cuenta de E-mail ya existe.';
		}else{
			
			$sql = 'INSERT INTO usuario (email, password, idrol) VALUES (:email,:password, 3)';

			$q = $con->prepare($sql);
			$q->execute(array(':email'=>$email, ':password'=>$password));


			$sql = 'SELECT * FROM usuario ORDER BY idusuario DESC LIMIT 1';

			$q2 = $con->prepare($sql);
			$q2->execute();

			$rows = $q2->fetchAll(\PDO::FETCH_OBJ);	

			$idusuario = 0;

			foreach($rows as $row){
				$idusuario = $row->idusuario;
			}




			$sql = 'INSERT INTO persona (nombre, apellido, telefono, direccion, fechanacimiento, genero, idusuario) VALUES (:nombre,:apellido,:telefono,:direccion,:fechanacimiento,:genero,:idusuario)';

			$qPersona = $con->prepare($sql);
			$qPersona->execute(array(':nombre'=>$nombre, ':apellido'=>$apellido, ':direccion'=>$direccion, ':telefono'=>$telefono, ':fechanacimiento'=>$fechanacimiento, ':genero'=>$genero, ':idusuario'=>$idusuario));

			$_SESSION['USER'] = $email;
			$_SESSION['IDUSER'] = $idusuario;
			$_SESSION['IDROL'] = 3;

			$sql = 'SELECT * FROM persona ORDER BY idpersona DESC LIMIT 1';

			$q3 = $con->prepare($sql);
			$q3->execute();

			$rows = $q3->fetchAll(\PDO::FETCH_OBJ);	

			$idpersona = 0;

			foreach($rows as $row){
				$idpersona = $row->idpersona;
			}

			$_SESSION['ROL'] = 'CLIENTE';
			$_SESSION['IDPERSONA'] = $idpersona;
			$_SESSION['NOMBRE'] = $nombre;
			

			echo 'BIEN';
		}

		


		
		

		
	}else{
		echo 'Los contraseñas no coinciden.';
	}
	

}else{
	echo 'Todos los campos son obligatorios.';
}



?>
