<?php
  include('cabecera.php');

  if(isset($_SESSION['USER'])==''){
  		header('Location: login.php');
  }else{
    
  }
?>


 <!-- Content Wrapper. Contains page content -->
<div  id="contenedor" class="content-wrapper">
	<section class="content-header">
      <h1>
        SisFUT
        <small>El fútbol tu pasión</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i> Mi Perfil</a></li>
       
      </ol>
    </section>


    <?php

    require('conexion.php');

		$con = Conectar();


    $estadio = false;


    if($_SESSION['IDROL']==2){

      $estadio = true;

      $sql = 'SELECT * FROM estadio E, usuario U, detalle_usuario D WHERE D.idestadio='.$_SESSION['IDESTADIO'].' AND D.idusuario=U.idusuario AND E.idestadio='.$_SESSION['IDESTADIO'].'';
      $qPersona = $con->prepare($sql);
      $qPersona->execute();

    }else{
      $sql = 'SELECT * FROM persona P, usuario U WHERE P.idpersona='.$_SESSION['IDPERSONA'].' AND P.idusuario=U.idusuario';
      $qPersona = $con->prepare($sql);
      $qPersona->execute();

    }

    
    if(!$estadio){

    
		$rowsPersona = $qPersona->fetchAll(\PDO::FETCH_OBJ);
		foreach($rowsPersona as $rowPersona){
			
		

    ?>


    <section class="content">
    	<div class="row">
    		<div class="col-md-6">
				<div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i>Mis Datos</i></h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <form role="form" name="frmDatosPersonales">
                        <fieldset>
                            <div id="mensajeFrmDatosPersonales">

                            </div>
                            <div class="form-group">
                                <label>Nombres</label>
                                <input class="form-control" placeholder="Nombres" name="nombre" type="text" autofocus value="<?php echo $rowPersona->nombre ?>">
                            </div>
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input class="form-control" placeholder="Apellidos" name="apellido" type="text" autofocus value="<?php echo $rowPersona->apellido ?>">
                            </div>
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input class="form-control" placeholder="Teléfono" name="telefono" type="text" autofocus value="<?php echo $rowPersona->telefono ?>">
                            </div>
                            <div class="form-group">
                                <label>Dirección</label>
                                <input class="form-control" placeholder="Dirección" name="direccion" type="text" autofocus value="<?php echo $rowPersona->direccion ?>">
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                              <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input name="fechanacimiento" type="date" class="form-control" required value="<?php echo $rowPersona->fechanacimiento ?>">
                                </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Sexo</label>
                                  <select class="form-control select2 " data-placeholder="Sexo" style="width: 100%;" name="sexo">
                                  	<?php 
                                  		if($rowPersona->genero=='Masculino'){
                                  	?>
                                  			<option selected>Masculino</option>
                                    		<option>Femenino</option>
                                    <?php
                                  		}else{
                                  	?>
                                  			<option>Masculino</option>
                                    		<option selected>Femenino</option>
                                    <?php
                                  		}
                                  	?>
                                    
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus disabled value="<?php echo $rowPersona->email ?>">
                            </div>
                           
                            
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-block btn-lg btn-success" onclick="actualizarMisDatos(); return false;"><i class="fa fa-save"></i> Guardar Cambios</button>
                      </fieldset>
                    </form>
                  </div>
        </div>
    		</div>

    		<?php } }


        if($estadio){

          $rowsPersona = $qPersona->fetchAll(\PDO::FETCH_OBJ);
          foreach($rowsPersona as $rowPersona){

        ?>

        <section class="content">
      <div class="row">
        <div class="col-md-6">
        <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i>Mis Datos</i></h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <form role="form" name="frmDatosPersonalesEstadio">
                        <fieldset>
                            <div id="mensajeFrmDatosPersonales">

                            </div>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" placeholder="Nombre" name="nombre" type="text" autofocus value="<?php echo $rowPersona->nombre ?>">
                            </div>
                            <div class="form-group">
                              <label>País</label>
                              <select class="form-control select2 " data-placeholder="País" style="width: 100%;" name="pais">
                                <?php
                                  require_once ('lib/nusoap.php');
                                  $wsdl='http://localhost/sisfut/webserviceequipos/servicio.php?wsdl';
                                  $cliente = new nusoap_client($wsdl, true);   

                                  $dato = $rowPersona->pais;

                                  $result = $cliente->call("ListarPaises", array("dato" => $dato));

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
                            <div class="form-group">
                                <label>Localidad</label>
                                <input class="form-control" placeholder="Localidad" name="localidad" type="text" autofocus value="<?php echo $rowPersona->localidad ?>">
                            </div>
                            <div class="form-group">
                                <label>Dirección</label>
                                <input class="form-control" placeholder="Dirección" name="direccion" type="text" autofocus value="<?php echo $rowPersona->direccion ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus disabled value="<?php echo $rowPersona->email ?>">
                            </div>
                           
                            
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-block btn-lg btn-success" onclick="actualizarMisDatosEstadio(); return false;"><i class="fa fa-save"></i> Guardar Cambios</button>
                      </fieldset>
                    </form>
                  </div>
        </div>
        </div>



        <?php } } ?>


    		<div class="col-md-6">
				<div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i>Cambiar Contraseña</i></h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <form role="form" name="frmCambiarPassword">
                        <fieldset>
                            <div id="mensajeFrmCambiarPassword">

                            </div>
                            
                            <div class="form-group">
                                <label>Contraseña Actual</label>
                                <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                            </div>
                            <div class="form-group">
                                <label>Nueva Contraseña</label>
                                <input class="form-control" placeholder="Contraseña" name="passwordnueva" type="password" value="">
                            </div>
                            <div class="form-group">
                                <label>Verificar Contraseña</label>
                                <input class="form-control" placeholder="Verificar Contraseña" name="passwordnueva2" type="password" value="">
                            </div>
                            
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-block btn-lg btn-success" onclick="cambiarContrasena(); return false;"><i class="fa fa-key"></i> Cambiar Contraseña</button>
                      </fieldset>
                    </form>
                  </div>
                </div>
    		</div>
    	</div>
    </section>
    
</div>




<script type="text/javascript">

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



	function actualizarMisDatos(){
		var nombre = document.frmDatosPersonales.nombre.value;
    var apellido = document.frmDatosPersonales.apellido.value;
    var direccion = document.frmDatosPersonales.direccion.value;
    var telefono = document.frmDatosPersonales.telefono.value;
    var fechanacimiento = document.frmDatosPersonales.fechanacimiento.value;
    var sexo = document.frmDatosPersonales.sexo.value;
     
    

    
    ajax = objetoAjax();

    ajax.open("POST", "seguridad/actualizar_datos.php", true);
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          var mensajeRespuesta = ajax.responseText;

          if(mensajeRespuesta == 'BIEN'){
            window.location.reload(true);
          }else{
            var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                           '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                            '</div>';
            document.getElementById("mensajeFrmDatosPersonales").innerHTML = htmlAlerta;
          }
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("nombre="+nombre+"&apellido="+apellido+"&direccion="+direccion+"&telefono="+telefono+"&fechanacimiento="+fechanacimiento+"&genero="+sexo);
    
	}

  function actualizarMisDatosEstadio(){
    var nombre = document.frmDatosPersonalesEstadio.nombre.value;
    var localidad = document.frmDatosPersonalesEstadio.localidad.value;
    var direccion = document.frmDatosPersonalesEstadio.direccion.value;
    var pais = document.frmDatosPersonalesEstadio.pais.value;
    
    
    
    ajax = objetoAjax();

    ajax.open("POST", "seguridad/actualizar_datos_estadio.php", true);
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          var mensajeRespuesta = ajax.responseText;

          if(mensajeRespuesta == 'BIEN'){
            window.location.reload(true);
          }else{
            var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                           '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                            '</div>';
            document.getElementById("mensajeFrmDatosPersonalesEstadio").innerHTML = htmlAlerta;
          }
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("nombre="+nombre+"&apellido="+apellido+"&direccion="+direccion+"&telefono="+telefono+"&fechanacimiento="+fechanacimiento+"&genero="+sexo);
    
  }

	function cambiarContrasena(){
    var password = document.frmCambiarPassword.password.value;
    var passwordnueva = document.frmCambiarPassword.passwordnueva.value;
    var passwordnueva2 = document.frmCambiarPassword.passwordnueva2.value;

    

    
    ajax = objetoAjax();

    ajax.open("POST", "seguridad/cambiarPassword.php", true);
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
          var mensajeRespuesta = ajax.responseText;

          if(mensajeRespuesta == 'BIEN'){
            window.location.reload(true);
          }else{
            var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                           '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                            '</div>';
            document.getElementById("mensajeFrmCambiarPassword").innerHTML = htmlAlerta;
          }
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("password="+password+"&passwordnueva="+passwordnueva+"&passwordnueva2="+passwordnueva2);
    
	}

</script>



<?php
  include('pie.php');
?>