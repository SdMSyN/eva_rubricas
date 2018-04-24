<?php
	session_start();
	//session_destroy();
	unset ( $_SESSION['sessU'] );
	unset ( $_SESSION['userId'] );
	unset ( $_SESSION['userName'] );
	unset ( $_SESSION['userKey'] );
  unset ( $_SESSION['userLogo'] );
  unset ( $_SESSION['userPerfil'] );
  unset ( $_SESSION['namePerfil'] );
	header('Location: ../views/login.php');
?>