<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
<body>
     
    <center><strong><h1>IMAGENES</h1></strong></center>
    <p>
        
        <?php

        require_once ('lib/nusoap.php');
        $wsdl='http://localhost/webserviceequipos/servicio.php?wsdl';
        $cliente = new nusoap_client($wsdl, true);   

        $error = $cliente->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }     
       

        $result = $cliente->call("ListarPaises", array("dato" => "1s"));

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
                echo "<h2>PAIS</h2><pre>";
                echo "<select>
                       ".$result."
                    </select>";
                echo $result;
                echo "</pre>";
            }
        }



        $result = $cliente->call("ListarClubes", array("dato" => "1s"));

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
                echo "<h2>CLUBES</h2><pre>";
                echo "<select>
                       ".$result."
                    </select>";
                echo "</pre>";
            }
        }





        





        ?>

        
    </body>
</html>
