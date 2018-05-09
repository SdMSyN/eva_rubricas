<?php

date_default_timezone_set('America/Mexico_City');
$host = "localhost";
$user = "root";
$pass = "";
$db = "eva_pec";
$con = mysqli_connect($host, $user, $pass, $db);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
//echo 'Hola';
//Tablas Usuarios
$tUsers = "usuarios";
$tUPerfil = "perfiles"; //[Director, Administrativo, Profesor, Alumno, Tutor]
$tEdos = "estados"; //[Activo, Desactivo]
$tInfo = "usuarios_informacion";
//Tablas Bancos
$tNivEsc = "banco_niveles_escolares";
$tTurn = "banco_nivel_turnos";
$tGrade = "banco_niveles_grados";
$tMats = "banco_materias";
//Grupos
$tGInfo = "grupos_info";
$tGAlum = "grupos_alumnos";
$tGMatProf = "grupos_mat_prof";
$tGMatAlum = "grupos_mat_alum";

$tPlanEst = "planes_estudios";
?>