<?php

include('../config/conexion.php');
include('../config/variables.php');

$idGrupo = $_POST['inputIdGrupo'];
$idGMatProf = $_POST['inputIdGMatProf'];
$idMat = $_POST['inputMat'];
$idProf = $_POST['inputProf'];

$cad = '';
$ban = false;

$sqlUpdMatProf = "UPDATE $tGMatProf SET banco_materia_id = '$idMat', "
        . "user_profesor_id = '$idProf' WHERE id = '$idGMatProf' ";
if ($con->query($sqlUpdMatProf) === TRUE) {
    $ban = true;
    $cad .= 'Materia actualizada con éxito.';
} else {
    $ban = false;
    $cad .= 'Error al actualizar materia al grupo.<br>' . $con->error;
}

//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msg" => $cad, "sql"=>$sqlUpdMatProf));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>