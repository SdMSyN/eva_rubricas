<?php

include('../config/conexion.php');
include('../config/variables.php');
$grades = array();
$msgErr = '';
$ban = false;

$sqlGetGrade = "SELECT id, nombre FROM $tGrade ";

$resGetGrade = $con->query($sqlGetGrade);
if ($resGetGrade->num_rows > 0) {
    while ($rowGetGrade = $resGetGrade->fetch_assoc()) {
        $id = $rowGetGrade['id'];
        $name = $rowGetGrade['nombre'];
        $grades[] = array('id' => $id, 'nombre' => $name);
        $ban = true;
        $msgErr = 'Grado hallados.';
    }
} else {
    $ban = false;
    $msgErr = 'No existen grados aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "msgErr" => $msgErr, "dataRes" => $grades));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>