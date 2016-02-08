<?php
  include('cabecera.php');
  //if(isset($_SESSION['USER'])==''){

  //}else{
  //  header('Location: /PROYECTO_FUTBOL/login.php');      
  //}
  
?>
      
    

<div id="contenedor" class="content-wrapper">
<section class="content-header">
<div align="center">
<img align="center" src="img/sisfutweb.png" width="340" height="150">
</div>
      <div class="starter-template">
        <div align="center">
        <h1>MIS RESERVAS</h1>
        </div>
        <button type="button" onclick="Nuevo();" class="btn btn-success btn-md" >
          <span class="glyphicon glyphicon-user"></span> Nueva Reserva
        </button>
      </div>
<div class="panel panel-success">
        <div class="panel-heading">Partidos</div>
        <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Pais</th>
            <th>Donde se Jugara?</th>
            <th>Direccion</th>                            
              <th>Equipo Local</th>
              <th>Equipo Visitante</th>
              <th>Precio</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            <?php
            require("Conexion.php");
            $con = Conectar();  			

			$sql='SELECT partido.fecha, partido.hora, estadio.pais, estadio.localidad, estadio.direccion,
				partido.equipolocal,partido.equipovisita, reserva.precio, reserva.estado FROM reserva 
				INNER JOIN partido ON partido.idpartido=reserva.idpartido 
				INNER JOIN estadio ON partido.idestadio = estadio.idestadio
				WHERE idpersona ='.$_SESSION['IDPERSONA'].'';                

            $stmt = $con->prepare($sql);
            $result = $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
            foreach($rows as $row){
              ?>
              <tr>
              <td><?php print($row->fecha); ?></td>
              <td><?php print($row->hora); ?></td>
              <td><?php print($row->pais); ?></td>
              <td><?php print($row->localidad); ?></td>
              <td><?php print($row->direccion); ?></td>
                <td><?php print($row->equipolocal); ?></td>
                <td><?php print($row->equipovisita); ?></td>
                <td><?php print($row->precio); ?></td>
                <td><?php print($row->estado); ?></td>
                
         		<td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-xs">Seleccione</button>
                    <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      
                    </ul>
                  </div>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
        </section>-
      </div>




<?php
  include('pie.php');
?>