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
	    <div class="col-md-10 col-md-offset-1">
	      
	    </div>
    </div>
</div>



<?php
  include('pie.php');
?>