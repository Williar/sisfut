<?php
  include('cabecera.php');

  if(isset($_SESSION['USER'])==''){
  		header('Location: login.php');
  }else{
    if($_SESSION['IDROL']!=2){
    	header('Location: index.php');
    }else{
      require('conexion.php');
      $con = Conectar();


      $sql = 'SELECT COUNT(*) FROM asiento WHERE idestadio=:idestadio';
      $q = $con->prepare($sql);
      $q->execute(array(':idestadio'=>$_SESSION['IDESTADIO']));

      $existe = $q->fetchColumn();

      $sql = 'SELECT * FROM estadio WHERE idestadio='.$_SESSION['IDESTADIO'].'';

      $q2 = $con->prepare($sql);
      $q2->execute();

      $rows = $q2->fetchAll(\PDO::FETCH_OBJ); 

      $maxreserva = 0;

      foreach($rows as $row){
        $maxreserva = $row->maxreserva;
      }





    }
  }

  if($existe==0 || $maxreserva==''){
    ?>
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div align="center"><h3>Administración de Partidos</h3></div>
          <div class="callout callout-info">
            <h4>Recuerde:</h4>
            <p align="justify">Para poder crear un partido, primero debe establecer los Asientos y Política del Estadio.</p>
          </div>
          <div class="row">
            <div class="col-md-6">
              <button type="submit" class="btn btn-block btn-lg btn-success" onclick="window.location='asientos.php'"><i class="fa fa"></i> Establecer Asientos</button>
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-block btn-lg btn-success" onclick="window.location='politica.php'"><i class="fa fa"></i> Establecer Política</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <?php
        
  }else{


?>



 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <br>
           <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div align="center"><h3>Administración de Partidos</h3></div>
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Crear Partido</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Ver Partidos</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="box box-success">
                      <div class="box-header with-border">
                        <h3 class="box-title"><i>Nuevo Partido</i></h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <form role="form" name="frmNuevoPartido">
                            <fieldset>

                                <div id="mensajeFrmNuevoPartido">

                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Fecha</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input name="fecha" type="date" class="form-control">
                                    </div>
                                  </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                      <label>Hora:</label>
                                      <div class="input-group">
                                        <input type="text" class="form-control timepicker" name="hora">
                                        <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                        </div>
                                      </div><!-- /.input group -->
                                    </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                   	<div class="form-group">
                                      <label>Tipo de Partido</label>
                                      <select class="form-control select2"  name="tipopartido" style="width: 100%;" >
                                        <option value="1">Amistoso</option>
                                        <option value="2">Campeonato Nacional</option>
                                        <option value="3">Campeonato Internacional</option>
                                      </select>
                                    </div>
                                   </div>
                                </div>

                                <div class="row">
                                	<div class="col-md-4">
                                		<div class="form-group">
	                                      <label>Sección</label>
	                                      <select class="form-control select2"  name="seccion" style="width: 100%;" onchange="cambiarListaPaisClub();">
	                                        <option value="1">Clubes</option>
	                                        <option value="2">Países</option>
	                                      </select>
	                                    </div>
                                   </div>
                                	
                                	<div class="col-md-8">
                                		<div class="form-group">
		                                    <label>Árbitro</label>
		                                    <input class="form-control" placeholder="Árbitro o Juez" name="arbitro" type="text" autofocus>
		                                </div>
                                	</div>
                            	</div>

                                <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                  <label>Equipo Local</label>
                                  <select class="form-control select2" name="equipolocal" id="equipolocal" style="width: 100%;" onchange="cambiarImagenEquipoLocal();">
                                    <?php
                                      require_once ('lib/nusoap.php');
                                      $wsdl='http://localhost/sisfut/webserviceequipos/servicio.php?wsdl';
                                      $cliente = new nusoap_client($wsdl, true);   

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
                                              echo $result;
                                          }
                                      }


                                    ?>
                                  </select>
                                </div>
                            	</div>
                            	<div class="col-md-6">
                                <div class="form-group">
                                  <label>Equipo Visitante</label>
                                  <select class="form-control select2"  name="equipovisita" id="equipovisita" style="width: 100%;" onchange="cambiarImagenEquipoVisita();" >
                                   <?php
                                      require_once ('lib/nusoap.php');
                                      $wsdl='http://localhost/sisfut/webserviceequipos/servicio.php?wsdl';
                                      $cliente = new nusoap_client($wsdl, true);   

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
                                              echo $result;
                                          }
                                      }


                                    ?>
                                  </select>
                                </div>
                            	</div>
                            	</div>


                            	<div class="row">
			                      <div class="col-xs-5 .col-sm-5" id="imagenequipolocal">
			                        <img src="img/zapato.png" width="100%">
			                      </div>
			                      <div class="col-xs-2 .col-sm-5" style="top:30px;">
			                        <img src="img/versus.png" width="100%">
			                      </div>
			                      <div class="col-xs-5 .col-sm-10" id="imagenequipovisita">
			                        <img src="img/zapato.png" width="100%">
			                      </div>
			                    </div>
                          <hr>
                          <div class="row">
                            <div class="col-md-12">
                              <b><labek>Precios de entradas</label></b>
                            </div>
                          </div>

                          <?php
                            

                            $sql = 'SELECT DISTINCT A.idseccion, S.nombre FROM asiento A, seccion S WHERE A.idestadio=:idestadio AND S.idseccion=A.idseccion ';
                            $q = $con->prepare($sql);
                            $q->execute(array(':idestadio'=>$_SESSION['IDESTADIO']));

                           


                            $rows = $q->fetchAll(\PDO::FETCH_OBJ);
                            foreach($rows as $row){
                             
                            
                          ?>
                          <div class="row">
                            <br>
                            <div class="col-md-4">
                              <div class="input-group">
                                <span class="input-group-addon"><?php echo $row->nombre ?> $</span>
                                <input type="text" class="form-control" name="precio<?php echo $row->nombre ?>">
                                <span class="input-group-addon">.00</span>
                              </div>
                            </div>
                          </div>  
                          <?php
                            }
                          ?>

			                    <br>
                          
                          <button type="submit" class="btn btn-block btn-lg btn-success" onclick="registrarpartido(); return false;"><i class="fa fa-futbol-o"></i> Crear Partido</button>
                          </fieldset>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab_2">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title"><i>Mis Partidos</i></h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                          <div class="box">
                            <div class="box-header">
                              <h3 class="box-title"><b>Listado de Partidos</b></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Partido</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <?php

                                    
                                    $sql = 'SELECT * FROM partido WHERE idestadio='.$_SESSION['IDESTADIO'].'';
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
                                        <div style="display:none;"><?php echo $response['nombre_equipo']?></div>
                                        <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response['imagen'] ?>" width="20px">
                                         VS  
                                        <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response2['imagen'] ?>" width="20px">
                                        <div style="display:none;"><?php echo $response2['nombre_equipo']?></div>
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
                                        <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response['imagen'] ?>" width="20px">
                                         VS  
                                        <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response2['imagen'] ?>" width="20px">
                                        <div style="display:none;"><?php echo $response2['nombre']?></div>
                                      </td>
                                        
                                      <?php
                                      }
                                    ?>


                                    
                                    
                                    <td><?php echo $row->fecha ?></td>
                                    <td><?php echo $row->hora ?></td>
                                    <td><?php echo $row->estado ?></td>
                                    <td> 
                                     
                                    </td>

                                  </tr>
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
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div>
          </div>

        </div>



        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->




<script>

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

  function cambiarImagenEquipoLocal(){

    var equipo = document.frmNuevoPartido.equipolocal.value;
    var seccion = document.frmNuevoPartido.seccion.value;

    ajax = objetoAjax();

    if(seccion==1){
        //LISTADO DE CLUBES
         ajax.open("POST", "partido/cambiarImagenEquipo.php", true);
    }
    if(seccion==2){
      //LISTADO DE PAISES
       ajax.open("POST", "partido/cambiarImagenPais.php", true);
    }
    
    
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          var mensajeRespuesta = ajax.responseText;

          if(mensajeRespuesta == 'BIEN'){
            window.location.reload(true);
          }else{
            var htmlAlerta = '<img src="http://localhost/sisfut/WebServiceEquipos/'+mensajeRespuesta+'" width="100%">';
            document.getElementById("imagenequipolocal").innerHTML = htmlAlerta;
          }
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("idequipo="+equipo);
    
  }

  function cambiarImagenEquipoVisita(){

    var equipo = document.frmNuevoPartido.equipovisita.value;
    
    var seccion = document.frmNuevoPartido.seccion.value;

    ajax = objetoAjax();

    if(seccion==1){
        //LISTADO DE CLUBES
         ajax.open("POST", "partido/cambiarImagenEquipo.php", true);
    }
    if(seccion==2){
      //LISTADO DE PAISES
       ajax.open("POST", "partido/cambiarImagenPais.php", true);
    }
   
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          var mensajeRespuesta = ajax.responseText;

          if(mensajeRespuesta == 'BIEN'){
            window.location.reload(true);
          }else{
            var htmlAlerta = '<img src="http://localhost/sisfut/WebServiceEquipos/'+mensajeRespuesta+'" width="100%">';
            document.getElementById("imagenequipovisita").innerHTML = htmlAlerta;
          }
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("idequipo="+equipo);
    
  }

  function cambiarListaPaisClub(){

    var seccion = document.frmNuevoPartido.seccion.value;
    var cambio = '';

    ajax = objetoAjax();

    if(seccion==1){
        //LISTADO DE CLUBES
         ajax.open("POST", "partido/listarclubes.php", true);
    }
    if(seccion==2){
      //LISTADO DE PAISES
       ajax.open("POST", "partido/listarpaises.php", true);
    }
    
   
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          var mensajeRespuesta = ajax.responseText;

          
          document.getElementById("equipolocal").innerHTML = mensajeRespuesta;
          document.getElementById("equipovisita").innerHTML = mensajeRespuesta;
          document.frmNuevoPartido.equipolocal.selectedIndex=-1;
          document.frmNuevoPartido.equipovisita.selectedIndex=-1;

          
          
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("clubes=todos");


    
  }


  function registrarpartido(){
    var fecha = document.frmNuevoPartido.fecha.value;
    var hora = document.frmNuevoPartido.hora.value;
    var tipo = document.frmNuevoPartido.tipopartido.value;
    var seccion = document.frmNuevoPartido.seccion.value;
    var arbitro = document.frmNuevoPartido.arbitro.value;
    var equipolocal = document.frmNuevoPartido.equipolocal.value;
    var equipovisita = document.frmNuevoPartido.equipovisita.value;

    if(document.frmNuevoPartido.precioVIP){
      var precioVIP = document.frmNuevoPartido.precioVIP.value;
    }
    if(document.frmNuevoPartido.precioPalco){
      var precioPalco = document.frmNuevoPartido.precioPalco.value;
    }
    if(document.frmNuevoPartido.precioPreferencial){
      var precioPreferencial = document.frmNuevoPartido.precioPreferencial.value;
    }
    if(document.frmNuevoPartido.precioTribuna){
      var precioTribuna = document.frmNuevoPartido.precioTribuna.value;
    }
    if(document.frmNuevoPartido.precioGeneral){
      var precioGeneral = document.frmNuevoPartido.precioGeneral.value;
    }


    if(fecha==''||hora==''||arbitro==''||precioVIP==''||precioPalco==''||precioPreferencial==''||precioTribuna==''||precioGeneral==''){
         var mensajeRespuesta = 'Todos los campos son obligatorios.';
         var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                                 '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                                  '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                                  '</div>';
              document.getElementById("mensajeFrmNuevoPartido").innerHTML = htmlAlerta;
         window.location='#';
    }else{

      ajax = objetoAjax();


      ajax.open("POST", "partido/ingresar_partido.php", true);
      
     
      ajax.onreadystatechange=function() {
          if (ajax.readyState==4) {
            var mensajeRespuesta = ajax.responseText;

            if(mensajeRespuesta=='BIEN'){
              window.location.reload(true);
            }else{
               var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                                 '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                                  '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                                  '</div>';
              document.getElementById("mensajeFrmNuevoPartido").innerHTML = htmlAlerta;
              window.location='#';
            
            }
       
            
          }
      }
      ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      ajax.send("fecha="+fecha+"&hora="+hora+"&tipo="+tipo+"&seccion="+seccion+"&arbitro="+arbitro+
        "&equipolocal="+equipolocal+"&equipovisita="+equipovisita+"&precioVIP="+precioVIP+"&precioPalco="+precioPalco
        +"&precioPreferencial="+precioPreferencial+"&precioTribuna="+precioTribuna+"&precioGeneral="+precioGeneral);
      

    }
    
    
   
    
  }
  
</script>



<?php
}
  include('pie.php');
?>