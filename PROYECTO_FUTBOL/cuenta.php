<?php
  include('cabecera.php');
  if(isset($_SESSION['USER'])==''){

  }else{
    header('Location: index.php');
  }
  
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <br>

           <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div align="center"><h3>Crear Cuenta</h3></div>
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Usuario</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Estadio</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="box box-success">
                      <div class="box-header with-border">
                        <h3 class="box-title"><i>Nuevo Usuario</i></h3>
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
                                    <input class="form-control" placeholder="Nombres" name="nombre" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input class="form-control" placeholder="Apellidos" name="apellido" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input class="form-control" placeholder="Teléfono" name="telefono" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" placeholder="Dirección" name="direccion" type="text" autofocus>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Fecha de Nacimiento</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input name="fechanacimiento" type="date" class="form-control" required>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Sexo</label>
                                      <select class="form-control select2" data-placeholder="Sexo" name="sexo" style="width: 100%;" >
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                      </select>
                                    </div>
                                  </div>
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
                                <button type="submit" class="btn btn-block btn-lg btn-success" onclick="registrarPersona(); return false;"> Registrarse</button>
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



  function registrarPersona(){
    var nombre = document.frmDatosPersonales.nombre.value;
    var apellido = document.frmDatosPersonales.apellido.value;
    var direccion = document.frmDatosPersonales.direccion.value;
    var telefono = document.frmDatosPersonales.telefono.value;
    var fechanacimiento = document.frmDatosPersonales.fechanacimiento.value;
    var sexo = document.frmDatosPersonales.sexo.value;
    var email = document.frmDatosPersonales.email.value;
    var password = document.frmDatosPersonales.password.value;
    var password2 = document.frmDatosPersonales.password2.value;
     
    

    
    ajax = objetoAjax();

    ajax.open("POST", "persona/insertar_persona.php", true);
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
             window.location='#';
          }
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("nombre="+nombre+"&apellido="+apellido+"&direccion="+direccion+"&telefono="+telefono+"&fechanacimiento="+fechanacimiento+"&genero="+sexo+"&email="+email+"&password="+password+"&password2="+password2);
    
  }

 

</script>



<?php
  include('pie.php');
?>