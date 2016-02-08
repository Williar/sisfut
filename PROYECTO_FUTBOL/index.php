<?php

  include('cabecera.php');
 
  if(isset($_SESSION['IDUSER'])){
    if($_SESSION['IDROL']==2){
      header('Location: administrador.php');
    }
    
  }
  
?>



 <!-- Content Wrapper. Contains page content -->
<div  id="contenedor" class="content-wrapper">
	<section class="content-header">      
      <div align="center">
      <img align="center" src="img/sisfutweb.png" width="340" height="150">
      </div>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
       
      </ol>
    </section>

    <section class="content">


      


      <div class="row">
          <div class="col-md-12"><h2>Últimos Partidos</h2></div>


          <?php
              require('conexion.php');


              $con = Conectar();

              $sql = 'SELECT * FROM partido P, estadio E WHERE P.idestadio = E.idestadio ORDER BY P.fecha DESC LIMIT 6';

              $q = $con->prepare($sql);
              $q->execute();

              $codigoHtml = '';

              $rows = $q->fetchAll(\PDO::FETCH_OBJ);




              foreach($rows as $row){


                




                $codigoHtml =  $codigoHtml.' <div class="col-md-4">
               <div class="box box-success  box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">'.$row->fecha.' | '.$row->hora.'</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                   <div class="row">
                     <div class="col-xs-5 .col-sm-5">
                        <img src="img/emelec-escudo.jpg" width="100%">
                      </div>
                      <div class="col-xs-2 .col-sm-5" style="top:30px;">
                        <img src="img/versus.png" width="100%">
                      </div>
                      <div class="col-xs-5 .col-sm-10">
                        <img src="img/barcelona-escudo.jpg" width="100%">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                     <div class="col-xs-5 .col-sm-5">
                        <b>Estadio:</b>
                      </div>
                      <div class="col-xs-7 .col-sm-7">
                        '.$row->nombre.'
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-5 .col-sm-5">
                        <b>Eq. Local:</b>
                      </div>
                      <div class="col-xs-7 .col-sm-7 ">
                        '.$row->equipolocal.'
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-5 .col-sm-5">
                        <b>Eq. Visitante:</b>
                      </div>
                      <div class="col-xs-7 .col-sm-7">
                        '.$row->equipovisita.'
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-5 .col-sm-5">
                        <b>País:</b>
                      </div>
                      <div class="col-xs-7 .col-sm-7">
                        '.$row->pais.'
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-5 .col-sm-5">
                        <b>Localidad:</b>
                      </div>
                      <div class="col-xs-7 .col-sm-7">
                        '.$row->localidad.'
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-5 .col-sm-5">
                        <b>Fecha:</b>
                      </div>
                      <div class="col-xs-7 .col-sm-7">
                        '.$row->fecha.'
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-5 .col-sm-5">
                        <b>Hora(Local):</b>
                      </div>
                      <div class="col-xs-7 .col-sm-7">
                        '.$row->hora.'
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-5 .col-sm-5">
                        <b>Estado:</b>
                      </div>
                      <div class="col-xs-7 .col-sm-7">
                         '.$row->estado.'
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                      </div>';
                      
                         if(isset($_SESSION['USER'])!=''){

                              $sql = 'SELECT COUNT(*) FROM reserva WHERE idpersona='.$_SESSION['IDPERSONA'].' AND idpartido='.$row->idpartido;

                              $qReservado = $con->prepare($sql);
                              $qReservado->execute();

                              $btnReservado = $qReservado->fetchColumn();

                              $codigoHtml = $codigoHtml.'<div class="col-md-6"><br>';
                                
                                
                              if($btnReservado>0){
                                  $codigoHtml = $codigoHtml.'<button class="btn btn-block btn-info" onclick=""><i class="fa fa-get-pocket"></i> Reservado</button>';
                              }else{
                                  $codigoHtml = $codigoHtml.'<button class="btn btn-block btn-success" onclick="Reservar('.$row->idpartido.');"><i class="fa fa-location-arrow"></i> Reservar</button>';
                              }

                               $codigoHtml = $codigoHtml.'</div>';
                              
                          }else{
                            
                          }
                        
                      
                    $codigoHtml = $codigoHtml.'</div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
             
            </div>



            <div class="modal fade" id="modal'.$row->idpartido.'" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-title" > <i>Reservas de Asientos</i></div>
                  </div>
                  <form role="form" action="" name="frmReserva">

                    <div class="col-md-12">
                      <table class="table table-striped" id="tablaSecciones'.$row->idpartido.'">
                          <thead>
                            
                              <th>#</th>
                              <th>Sección</th>
                              <th>Precio</th>
                              <th>Disponible</th>
                              <th style="width: 140px">Reservar</th>                              
                          </thead>
                          <tbody>';

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
                      

                      $codigoHtml =  $codigoHtml.'<tr>
                                <td>'.$rowSeccion->idseccion.'</td>
                                <td>'.$rowSeccion->nombre.'</td>
                                <td>$ '.$rowCosto->costo.'</td>
                                <td>'.$numDisponible.'</td>
                                <td>
                                    <input class="form-control input-sm" 
                                    placeholder="Cantidad" id="'.$row->idpartido.'cantidad'.$rowSeccion->idseccion.'" 
                                    type="number"  max="'.$numDisponible.'" min="0" 
                                    onkeypress="return bloquearCampoNumber(event)" autofocus required>
                                </td>                                
                            </tr>';
                   }

                  
                }

                            
                         $codigoHtml =  $codigoHtml.'</tbody></table>
                      </div>
                    
                  </form>
                  <div class="col-lg-6">
                      <span>Cada usuario puede reservar hasta '.$row->maxreserva.' asientos máximo por partido, según las políticas del estadio ('.$row->nombre.')</span>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" onClick="RegistrarReserva('.$row->idpartido.','.$row->maxreserva.'); return false">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Reservar
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancel</button>
                  </div>
                </div>
              </div>
            </div>


            ';


              }

              echo $codigoHtml;
          ?>
 


      </div>

      

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

      function Reservar(idpartido){


        $('#modal'+idpartido).modal('show');
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

        alert(cant);
        
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


</script>


<script type="text/javascript">

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