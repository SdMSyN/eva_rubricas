<!-- loader -->
<div class="loader"></div>

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
					<?php if(isset($_SESSION['sessU'])){ ?>
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
					<?php }else{ ?>
					<li><a href="login.php">Iniciar Sesión</a></li>
					<?php } ?>
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