<?php
require 'conexion.php';


function Listar($nombre_pais){
	$con=conectar();
	
	$sql='SELECT * FROM pais WHERE nombre="'.$nombre_pais.'"';		

	$q = $con->prepare($sql);
	$q->execute();

	$rows = $q->fetchAll(\PDO::FETCH_OBJ);

	$lista = 'sss';
	
	foreach($rows as $row){
		$lista = $row->nombre;
	}

	return($lista);
}

function ListarPaises($dato){
	$con=conectar();

	$sql='SELECT * FROM pais ORDER BY nombre';		

	$q = $con->prepare($sql);
	$q->execute();

	$rows = $q->fetchAll(\PDO::FETCH_OBJ);

	$cadena = "<?xml version='1.0' encoding='utf-8'?>";


	foreach($rows as $row){
		if($row->idpais==$dato){
			$cadena.="<option selected value='".$row->idpais."'>";
		}else{
			$cadena.="<option value='".$row->idpais."'>";
		}
		
		$cadena.="<nombre>".$row->nombre."</nombre>";
		$cadena.="</option>";
	}


	$respuesta = new soapval('return','xsd:string',$cadena);
	return $respuesta;

}

function ListarClubes($dato){
	$con=conectar();

	$sql='SELECT * FROM equipo E, pais P WHERE E.idpais=P.idpais ORDER BY E.nombre_equipo';		

	$q = $con->prepare($sql);
	$q->execute();

	$rows = $q->fetchAll(\PDO::FETCH_OBJ);

	$cadena = "<?xml version='1.0' encoding='utf-8'?>";


	foreach($rows as $row){
		$cadena.="<option value='".$row->idequipo_pais."'>";
		$cadena.="<nombre>".$row->nombre_equipo."</nombre>";
		$cadena.="<pais> - ".$row->nombre."</pais>";
		$cadena.="</option>";
	}


	$respuesta = new soapval('return','xsd:string',$cadena);
	return $respuesta;

}

function ImagenClub($dato){
	$con=conectar();

	$sql='SELECT * FROM equipo WHERE idequipo_pais='.$dato;		

	$q = $con->prepare($sql);
	$q->execute();

	$rows = $q->fetchAll(\PDO::FETCH_OBJ);

	$cadena = "";


	foreach($rows as $row){
		//$cadena=$row->imagen_nomequi;
		$result = array('imagen'=>$row->imagen_nomequi,'nombre_equipo'=>$row->nombre_equipo);
	}

	//return $cadena;
	return json_encode($result);

}

function ImagenPais($dato){
	$con=conectar();

	$sql='SELECT * FROM pais WHERE idpais='.$dato;		

	$q = $con->prepare($sql);
	$q->execute();

	$rows = $q->fetchAll(\PDO::FETCH_OBJ);

	$cadena = "";


	foreach($rows as $row){
		//$cadena=$row->imagen_pais;
		$result = array('imagen'=>$row->imagen_pais,'nombre'=>$row->nombre);
	}

	//return $cadena;
	return json_encode($result);

}




	

?>