<?php
function Conectar(){
  $conn = null;
  $host = '127.0.0.1';
  $db = 'reserva';
  $user = 'root';
  $pwd = '';
  try {
    $conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd);
  }catch(PDOException $e){
    echo ':( Error al conectar con la base de datos '.$e;
    exit;
  }
  return $conn;
}
?>
