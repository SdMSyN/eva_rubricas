<?php

include('../config/conexion.php');
include('../config/variables.php');

$name = $_POST['inputName'];
$num = $_POST['inputNum'];

$cad = '';
$ban = false;

$sqlInsertUser = "INSERT INTO $tPerInfo "
        . "(nombre, num_periodos, estado_id, creado) "
        . "VALUES ('$name', '$num', '1', '$dateNow' ) ";
if ($con->query($sqlInsertUser) === TRUE) {
    $ban = true;
    $cad .= 'Periodo añadido con éxito.';
} else {
    $ban = false;
    $cad .= 'Error al crear nuevo periodo.<br>' . $con->error;
}

//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>