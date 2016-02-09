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
   		<div align="center"><h3>Política del Estadio</h3></div>
	    <div class="col-md-6 col-md-offset-3">
	      <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i>Política</i></h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">


                  	<?php

                  	require('conexion.php');
					$con = Conectar();



					$sql = 'SELECT * FROM estadio WHERE idestadio='.$_SESSION['IDESTADIO'].'';

					$q2 = $con->prepare($sql);
					$q2->execute();

					$rows = $q2->fetchAll(\PDO::FETCH_OBJ);	

					$maxreserva = 0;

					foreach($rows as $row){
						$maxreserva = $row->maxreserva;
					}


					

					


                  	?>

                    <form role="form" name="frmPolitica">
                        <fieldset>
                            <div id="mensajeFrmPolitica">

                            </div>
                            <div class="form-group">
                                <label>Cantidad máxima de asientos por reserva:</label>
                                <input class="form-control" placeholder="Capacidad" name="cantidad" type="number" autofocus value="<?php echo $maxreserva ?>">
                            </div>
                           
                            
		                    
		                    <br>

		                     <div class="callout callout-info">
		                        <h4>Recuerde:</h4>
		                        <p align="justify">La Política del Estadio permitirá conocer cuantos asientos se pueden reservar por cliente en un partido.</p>
		                      </div>
		                     <button type="submit" class="btn btn-block btn-lg btn-success" onclick="agregarPolitica(); return false;"><i class="fa fa-save"></i> Guardar Cambios</button>
                            
                      </fieldset>
                    </form>
                  </div>
        </div>
	    </div>
    </div>
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



	function agregarPolitica(){

		var cantidad = document.frmPolitica.cantidad.value


		

		if(cantidad==0){
			mensajeRespuesta = 'Agregue la máxima reserva';
			var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                           '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                            '</div>';
        	document.getElementById("mensajeFrmPolitica").innerHTML = htmlAlerta;
		}else{
			if(cantidad>0){

				ajax = objetoAjax();

	            ajax.open("POST", "estadio/agregar_politica.php", true);

	            ajax.onreadystatechange=function() {
	                if (ajax.readyState==4) {
	                  window.location.reload(true);
	                  
	                }
	              }
	            ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	            ajax.send("cantidad="+cantidad);


			}else{
				mensajeRespuesta = 'Agregue la máxima reserva';
				var htmlAlerta = '<div class="alert alert-danger alert-dismissable">' +
                           '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="icon fa fa-ban"></i> ' + mensajeRespuesta +
                            '</div>';
       	 		document.getElementById("mensajeFrmPolitica").innerHTML = htmlAlerta;
			}
		}

		

		
		

	}

</script>



<?php
  include('pie.php');
?>