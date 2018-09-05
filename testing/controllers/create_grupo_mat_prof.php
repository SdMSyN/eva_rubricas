<?php

include('../config/conexion.php');
include('../config/variables.php');

$idGrupo = $_POST['inputIdGrupo'];
$idMat = $_POST['inputMat'];
$idProf = $_POST['inputProf'];

$cad = '';
$ban = false;

$sqlInsertMatProf = "INSERT INTO $tGMatProf "
        . "(banco_materia_id, user_profesor_id, grupo_info_id, creado) "
        . "VALUES ('$idMat', '$idProf', '$idGrupo', '$dateNow' ) ";
if ($con->query($sqlInsertMatProf) === TRUE) {
    $ban = true;
    $cad .= 'Materia asignada con éxito.';
} else {
    $ban = false;
    $cad .= 'Error al asignar materia al grupo.<br>' . $con->error;
}

//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>