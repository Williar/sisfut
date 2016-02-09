<?php
$idreserva = $_POST['idreserva'];

require('conexion.php');

$con = Conectar();
//$sql = 'DELETE FROM cliente WHERE idcliente=:idcliente';

$sql='DELETE FROM detalle_reserva WHERE idreserva=:idreserva';
$sql2='DELETE FROM reserva WHERE idreserva=:idreserva';

$q = $con->prepare($sql);
$q2 = $con->prepare($sql2);

$q->execute(array(':idreserva'=>$idreserva));
$q2->execute(array(':idreserva'=>$idreserva));
?>