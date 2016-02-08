<?php
require_once('lib/nusoap.php');
include('funciones.php');

//instanacia al servidor
$server = new soap_server();
$ns = "urn:paiswsl";
$server->configureWSDL("Consulta Pais",$ns);
//$server->schemaTargetNamespace = $ns;
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->encode_utf8 = true;

/*
$server->register("Listar",
        array("nombre_pais" => "xsd:string"),
        array("return" => "xsd:string"),        
        $ns);
        */

$server->register("ListarPaises",
		array("dato" => "xsd:string"),
		array("return" => "xsd:string"),       
        "urn:listapaises");

$server->register("ListarClubes",
		array("dato" => "xsd:string"),
		array("return" => "xsd:string"),    
        "urn:listaclubes");

$server->register("ImagenClub",
		array("dato" => "xsd:string"),
		array("return" => "xsd:string"),      
        "urn:imagenclub");

$server->register("ImagenPais",
                array("dato" => "xsd:string"),
                array("return" => "xsd:string"),       
        "urn:imagenpais");

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>