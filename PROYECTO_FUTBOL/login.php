<?php
  include('cabecera.php');
  if(isset($_SESSION['USER'])==''){

  }else{
    header('Location: /PROYECTO_FUTBOL/index.php');      
  }
  
?>


      <!-- Content Wrapper. Contains page content -->
      <div  id="contenedor" class="content-wrapper">
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">

           <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <br>
              <img align="center" src="img/sisfutweb.png" width="340" height="150">
              <br>
              
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Iniciar Sesión</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" name="frmLogin">
                            <fieldset>
                                <div id="mensajeFrmLogin">

                                </div>
                                
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" type="password" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Recordarme
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <span onclick="Logeo(); return false;" ><button  type="submit" class="btn btn-lg btn-success btn-block">Entrar</button></span>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->




<!--AJAX-->
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

      

    </script>



<?php
  include('pie.php');
?>