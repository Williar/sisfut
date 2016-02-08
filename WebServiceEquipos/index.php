<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
<body>
     
    <center><strong><h1>IMAGENES</h1></strong></center>
    <p>
        
        <?php
        
        require("conexion.php");
        $con = conectar();
        $sql=$con->prepare('select * from pais');
        $sql->execute(); // ejecuta la sentencia
        $resul=$sql->fetchAll(PDO::FETCH_ASSOC);
        //$sql=  mysql_query("select * from pais");
        foreach ($resul as $row){            
            echo '<img src="'.$row["imagen_pais"].'" width="128" heigth="85"><br>';
            echo $row["nombre"]."<br>";
            echo $row["entrenador_pais"]."<br>";
            echo $row["estadio_pais"]."<br>";
        }
        ?>
    </body>
</html>
