<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Favicon -->
  <link rel="shortcut icon" href="../dist/img/logo_ico.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	
	<?php
		include('../config/variables.php');
		include('../config/conexion.php');
	?>
	<title><?= $tit; ?></title>
	<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
	<meta name="description" content="Descripción de la página" />
	<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>PEC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PEC</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= $folderUpPerfil.$_SESSION['userLogo']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $_SESSION['userName']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= $folderUpPerfil.$_SESSION['userLogo']; ?>" class="img-circle" alt="User Image">
                <p>
                  <?= $_SESSION['userName'].' - '.$_SESSION['namePerfil']; ?>
                  <small>Miembro desde 2017</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil <i class="fa fa-user" aria-hidden="true"></i></a>
                </div>
                <div class="pull-right">
                  <a href="../controllers/proc_destroy_login.php" class="btn btn-default btn-flat">Salir <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menú</li>
				<?php 
					include('../controllers/menu.php');
				?>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
							<i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o text-aqua"></i> Top Navigation</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o text-aqua"></i> Boxed</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o text-aqua"></i> Fixed</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o text-aqua"></i> Collapsed Sidebar</a></li>
          </ul>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escritorio
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Escritorio</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
			
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.0.1
    </div>
    <strong>Copyright &copy; 2017 <a href="http://solucionesynegocios.com.mx">Software de México: Soluciones y Negocios S.A.S. de C.V. <img src="../dist/img/ico_nube.png" width="30px"> </a> </strong> Todos los derechos reservados.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

</body>
</html>
