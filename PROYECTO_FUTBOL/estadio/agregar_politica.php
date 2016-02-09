<?php

session_start();

$cantidad = $_POST['cantidad'];
$idestadio = $_SESSION['IDESTADIO'];

require('../conexion.php');
$con = Conectar();

$sql = 'UPDATE estadio SET maxreserva=:maxreserva WHERE idestadio=:idestadio';

$q = $con->prepare($sql);
$q->execute(array(':maxreserva'=>$cantidad, ':idestadio'=>$idestadio));

?>