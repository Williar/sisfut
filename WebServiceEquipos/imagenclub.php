<?php

$dato = $_POST['idclub'];

$result = $cliente->call("ImagenClub", array("dato" => $dato));

if ($cliente->fault) {
    echo "<h2>Fault</h2><pre>";
    print_r($result);
    echo "</pre>";
}
else {
    $error = $cliente->getError();
    if ($error) {
        echo "<h2>Error</h2><pre>" . $error . "</pre>";
    }
    else {
        echo $result;
    }
}

?>