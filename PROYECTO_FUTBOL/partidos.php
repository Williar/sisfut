<?php


  include('cabecera.php');
?>



 <!-- Content Wrapper. Contains page content -->
<div  id="contenedor" class="content-wrapper">
	<section class="content-header">
      <div align="center">
      <img align="center" src="img/sisfutweb.png" width="340" height="150">
      </div>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-soccer-ball-o"></i> Todos los partidos</a></li>
       
      </ol>
    </section>

    <section class="content">
      <div class="row">
        
        <div class="col-md-12">
            <div class="box-body">
                          <div class="box">
                            <div class="box-header">
                              <h3 class="box-title"><b><i class="fa fa-soccer-ball-o"></i> Todos los Partidos</b></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Partido</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estadio</th>
                                    <th>Estado</th>
                                    <th>Ver</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <?php

                                    require('conexion.php');
                                    $con = Conectar();
                                    
                                    $sql = 'SELECT * FROM partido P, estadio E WHERE P.idestadio=E.idestadio';
                                    $q2 = $con->prepare($sql);
                                    $q2->execute();

                                    $rows = $q2->fetchAll(\PDO::FETCH_OBJ); 


                                    foreach($rows as $row){
                                     
                                    
                                  ?>
                                  <tr>
                                    <td><?php echo $row->idpartido ?></td>
                                    <?php
                                      if($row->idseccionpartido==1){
                                        require_once ('lib/nusoap.php');
                                        $wsdl='http://localhost/sisfut/webserviceequipos/servicio.php?wsdl';
                                        $cliente = new nusoap_client($wsdl, true);   


                                        $dato = $row->equipolocal;
                                        $result = $cliente->call("ImagenClub", array("dato" => $dato));
                                        $response=json_decode($result,true);

                                        $dato2 = $row->equipovisita;
                                        $result2 = $cliente->call("ImagenClub", array("dato" => $dato2));
                                        $response2=json_decode($result2,true);

                                        

                                      ?>

                                      <td align="center">
                                        <div style="display:none;"><?php echo $response['nombre']?></div>
                                        <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response['imagen'] ?>" 
                                        width="20px" title="<?php echo $response['nombre']?>">
                                         VS  
                                        <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response2['imagen'] ?>"
                                         width="20px" title="<?php echo $response2['nombre']?>">
                                        <div style="display:none;"><?php echo $response2['nombre']?></div>
                                      </td>
                                      

                                      <?php
                                      }else{
                                        require_once ('lib/nusoap.php');
                                        $wsdl='http://localhost/sisfut/webserviceequipos/servicio.php?wsdl';
                                        $cliente = new nusoap_client($wsdl, true);   


                                        $dato = $row->equipolocal;
                                        $result = $cliente->call("ImagenPais", array("dato" => $dato));
                                        $response=json_decode($result,true);

                                        $dato2 = $row->equipovisita;
                                        $result2 = $cliente->call("ImagenPais", array("dato" => $dato2));
                                        $response2=json_decode($result2,true);

                                      ?>

                                      <td align="center">
                                        <div style="display:none;"><?php echo $response['nombre']?></div>
                                        <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response['imagen'] ?>" 
                                        width="20px" title="<?php echo $response['nombre']?>">
                                         VS  
                                        <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response2['imagen'] ?>" 
                                        width="20px" title="<?php echo $response2['nombre']?>">
                                        <div style="display:none;"><?php echo $response2['nombre']?></div>
                                      </td>
                                        
                                      <?php
                                      }

                                      $dato = $row->equipolocal;
                                      $resultpais = $cliente->call("ImagenPais", array("dato" => $row->pais));
                                      $responsepais=json_decode($resultpais,true);
                                    ?>


                                    
                                    
                                    <td><?php echo $row->fecha ?></td>
                                    <td><?php echo $row->hora ?></td>
                                    <td><?php echo $row->nombre ?></td>
                                    <td><?php echo $row->estado ?></td>
                                    <td> 
                                      <div class="btn-group">
                                        <a onclick="detallePartido(<?php echo $row->idpartido ?>);"  title="Detalle del Partido" style="cursor: pointer;">
                                          <span class="glyphicon glyphicon-search"></span>
                                        </a>
                                      
                                      </div>
                                    </td>

                                  </tr>

                                  <div class="example-modal" >
                                    <div class="modal modal-info" id="modal<?php echo $row->idpartido ?>">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="col-md-12">
                                           <div class="box box-success  box-solid">
                                            <div class="box-header with-border">
                                              <h3 class="box-title"><?php echo $row->fecha.' | '.$row->hora ?></h3>
                                              <div class="box-tools pull-right">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                              </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                               <div class="row">
                                                 <div class="col-xs-5 .col-sm-5">
                                                    <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response['imagen']?>" width="100%">
                                                  </div>
                                                  <div class="col-xs-2 .col-sm-5" style="top:30px;">
                                                    <img src="img/versus.png" width="100%">
                                                  </div>
                                                  <div class="col-xs-5 .col-sm-10">
                                                    <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response2['imagen']?>" width="100%">
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                 <div class="col-xs-5 .col-sm-5">
                                                    <b>Estadio:</b>
                                                  </div>
                                                  <div class="col-xs-7 .col-sm-7">
                                                    <?php echo $row->nombre ?>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-xs-5 .col-sm-5">
                                                    <b>Eq. Local:</b>
                                                  </div>
                                                  <div class="col-xs-7 .col-sm-7 ">
                                                    <?php echo $response['nombre'] ?>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-xs-5 .col-sm-5">
                                                    <b>Eq. Visitante:</b>
                                                  </div>
                                                  <div class="col-xs-7 .col-sm-7">
                                                    <?php echo $response2['nombre'] ?>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-xs-5 .col-sm-5">
                                                    <b>País:</b>
                                                  </div>
                                                  <div class="col-xs-7 .col-sm-7">
                                                    <?php echo $responsepais['nombre'] ?>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-xs-5 .col-sm-5">
                                                    <b>Localidad:</b>
                                                  </div>
                                                  <div class="col-xs-7 .col-sm-7">
                                                    <?php echo $row->localidad ?>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-xs-5 .col-sm-5">
                                                    <b>Fecha:</b>
                                                  </div>
                                                  <div class="col-xs-7 .col-sm-7">
                                                    <?php echo $row->fecha ?>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-xs-5 .col-sm-5">
                                                    <b>Hora(Local):</b>
                                                  </div>
                                                  <div class="col-xs-7 .col-sm-7">
                                                    <?php echo $row->hora ?>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-xs-5 .col-sm-5">
                                                    <b>Estado:</b>
                                                  </div>
                                                  <div class="col-xs-7 .col-sm-7">
                                                    <?php echo $row->estado ?>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-3">
                                                  </div>
                                                  <div class="col-md-6">
                                                    <br>
                                                    <button class="btn btn-block btn-success"><i class="fa fa-location-arrow"></i> Reservar</button>
                                                  </div>
                                                  
                                                </div>
                                            </div><!-- /.box-body -->
                                          </div><!-- /.box -->
                                         
                                        </div>
                                        </div><!-- /.modal-content -->
                                      </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                  </div>
                                  <?php
                                    }
                                  ?>
                                  
                                </tbody>
                                
                              </table>
                            </div><!-- /.box-body -->
                          </div><!-- /.box -->
                        </div>
        </div>


        
      </div>

      
     
    </section>
</div>


<script type="text/javascript">

  function detallePartido(idpartido){
    $('#modal'+idpartido).modal('show');
  }
</script>


<?php
  include('pie.php');
?>