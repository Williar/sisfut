<?php

  include('cabecera.php');
  require('conexion.php');
  $con= Conectar();
  $idpartido = $_REQUEST['id'];
?>

<div class="content-wrapper">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">
    		<div class="box-body">
    			 <div class="box box-success">
                      <div class="box-header with-border">
                        <h3 class="box-title"><i>Editar Partido</i></h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                      	<?php
                      		$sql = 'SELECT * FROM partido WHERE idpartido=:idpartido';
                            $q = $con->prepare($sql);
                            $q->execute(array(':idpartido'=>$idpartido));

                            $rows = $q->fetchAll(\PDO::FETCH_OBJ);
                            foreach($rows as $row){
                      	?>
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
                                      <input name="fecha" type="date" class="form-control" value="<?php echo $row->fecha ?>">
                                    </div>
                                  </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                      <label>Hora:</label>
                                      <div class="input-group">
                                        <input type="text" class="form-control timepicker" name="hora"
                                        value="<?php echo $row->hora ?>">
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
                                        <option value="1" <?php if($row->idtipopartido==1){echo 'selected';} ?>>Amistoso</option>
                                        <option value="2"  <?php if($row->idtipopartido==2){echo 'selected';} ?>>Campeonato Nacional</option>
                                        <option value="3"  <?php if($row->idtipopartido==3){echo 'selected';} ?>>Campeonato Internacional</option>
                                      </select>
                                    </div>
                                   </div>
                                </div>

                                <div class="row">
                                	<div class="col-md-4">
                                		<div class="form-group">
	                                      <label>Sección</label>
	                                      <select class="form-control select2"  name="seccion" style="width: 100%;" onchange="cambiarListaPaisClub();">
	                                        <option value="1" <?php if($row->idseccionpartido==1){echo 'selected';} ?>>Clubes</option>
	                                        <option value="2" <?php if($row->idseccionpartido==2){echo 'selected';} ?>>Países</option>
	                                      </select>
	                                    </div>
                                   </div>
                                	
                                	<div class="col-md-8">
                                		<div class="form-group">
		                                    <label>Árbitro</label>
		                                    <input class="form-control" placeholder="Árbitro o Juez" name="arbitro" type="text" autofocus value="<?php echo $row->arbitro ?>">
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
                                      if($row->idseccionpartido==1){
                                      	$result = $cliente->call("ListarClubes", array("dato" => $row->equipolocal));
                                      }else{
                                      	$result = $cliente->call("ListarPaises", array("dato" => $row->equipolocal));
                                      }
                                      

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

                                      if($row->idseccionpartido==1){
                                      	$result = $cliente->call("ListarClubes", array("dato" => $row->equipovisita));
                                      }else{
                                      	$result = $cliente->call("ListarPaises", array("dato" => $row->equipovisita));
                                      }

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
                                    }

                            	?>


                            	<div class="row">
			                      <div class="col-xs-5 .col-sm-5" id="imagenequipolocal">
			                        <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response['imagen'] ?>" width="100%">
			                      </div>
			                      <div class="col-xs-2 .col-sm-5" style="top:30px;">
			                        <img src="img/versus.png" width="100%">
			                      </div>
			                      <div class="col-xs-5 .col-sm-10" id="imagenequipovisita">
			                        <img src="http://localhost/sisfut/webserviceequipos/<?php echo $response2['imagen'] ?>" width="100%">
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

                            	$sql = 'SELECT * FROM costo WHERE idpartido=:idpartido AND idseccion=:idseccion';
	                            $q2 = $con->prepare($sql);
	                            $q2->execute(array(':idpartido'=>$idpartido,':idseccion'=>$row->idseccion));
	                            $rows2 = $q2->fetchAll(\PDO::FETCH_OBJ);

	                            foreach($rows2 as $row2){

                             
                            
                          ?>
                          <div class="row">
                            <br>
                            <div class="col-md-4">
                              <div class="input-group">
                                <span class="input-group-addon"><?php echo $row->nombre ?> $</span>
                                <input type="text" class="form-control" name="precio<?php echo $row->nombre ?>" value="<?php echo $row2->costo ?>">
                                <span class="input-group-addon">.00</span>
                              </div>
                            </div>
                          </div>  
                          <?php
                      			}
                            }
                          ?>

			                    <br>
                          
                          <button type="submit" class="btn btn-block btn-lg btn-success" onclick="modificarpartido(); return false;"><i class="fa fa-futbol-o"></i> Crear Partido</button>
                          </fieldset>
                        </form>
                        <?php
                        	}
                        ?>
                      </div>
                    </div>
			</div>

    	</div>
    </div>
</div>

	
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


  function modificarpartido(){
    var fecha = document.frmNuevoPartido.fecha.value;
    var hora = document.frmNuevoPartido.hora.value;
    var tipo = document.frmNuevoPartido.tipopartido.value;
    var seccion = document.frmNuevoPartido.seccion.value;
    var arbitro = document.frmNuevoPartido.arbitro.value;
    var equipolocal = document.frmNuevoPartido.equipolocal.value;
    var equipovisita = document.frmNuevoPartido.equipovisita.value;
    var idpartido = <?php echo $idpartido ?>;

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


      ajax.open("POST", "partido/modificar_partido.php", true);
      
     
      ajax.onreadystatechange=function() {
          if (ajax.readyState==4) {
            var mensajeRespuesta = ajax.responseText;

            if(mensajeRespuesta=='BIEN'){
              window.location='partido.php';
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
        +"&precioPreferencial="+precioPreferencial+"&precioTribuna="+precioTribuna+"&precioGeneral="+precioGeneral+"&idpartido="+idpartido);
      

    }
    
    
   
    
  }
  
</script>



<?php
  include('pie.php');
?>