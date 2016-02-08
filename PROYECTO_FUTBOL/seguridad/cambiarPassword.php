<?php
session_start();

$idusuario = $_SESSION['IDUSER'];
$password = $_POST['password'];
$passwordnueva = $_POST['passwordnueva'];
$passwordnueva2 = $_POST['passwordnueva2'];


if($passwordnueva!='' && $passwordnueva2!='' && $password!=''){

	require('../conexion.php');
	$con = Conectar();

	$sql = 'SELECT * FROM usuario WHERE idusuario=:idusuario';
	$qUsuario = $con->prepare($sql);
	$qUsuario->execute(array(':idusuario'=>$idusuario));

	$passwordActual = '';


	$rowsUsuario = $qUsuario->fetchAll(\PDO::FETCH_OBJ);
	foreach($rowsUsuario as $rowUsuario){
		$passwordActual = $rowUsuario->password;
	}

	if($password==$passwordActual){

		if($passwordnueva==$passwordnueva2){

			$sql = 'UPDATE usuario SET password=:password WHERE idusuario=:idusuario';

			$q = $con->prepare($sql);
			$q->execute(array(':idusuario'=>$idusuario, ':password'=>$passwordnueva));

			echo 'BIEN';

		}else{
			echo 'Contraseñas nuevas, no coinciden.';
		}


	}else{
		echo 'Contraseña Actual Incorrecta.';
	}


	
	

}else{
	echo 'Todos los campos son obligatorios.';
}



?>
