<?php

include('../config/conexion.php');
include('../config/variables.php');

$name = $_POST['inputName'];
$grado = $_POST['inputGrado'];
$turno = $_POST['inputTurno'];
$planEst = $_POST['inputPE'];

$cad = '';
$ban = false;

$sqlInsertGrupo = "INSERT INTO $tGInfo "
        . "(nombre, nivel_escolar_id, nivel_turno_id, nivel_grado_id, year, plan_estudios_id, creado) "
        . "VALUES ('$name', '1', '$turno', '$grado', '$year', '$planEst', '$dateNow' ) ";
if ($con->query($sqlInsertGrupo) === TRUE) {
    $ban = true;
    $cad .= 'Grupo añadido con éxito.';
} else {
    $ban = false;
    $cad .= 'Error al crear nuevo grupo.<br>' . $con->error;
}

//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>