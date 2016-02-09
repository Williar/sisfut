<?php
  date_default_timezone_set("America/Bogota");

  session_start();
?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>SisFUT</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="dist/css/skins/skin-green.min.css">


    <link rel="stylesheet" href="plugins/select2/select2.min.css">

    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">


    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">

     <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-green fixed sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>FT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SIS</b>FUT</span>
          <!--<span class="logo-Lg">
          <img align="center" src="img/sisfutweb.png" width="150" height="40">
          </span> -->

        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-fixed-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">

             <?php

                if(isset($_SESSION['USER'])==''){
                    $codigoHtml = '<!-- MENU INICIO SESION --><li class="dropdown user user-menu"><a href="cuenta.php" class="dropdown-toggle" title="Crear una Cuenta"> <i class="fa fa-user-plus"></i><span class="hidden-xs">Crear una Cuenta</span></a></li><li class="dropdown user user-menu"><a href="login.php" class="dropdown-toggle" title="Iniciar Sesión"> <i class="fa fa-key"></i><span class="hidden-xs">Iniciar Sesión</span> </a> </li>'; 

                    echo $codigoHtml;
                }else{
                  
                  $codigoHtml = '<li class="dropdown">
                  <a href="#"  class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> '.$_SESSION["NOMBRE"].' <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="perfil.php"><i class="fa fa-user"></i> Perfil</a></li>
                    <li><a href="seguridad/logout.php"><i class="fa fa-unlock"></i> Cerrar Sesión</a></li>
                    
                  </ul>
                </li>';
                  echo $codigoHtml;
                }

                
               
              ?>
                </ul>
              </div>

         
        </nav>
      </header>
      
      <!-- Left side column. contains the logo and sidebar -->

      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <?php

            if(isset($_SESSION['USER'])==''){

            }else{
              $codigoHtml = "<div class='user-panel'><div class='pull-left image'><img src='img/icon-user-default.png' class='img-circle' alt='User Image'></div><div class='pull-left info'><p>".$_SESSION['NOMBRE']."</p><a href='#''><i class='fa fa-user text-success'></i>".$_SESSION['ROL']."</a></div></div>"; 

                echo $codigoHtml;

            }
           
          ?>

          

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">
            
               <?php

                  if(isset($_SESSION['USER'])==''){
                      echo 'Sin Autenticación';
                  }else{
                    $codigoHtml = $_SESSION['USER']; 

                    echo $codigoHtml;

                  }
                 
                ?>
            </li>
            <!-- Optionally, you can add icons to the links -->
            <?php
              if(isset($_SESSION['USER'])){
                 if($_SESSION['IDROL']==3){
                   $codigoHtml = '<li><a href="index.php"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
                                  <li><a href="partidos.php"><i class="fa fa-soccer-ball-o"></i> <span>Todos los Partidos</span></a></li>
                                  <li><a href="misreservas.php"><i class="fa fa-briefcase"></i> <span>Mis Reservas</span></a></li>';
                    echo $codigoHtml;
                  }else{

                  }
                   if($_SESSION['IDROL']==2){
            ?>
                <li><a href="asientos.php"><i class="fa fa-eraser"></i> <span>Asientos</span></a></li>
                <li><a href="politica.php"><i class="fa fa-legal"></i> <span>Política</span></a></li>
                <li><a href="partido.php"><i class="fa fa-soccer-ball-o"></i> <span>Partido</span></a></li>

            <?php
                }
              }else{
            ?>

                <li><a href="index.php"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
                <li><a href="partidos.php"><i class="fa fa-soccer-ball-o"></i> <span>Todos los Partidos</span></a></li>
              
            <?php
              }
              
            ?> 
                 
            
            

              
            <li class="treeview">
              <a href="#"><i class="fa fa-cogs"></i> <span>Ayuda</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-info-circle"></i>Información</a></li>
                <li><a href="#"><i class="fa fa-wrench"></i>Uso</a></li>
                <li><a href="#"><i class="fa fa-building-o"></i>Crear Estadio</a></li>
              </ul>
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
      