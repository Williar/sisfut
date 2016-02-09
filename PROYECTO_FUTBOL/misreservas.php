<?php
  include('cabecera.php');
  if(isset($_SESSION['USER'])==''){

  }else{
    header('Location: /login.php');      
  }
  
?>      

<script type="text/javascript" src="js/ajax_reserva.js"></script>
<div id="contenedor" class="content-wrapper">
<section class="content-header">
<div align="center">
<img align="center" src="img/sisfutweb.png" width="340" height="150">
</div>
      <div class="starter-template">
        <!--<button type="button" onclick="Nuevo();" class="btn btn-success btn-md" >
          <span class="glyphicon glyphicon-user"></span> Nueva Reserva
        </button>-->
      </div>
<div class="panel panel-success">
        <div class="panel-heading">Reservas Pendientes</div>
        <div class="panel-body">
        <div class="box-body">
                          <div class="box">
                            <div class="box-header">
                              <h3 class="box-title"><b>Mis Reservas</b></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">


        <table class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Cod. Reserva</th>
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

			$sql='SELECT reserva.idreserva, partido.fecha, partido.hora, reserva.codreserva, estadio.localidad, estadio.direccion,
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
              <td><?php print($row->codreserva); ?></td>
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
                      <li><a onclick="EliminarReserva('<?php print($row->idreserva); ?>');">Eliminar</a></li>
                      <li><a onclick="EditarReserva('');">Actualizar</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
        </div><!-- /.box-body -->
                          </div><!-- /.box -->
        </section>
      </div>




<?php
  include('pie.php');
?>