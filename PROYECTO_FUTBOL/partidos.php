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
                                    <th>Reservar</th>
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

                                        <?php
                                          if(isset($_SESSION['USER'])!=''){

                                            $sql = 'SELECT COUNT(*) FROM reserva WHERE idpersona='.$_SESSION['IDPERSONA'].' AND idpartido='.$row->idpartido;

                                            $qReservado = $con->prepare($sql);
                                            $qReservado->execute();

                                            $btnReservado = $qReservado->fetchColumn();

                                            $codigoHtml = $codigoHtml.'<div class="col-md-6"><br>';
                                              
                                              
                                            if($btnReservado>0){
                                          ?>
                                                
                                          <?php
                                            }else{
                                              ?>
                                                <a onclick="Reservar(<?php echo $row->idpartido ?>);"  title="Reservar" style="cursor: pointer;">
                                                  <span class="glyphicon glyphicon-briefcase"></span>
                                                </a>
                                            <?php
                                            }                                
                                        }
                                        ?>
                                        
                                      
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
                                                    <?php
                                                      if(isset($_SESSION['USER'])!=''){

                                                        $sql = 'SELECT COUNT(*) FROM reserva WHERE idpersona='.$_SESSION['IDPERSONA'].' AND idpartido='.$row->idpartido;

                                                        $qReservado = $con->prepare($sql);
                                                        $qReservado->execute();

                                                        $btnReservado = $qReservado->fetchColumn();

                                                        $codigoHtml = $codigoHtml.'<div class="col-md-6"><br>';
                                                          
                                                          
                                                        if($btnReservado>0){
                                                      ?>
                                                            <button class="btn btn-block btn-info" onclick=""><i class="fa fa-get-pocket"></i> Reservado</button>';
                                                      <?php
                                                        }else{
                                                          ?>
                                                            <button class="btn btn-block btn-success" onclick="Reservar(<?php echo $row->idpartido ?>);"><i class="fa fa-location-arrow"></i> Reservar</button>';
                                                        <?php
                                                        }                                
                                                    }
                                                    ?>
                                                    
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
      <?php
      foreach($rows as $row){
        ?>
      <div class="modal fade" id="modalReserva<?php echo $row->idpartido ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="modal-title" > <i>Reservas de Asientos</i></div>
            </div>
            <form role="form" action="" name="frmReserva">

              <div class="col-md-12">
                <table class="table table-striped" id="tablaSecciones<?php echo $row->idpartido ?>">
                    <thead>
                      
                        <th>#</th>
                        <th>Sección</th>
                        <th>Precio</th>
                        <th>Disponible</th>
                        <th style="width: 140px">Reservar</th>                              
                    </thead>
                    <tbody>
                      <?php

                    $sql = 'SELECT * FROM seccion';

                    $q2 = $con->prepare($sql);
                    $q2->execute();

                    $rowsSeccion = $q2->fetchAll(\PDO::FETCH_OBJ);

                    foreach($rowsSeccion as $rowSeccion){
                      $sql = 'SELECT COUNT(*) FROM asiento WHERE idseccion='.$rowSeccion->idseccion.' AND idestadio='.$row->idestadio;

                      $q3 = $con->prepare($sql);
                      $q3->execute();


                      $numTotal = $q3->fetchColumn();


                      $sql = 'SELECT COUNT(*) FROM reserva R, detalle_reserva D, asiento A WHERE R.idpartido='.$row->idpartido.' AND D.idreserva=R.idreserva AND D.idasiento=A.idasiento AND A.idseccion='.$rowSeccion->idseccion.' AND A.idestadio='.$row->idestadio;
                      $qNUm = $con->prepare($sql);
                      $qNUm->execute();


                      $numReservados = $qNUm->fetchColumn();
                      $numDisponible = $numTotal - $numReservados;

                      

                      

                       $sql = 'SELECT * FROM costo WHERE idpartido = '.$row->idpartido.'  AND idseccion = '.$rowSeccion->idseccion;
                       $q4 = $con->prepare($sql);
                       $q4->execute();

                       $rowsCosto = $q4->fetchAll(\PDO::FETCH_OBJ);

                       foreach($rowsCosto as $rowCosto){
                        ?>
                

                        <tr>
                          <td><?php echo $rowSeccion->idseccion ?></td>
                          <td><?php echo $rowSeccion->nombre ?></td>
                          <td><?php echo $rowCosto->costo ?></td>
                          <td><?php echo $numDisponible ?></td>
                          <td>
                              <input class="form-control input-sm" 
                              placeholder="Cantidad" id="<?php echo $row->idpartido ?>cantidad<?php echo $rowSeccion->idseccion ?>" 
                              type="number"  max="<?php echo $numDisponible ?>" min="0" 
                              onkeypress="return bloquearCampoNumber(event)" autofocus required>
                          </td>                                
                      </tr>
                      <?php
             }

            
          }

          ?>

                      
                   </tbody></table>
                </div>
              
            </form>
            <div class="col-lg-6">
                <span>Cada usuario puede reservar hasta <?php echo $row->maxreserva ?> asientos máximo por partido, según las políticas del estadio (<?php echo $row->nombre ?>)</span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" onClick="RegistrarReserva(<?php echo $row->idpartido ?>,<?php echo $row->maxreserva ?>); return false">
                  <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Reservar
              </button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <?php
          }
      ?>

      
     
    </section>
</div>


<script type="text/javascript">

  var idpersona = <?php  echo $_SESSION['IDPERSONA']; ?>

  function objetoAjax(){
    var xmlhttp=false;
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp = false;
      }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }

  function detallePartido(idpartido){
    $('#modal'+idpartido).modal('show');
  }

  function Reservar(idpartido){
    $('#modalReserva'+idpartido).modal('show');
  }


  function RegistrarReserva(idpartido, maxreserva){


    var listaSecciones = [];
    var listaCantidad = [];

    var tempTabla = 0;

    $('#tablaSecciones'+idpartido+' tr').each(function() {

        if(tempTabla>0){
          idseccion = $(this).find("td").eq(0).html();
          var cantidad = $("#"+idpartido+"cantidad"+idseccion).val();

          if(cantidad==''||cantidad==null){
            cantidad = 0
          } 


          listaSecciones.push(idseccion);
          listaCantidad.push(cantidad);
        }
        
        tempTabla++;

    });

   


    var cant = 0;

    for(var i=1; i<=6; i++){
      var temp = $("#"+idpartido+"cantidad"+i).val();
      if(temp==''||temp==null){
        temp = 0
      } 
      cant = cant + parseInt(temp);
    }

    
    
    if(cant>maxreserva){
      alert('EL LIMITE ES '+maxreserva);
    }else{
      if(cant!=0){
        alert('Reserva hecha');

        $('#perra').html(''+idpersona);

        ajax = objetoAjax();



        ajax.open("POST", "reserva/insertar_reserva.php", true);

        ajax.onreadystatechange=function() {
            if (ajax.readyState==4) {
              window.location.reload(true);
              //document.getElementById("perra").innerHTML = ajax.responseText;
            }
          }
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        ajax.send("idpersona="+idpersona+"&idpartido="+idpartido+"&listaSecciones="+listaSecciones+"&listaCantidad="+listaCantidad);

      }
      
    }

  }

 

  function bloquearCampoNumber(e){
   tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==-1){
      return true;
    }else{
              return false;
          }


  }
</script>


<?php
  include('pie.php');
?>