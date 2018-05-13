<?php

include('../config/conexion.php');
include('../config/variables.php');

$idGrupo = $_POST['inputIdGrupo'];
$name = $_POST['inputName'];
$grado = $_POST['inputGrado'];
$turno = $_POST['inputTurno'];
$planEst = $_POST['inputPE'];

$cad = '';
$ban = false;

$sqlUpdateGroup = "UPDATE $tGInfo SET nombre='$name', nivel_turno_id='$turno', "
        . "nivel_grado_id='$grado', plan_estudios_id='$planEst' WHERE id='$idGrupo' ";
if ($con->query($sqlUpdateGroup) === TRUE) {
    $ban = true;
    $cad .= 'Grupo modificado con éxito.';
} else {
    $ban = false;
    $cad .= 'Error al actualizar Grupo.<br>' . $con->error;
}

//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>