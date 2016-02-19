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


<div  id="contenedor" class="content-wrapper">
	<section class="content-header">      
      <div align="center">
      <img align="center" src="img/sisfutweb.png" width="340" height="150">
      <br><br><br><br><br><br><hr><h1>Administración</h1>
      </div>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-briefcase"></i> Administración</a></li>
       
      </ol>
    </section>

</diV>







<?php
  include('pie.php');
?>