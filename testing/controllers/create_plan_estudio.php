<?php

include('../config/conexion.php');
include('../config/variables.php');

$name = $_POST['inputName'];
$year = $_POST['inputYear'];

$cad = '';
$ban = false;

$sqlInsertUser = "INSERT INTO $tPlanEst "
        . "(nombre, year, creado) "
        . "VALUES ('$name', '$year', '$dateNow' ) ";
if ($con->query($sqlInsertUser) === TRUE) {
    $ban = true;
    $cad .= 'Plan de estudios añadido con éxito.';
} else {
    $ban = false;
    $cad .= 'Error al crear nuevo plan de estudios.<br>' . $con->error;
}

//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>