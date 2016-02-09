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


                  	<?php

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

					$capacidad = 0;

					foreach($rows as $row){
						$capacidad = $row->capacidad;
					}

					$cantidadVIP = '';
					$cantidadPalco = '';
					$cantidadPreferencial = '';
					$cantidadTribuna = '';
					$cantidadGeneral = '';


					if($existe!=0){
						$sql = 'SELECT COUNT(*) FROM asiento WHERE idseccion=1 AND idestadio=:idestadio' ;
						$q = $con->prepare($sql);
						$q->execute(array(':idestadio'=>$_SESSION['IDESTADIO']));

						$cantidadVIP = $q->fetchColumn();

						$sql = 'SELECT COUNT(*) FROM asiento WHERE idseccion=2 AND idestadio=:idestadio' ;
						$q = $con->prepare($sql);
						$q->execute(array(':idestadio'=>$_SESSION['IDESTADIO']));

						$cantidadPalco = $q->fetchColumn();

						$sql = 'SELECT COUNT(*) FROM asiento WHERE idseccion=3 AND idestadio=:idestadio' ;
						$q = $con->prepare($sql);
						$q->execute(array(':idestadio'=>$_SESSION['IDESTADIO']));

						$cantidadPreferencial = $q->fetchColumn();

						$sql = 'SELECT COUNT(*) FROM asiento WHERE idseccion=4 AND idestadio=:idestadio' ;
						$q = $con->prepare($sql);
						$q->execute(array(':idestadio'=>$_SESSION['IDESTADIO']));

						$cantidadTribuna = $q->fetchColumn();

						$sql = 'SELECT COUNT(*) FROM asiento WHERE idseccion=5 AND idestadio=:idestadio' ;
						$q = $con->prepare($sql);
						$q->execute(array(':idestadio'=>$_SESSION['IDESTADIO']));

						$cantidadGeneral = $q->fetchColumn();

						
					}


                  	?>

                    <form role="form" name="frmAsientos">
                        <fieldset>
                            <div id="mensajeFrmAsientos">

                            </div>
                            <div class="form-group">
                                <label>Capacidad</label>
                                <input class="form-control" placeholder="Capacidad" name="capacidad" type="number" autofocus disabled value="<?php echo $capacidad ?>">
                            </div>
                           
                            
                            <label>Asientos</label>
                            <div class="input-group">
		                       <span class="input-group-addon">
		                         VIP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                         <?php if($existe==0){
		                         ?>
		                         <input type="checkbox" name="checkVIP" onchange="cambiarEstado();" >
		                         <?php
		                         }
		                         ?>
		                         
		                       </span>
		                       <input type="number" class="form-control" placeholder="# Asientos" disabled name="asientoVIP" min="1" value="<?php echo $cantidadVIP ?>">
		                    </div>
		                    <div class="input-group">
		                       <span class="input-group-addon">
		                         Palco&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                         <?php if($existe==0){
		                         ?>
		                         <input type="checkbox" name="checkPalco" onchange="cambiarEstado();">
		                       	<?php
		                         }
		                         ?>
		                       </span>
		                       <input type="number" class="form-control" placeholder="# Asientos" disabled name="asientoPalco" min="1" value="<?php echo $cantidadPalco ?>">
		                    </div>
		                    <div class="input-group">
		                       <span class="input-group-addon">
		                         Preferencial &nbsp;&nbsp;&nbsp;
		                         <?php if($existe==0){
		                         ?>
		                         <input type="checkbox" name="checkPreferencial" onchange="cambiarEstado();">
		                       	<?php
		                         }
		                         ?>
		                       </span>
		                       <input type="number" class="form-control" placeholder="# Asientos" disabled name="asientoPreferencial" min="1" value="<?php echo $cantidadPreferencial ?>">
		                    </div>
		                    <div class="input-group">
		                       <span class="input-group-addon">
		                         Tribuna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                         <?php if($existe==0){
		                         ?>
		                         <input type="checkbox" name="checkTribuna" onchange="cambiarEstado();">
		                       	<?php
		                         }
		                         ?>
		                       </span>
		                       <input type="number" class="form-control" placeholder="# Asientos" disabled name="asientoTribuna" min="1" value="<?php echo $cantidadTribuna ?>">
		                    </div>
		                    <div class="input-group">
		                       <span class="input-group-addon" >
		                         General &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						 		<?php if($existe==0){
		                         ?>
		                         <input type="checkbox" name="checkGeneral" onchange="cambiarEstado();">
		                       	<?php
		                         }
		                         ?>
		                       </span>
		                       <input type="number" class="form-control" placeholder="# Asientos" disabled name="asientoGeneral" min="1" value="<?php echo $cantidadGeneral ?>">
		                    </div>
		                    <br>

		                     <div class="callout callout-info">
		                        <h4>Recuerde:</h4>
		                        <p align="justify">Aquí generará los asientos para el estadio de acuerdo a su sección. Una vez guardado los cambios, no podrá modificar esta información de nuevo.</p>
		                      </div>
		                     <?php
		                     	if($existe==0){
		                     	?>
		                     		<!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-block btn-lg btn-success" onclick="crearAsientos(); return false;"><i class="fa fa-save"></i> Guardar Cambios</button>
		                     	<?php
		                     	}
		                     ?>
                            
                      </fieldset>
                    </form>
                  </div>
        </div>
	    </div>
    </div>
</div>



<script type="text/javascript">


	function cambiarEstado(){
		
		if(document.frmAsientos.checkVIP.checked){
			document.frmAsientos.asientoVIP.disabled = false;
		}else{
			document.frmAsientos.asientoVIP.value=null;
			document.frmAsientos.asientoVIP.disabled = true;
		}

		if(document.frmAsientos.checkPalco.checked){
			document.frmAsientos.asientoPalco.disabled = false;
		}else{
			document.frmAsientos.asientoPalco.value=null;
			document.frmAsientos.asientoPalco.disabled = true;
		}

		if(document.frmAsientos.checkPreferencial.checked){
			document.frmAsientos.asientoPreferencial.disabled = false;
		}else{
			document.frmAsientos.asientoPreferencial.value=null;
			document.frmAsientos.asientoPreferencial.disabled = true;
		}

		if(document.frmAsientos.checkTribuna.checked){
			document.frmAsientos.asientoTribuna.disabled = false;
		}else{
			document.frmAsientos.asientoTribuna.value=null;
			document.frmAsientos.asientoTribuna.disabled = true;
		}

		if(document.frmAsientos.checkGeneral.checked){
			document.frmAsientos.asientoGeneral.disabled = false;
		}else{
			document.frmAsientos.asientoGeneral.value=null;
			document.frmAsientos.asientoGeneral.disabled = true;
		}
	}

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



	function crearAsientos(){

		var cantidad = 0;
		var capacidad = document.frmAsientos.capacidad.value


		var cantidadVIP = 0;
		var cantidadPreferencial = 0;
		var cantidadPalco = 0;
		var cantidadTribuna = 0;
		var cantidadGeneral = 0;

		if(document.frmAsientos.checkVIP.checked){
			cantidad += parseInt(document.frmAsientos.asientoVIP.value);
			cantidadVIP = document.frmAsientos.asientoVIP.value;
		}

		if(document.frmAsientos.checkPalco.checked){
			cantidad += parseInt(document.frmAsientos.asientoPalco.value);
			cantidadPalco = document.frmAsientos.asientoPalco.value;
		}

		if(document.frmAsientos.checkPreferencial.checked){
			cantidad += parseInt(document.frmAsientos.asientoPreferencial.value);
			cantidad = document.frmAsientos.asientoPreferencial.value;
		}

		if(document.frmAsientos.checkTribuna.checked){
			cantidad += parseInt(document.frmAsientos.asientoTribuna.value);
			cantidadTribuna = document.frmAsientos.asientoTribuna.value;
		}

		if(document.frmAsientos.checkGeneral.checked){
			cantidad += parseInt(document.frmAsientos.asientoGeneral.value);
			cantidadGeneral = document.frmAsientos.asientoGeneral.value;
		}

		if(cantidad==0){
			mensajeRespuesta = 'Añada cantidad de asientos.';
			var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                           '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                            '</div>';
        	document.getElementById("mensajeFrmAsientos").innerHTML = htmlAlerta;
		}else{
			if(cantidad>0 && cantidad<=capacidad){

				ajax = objetoAjax();

	            ajax.open("POST", "estadio/crear_asientos.php", true);

	            ajax.onreadystatechange=function() {
	                if (ajax.readyState==4) {
	                  window.location.reload(true);
	                  
	                }
	              }
	            ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	            ajax.send("cantidadVIP="+cantidadVIP+"&cantidadPalco="+cantidadPalco+"&cantidadPreferencial="+cantidadPreferencial+"&cantidadTribuna="+cantidadTribuna+"&cantidadGeneral="+cantidadGeneral);


			}else{
				mensajeRespuesta = 'El total de asientos debe ser menor a su capacidad';
				var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                           '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                            '</div>';
        		document.getElementById("mensajeFrmAsientos").innerHTML = htmlAlerta;
			}
		}

		

		
		

	}

</script>



<?php
  include('pie.php');
?>