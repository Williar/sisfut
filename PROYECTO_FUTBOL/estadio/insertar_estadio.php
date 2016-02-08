<?php

session_start();

$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$localidad = $_POST['localidad'];
$pais = $_POST['pais'];
$capacidad = $_POST['capacidad'];
$codigo = $_POST['codigo'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];


if($nombre!='' && $localidad!='' && $direccion!='' && $capacidad!='' && $codigo!='' && $email!='' && $password!='' && $password2!=''){
	
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

			//verficar codigo

			$sqlCodigo = 'SELECT COUNT(*) FROM codigo WHERE codigo=:codigo AND estado_codigo="DISPONIBLE"';
			$qCodigo = $con->prepare($sqlCodigo);
			$qCodigo->execute(array(':codigo'=>$codigo));

			$codigoValidado = $qCodigo->fetchColumn();

			if($codigoValidado==0){
				echo 'Código no válido.';
			}else{

				$sql = 'UPDATE codigo SET estado_codigo="OCUPADO" WHERE codigo=:codigo';

				$q = $con->prepare($sql);
				$q->execute(array(':codigo'=>$codigo));


			
				$sql = 'INSERT INTO usuario (email, password, idrol) VALUES (:email,:password, 2)';

				$q = $con->prepare($sql);
				$q->execute(array(':email'=>$email, ':password'=>$password));


				$sql = 'INSERT INTO estadio (nombre, localidad, direccion, pais, capacidad) VALUES (:nombre,:localidad,:direccion,:pais,:capacidad)';

				$q = $con->prepare($sql);
				$q->execute(array(':nombre'=>$nombre, ':localidad'=>$localidad, ':direccion'=>$direccion, ':pais'=>$pais, ':capacidad'=>$capacidad));




				$sql = 'SELECT * FROM usuario ORDER BY idusuario DESC LIMIT 1';

				$q2 = $con->prepare($sql);
				$q2->execute();

				$rows = $q2->fetchAll(\PDO::FETCH_OBJ);	

				$idusuario = 0;

				foreach($rows as $row){
					$idusuario = $row->idusuario;
				}


				$sql = 'SELECT * FROM estadio ORDER BY idestadio DESC LIMIT 1';

				$q2 = $con->prepare($sql);
				$q2->execute();

				$rows = $q2->fetchAll(\PDO::FETCH_OBJ);	

				$idestadio = 0;

				foreach($rows as $row){
					$idestadio = $row->idestadio;
				}




				$sql = 'INSERT INTO detalle_usuario (idusuario, idestadio) VALUES (:idusuario,:idestadio)';

				$qPersona = $con->prepare($sql);
				$qPersona->execute(array(':idestadio'=>$idestadio, ':idusuario'=>$idusuario));



				$_SESSION['USER'] = $email;
				$_SESSION['IDUSER'] = $idusuario;
				$_SESSION['IDROL'] = 2;

				

				$_SESSION['ROL'] = 'ADMINSTRADOR';
				//$_SESSION['IDPERSONA'] = $idpersona;
				$_SESSION['NOMBRE'] = $nombre;
				

				echo 'BIEN';
			}
		}

		


		
		

		
	}else{
		echo 'Los contraseñas no coinciden.';
	}
	

}else{
	echo 'Todos los campos son obligatorios.';
}



?>
