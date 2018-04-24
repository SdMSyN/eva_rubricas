<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
	<!-- Favicon -->
	<link rel="shortcut icon" href="../dist/img/logo.jpg">
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
  <!-- iCheck -->
  <link rel="stylesheet" href="../dist/css/blue.css"> 
	
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>EVA</b>Rubricas</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesión</p>
		<p class="bg-danger" id="msgErr"></p>

    <form method="post" id="formLogin">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Correo Electrónico" id="inputUser" name="inputUser">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" id="inputPass" name="inputPass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="inputCheckRecuerdame" value="yes"> Recordarme 
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="#">Olvide mi contraseña</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../dist/js/icheck.min.js"></script>
<!-- validación de formularios -->
<script src="../dist/js/jquery.validate.min.js"></script>
<script src="../dist/js/additional-methods.min.js"></script>
<script src="../dist/js/jquery-validate.bootstrap-tooltip.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#formLogin").validate({
			rules: {
				inputUser: {required: true},
				inputPass: {required: true}
			},
			messages: {
				inputUser: "Usuario obligatorio",
				inputPass: "Contraseña obligatoria"
			},
			tooltip_options: {
				inputUser: {trigger: "focus", placement: "right"},
				inputPass: {trigger: "focus", placement: "right"}
			},
			submitHandler: function(form){
				$.ajax({
					type: "POST",
					url: "../controllers/login_user.php",
					data: $("form#formLogin").serialize(),
					success: function(msg){
						console.log(msg);
						var msg = jQuery.parseJSON(msg);
						if(msg.error == 0){
							var idPerfil = parseInt(msg.perfil);
							switch(idPerfil){
								case 1:
									location.href = "index_director.php";
									break;
								case 2: 
									location.href = "index_administrativo.php";
									break;
								case 3:
									location.href = "index_profesor.php";
									break;
								case 5:
									location.href = "index_tutor.php";
									break;
								default:
									location.href = "login.php";
							}
						}else{
							$("#msgErr").html(msg.msgErr);
							$("#msgErr").delay(5000).hide(600);
						}
					},
					error: function(){
						var err = "Error al iniciar sesión.";
						$("#msgErr").html(err);
						$("#msgErr").delay(5000).hide(600);
					}
				})
			}
		})
	}); 
</script>
</body>
</html>
