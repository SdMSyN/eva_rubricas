<?php require('header.php'); ?>

	<title><?= $tit; ?></title>
	<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
	<meta name="description" content="Descripción de la página" />
	<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />

</head>
<body class="hold-transition skin-blue sidebar-mini">

  <?php require('navbar.php'); ?>

	<?php
		if(isset($_SESSION['sessU']) AND $_SESSION['userPerfil'] == 1){ 
	?>
	
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
			<!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>1</h3>
              <p>Plan academico</p>
            </div>
            <div class="icon">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="#" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
							<h3>1</h3>
              <p>Asignaciones</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="#" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<?php require('footer.php'); ?>
	<!-- scripts acá -->
	<script>
		$(".loader").hide();
	</script>
	<?php
			}
		?>
</body>
</html>
