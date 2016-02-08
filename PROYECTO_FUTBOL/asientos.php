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
   <div class="row">
   		<div align="center"><h3>Administración de Asientos</h3></div>
	    <div class="col-md-6 col-md-offset-3">
	      <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i>Asientos</i></h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <form role="form" name="frmAsientos">
                        <fieldset>
                            <div id="mensajeFrmAsientos">

                            </div>
                            <div class="form-group">
                                <label>Capacidad</label>
                                <input class="form-control" placeholder="Capacidad" name="capacidad" type="number" autofocus disabled>
                            </div>
                           
                            
                            <label>Asientos</label>
                            <div class="input-group">
		                       <span class="input-group-addon">
		                         VIP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkVIP">
		                       </span>
		                       <input type="number" class="form-control" placeholder="# Asientos" disabled>
		                    </div>
		                    <div class="input-group">
		                       <span class="input-group-addon">
		                         Palco&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkPalco">
		                       </span>
		                       <input type="number" class="form-control" placeholder="# Asientos" disabled>
		                    </div>
		                    <div class="input-group">
		                       <span class="input-group-addon">
		                         Preferencial &nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkPreferencial">
		                       </span>
		                       <input type="number" class="form-control" placeholder="# Asientos" disabled>
		                    </div>
		                    <div class="input-group">
		                       <span class="input-group-addon">
		                         Tribuna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkTribuna">
		                       </span>
		                       <input type="number" class="form-control" placeholder="# Asientos" disabled>
		                    </div>
		                    <div class="input-group">
		                       <span class="input-group-addon" >
		                         General &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkGeneral">
		                       </span>
		                       <input type="number" class="form-control" placeholder="# Asientos" disabled>
		                    </div>
		                    <br>

		                     <div class="callout callout-info">
		                        <h4>Recuerde:</h4>
		                        <p align="justify">Aquí generará los asientos para el estadio de acuerdo a su sección. Una vez guardado los cambios, no podrá modificar esta información de nuevo.</p>
		                      </div>

                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-block btn-lg btn-success" onclick="actualizarMisDatos(); return false;"><i class="fa fa-save"></i> Guardar Cambios</button>
                      </fieldset>
                    </form>
                  </div>
        </div>
	    </div>
    </div>
</div>



<?php
  include('pie.php');
?>