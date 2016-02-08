<?php
  include('cabecera.php');

  if(isset($_SESSION['USER'])==''){
  		header('Location: login.php');
  }else{
    if($_SESSION['IDROL']!=2){
    	header('Location: index.php');
    }
  }
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
                                      <input name="fecha" type="date" class="form-control" required>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                      <label>Hora:</label>
                                      <div class="input-group">
                                        <input type="text" class="form-control timepicker">
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
                                        <option>Amistoso</option>
                                        <option>Campeonato Nacional</option>
                                        <option>Campeonato Internacional</option>
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
                                      $wsdl='http://localhost/webserviceequipos/servicio.php?wsdl';
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
                                      $wsdl='http://localhost/webserviceequipos/servicio.php?wsdl';
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
			                        <img src="img/emelec-escudo.jpg" width="100%">
			                      </div>
			                      <div class="col-xs-2 .col-sm-5" style="top:30px;">
			                        <img src="img/versus.png" width="100%">
			                      </div>
			                      <div class="col-xs-5 .col-sm-10" id="imagenequipovisita">
			                        <img src="img/barcelona-escudo.jpg" width="100%">
			                      </div>
			                    </div>

			                    <br>

                                
                                
                                
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-block btn-lg btn-success" onclick="registrarPartido(); return false;"><i class="fa fa-futbol-o"></i> Crear Partido</button>
                          </fieldset>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab_2">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title"><i>Nuevo Estadio</i></h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                          <form role="form">
                              <fieldset>
                                  <div class="form-group">
                                      <label>Nombre</label>
                                      <input class="form-control" placeholder="Nombre" name="nombreEstadio" type="text" autofocus>
                                  </div>
                                  <div class="form-group">
                                      <label>País</label>
                                      <input class="form-control" placeholder="País" name="pais" type="text" autofocus>
                                  </div>
                                  <div class="form-group">
                                      <label>Localidad</label>
                                      <input class="form-control" placeholder="Localidad" name="localidad" type="text" autofocus>
                                  </div>
                                  <div class="form-group">
                                      <label>Dirección</label>
                                      <input class="form-control" placeholder="Dirección" name="direccionEstadio" type="text" autofocus>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label>E-mail</label>
                                      <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                  </div>
                                  <div class="form-group">
                                      <label>Contraseña</label>
                                      <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                                  </div>
                                  <div class="form-group">
                                      <label>Verificar Contraseña</label>
                                      <input class="form-control" placeholder="Verificar Contraseña" name="password2" type="password" value="">
                                  </div>
                                  
                                  <!-- Change this to a button or input when using this as a form -->
                                  <a href="index.html" class="btn btn-lg btn-success btn-block">Crear Estadio</a>
                              </fieldset>
                          </form>
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
            var htmlAlerta = '<img src="http://localhost/WebServiceEquipos/'+mensajeRespuesta+'" width="100%">';
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
            var htmlAlerta = '<img src="http://localhost/WebServiceEquipos/'+mensajeRespuesta+'" width="100%">';
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
  
</script>



<?php
  include('pie.php');
?>