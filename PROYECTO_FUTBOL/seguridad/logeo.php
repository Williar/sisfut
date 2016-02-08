<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

require('../conexion.php');


$con = Conectar();
$sql = 'SELECT * FROM usuario WHERE email=:email';

$q = $con->prepare($sql);
$q->execute(array(':email'=>$email));


$mensaje = 'Usuario no existe';



$rows = $q->fetchAll(\PDO::FETCH_OBJ);

foreach($rows as $row){
	if(($row->password)==$password){
		$mensaje = 'BIENVENIDO';
		$_SESSION['USER'] = $email;
		$_SESSION['IDUSER'] = $row->idusuario;
		$_SESSION['IDROL'] = $row->idrol;

		$sql = 'SELECT * FROM rol WHERE idrol=:idrol';

		$q2 = $con->prepare($sql);
		$q2->execute(array(':idrol'=>$_SESSION['IDROL']));

		$rowsRol = $q2->fetchAll(\PDO::FETCH_OBJ);

		foreach($rowsRol as $rowRol){
			$_SESSION['ROL'] = $rowRol->nombre;
		}

		if($_SESSION['IDROL']>2){
			$sql = 'SELECT * FROM persona WHERE idusuario=:idusuario';
			$q3 = $con->prepare($sql);
			$q3->execute(array(':idusuario'=>$_SESSION['IDUSER']));

			$rowsPersona = $q3->fetchAll(\PDO::FETCH_OBJ);

			foreach($rowsPersona as $rowPersona){
				$_SESSION['IDPERSONA'] = $rowPersona->idpersona;
				$_SESSION['NOMBRE'] = $rowPersona->nombre;
			}

		}else{
			if($_SESSION['IDROL']==2){
				$sql = 'SELECT * FROM detalle_usuario WHERE idusuario=:idusuario';
				$q3 = $con->prepare($sql);
				$q3->execute(array(':idusuario'=>$_SESSION['IDUSER']));

				$rowsDetalleUsuario = $q3->fetchAll(\PDO::FETCH_OBJ);


				foreach($rowsDetalleUsuario as $rowDetalleUsuario){
					$_SESSION['IDESTADIO'] = $rowDetalleUsuario->idestadio;
				}

				$sql = 'SELECT * FROM estadio WHERE idestadio=:idestadio';
				$q4 = $con->prepare($sql);
				$q4->execute(array(':idestadio'=>$_SESSION['IDESTADIO']));

				$rowsEstadio = $q4->fetchAll(\PDO::FETCH_OBJ);


				foreach($rowsEstadio as $rowEstadio){
					$_SESSION['NOMBRE'] = $rowEstadio->nombre;
				}


			}
		}

		


		

	}else{
		$mensaje = 'Contraseña Incorrecta';
	}
}

echo $mensaje;


?>
