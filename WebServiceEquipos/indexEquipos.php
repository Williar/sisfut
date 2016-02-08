<html>
    <head>    
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
<body>
     
    <center><strong><h1>IMAGENES</h1></strong></center>
    <p>
        
        <?php
        //require_once 'conexion.php';
        require("conexion.php");
        $con = conectar();
        $sql=$con->prepare('select * from equipo');        
        $sql->execute(); // ejecuta la sentencia        
        $resul=$sql->fetchAll(PDO::FETCH_ASSOC);                
        foreach ($resul as $row){            
            echo '<img src="'.$row["imagen_nomequi"].'" width="153" heigth="176"><br>';
            echo $row["nombre"]."<br>";
            echo $row["estadio"]."<br>";
            echo $row["entrenador"]."<br>";
            echo $row["ubicacion"]."<br>";            
        }        
        ?>
    </body>
</html>
