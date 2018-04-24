<?php
	
    date_default_timezone_set('America/Mexico_City');
    $host="localhost";
    $user="root";
    $pass="";
    $db="eva_pec";
    $con=mysqli_connect($host, $user, $pass, $db);
    if($con->connect_error){
            die("Connection failed: ".$con->connect_error);
    }
    //echo 'Hola';

    //Tablas Usuarios
		$tUsers = "usuarios";
		$tUPerfil = "perfiles"; //[Director, Administrativo, Profesor, Alumno, Tutor]
		$tEsc = "escuelas";
		$tEdos = "estados"; //[Activo, Desactivo]
		$tInfo = "usuarios_informacion";
		//Tablas Niveles
		$tNivEsc = "nivel_escolar";
		$tTurn = "nivel_turnos";
		$tGrade = "nivel_grados";
		$tGroupInfo = "grupos_info";
		$tMats = "banco_materias";
		$tPlanEst = "planes_estudio";

?>