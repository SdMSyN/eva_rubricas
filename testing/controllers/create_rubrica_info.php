<?php

include('../config/conexion.php');
include('../config/variables.php');

$idPeriodo = $_POST['inputIdPeriodo'];
$idGMatProf = $_POST['inputIdGMatProf'];
$name = $_POST['inputName'];

$cad = '';
$ban = false;

$sqlInsertRubrica = "INSERT INTO $tRubInfo"
        . "(nombre, grupo_mat_prof_id, periodo_fecha_id, estado_id, creado) "
        . "VALUES ('$name', '$idGMatProf', '$idPeriodo', '1', '$dateNow' ) ";
if ($con->query($sqlInsertRubrica) === TRUE) {
    $ban = true;
    $cad .= 'Rubrica añadida con éxito.';
} else {
    $ban = false;
    $cad .= 'Error al crear nueva rubrica.<br>' . $con->error;
}

//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>