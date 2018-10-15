<?php

include('../config/conexion.php');
include('../config/variables.php');

$idRubrica = $_POST['inputIdRubrica'];
$name = $_POST['inputName'];

$cad = '';
$ban = false;

$sqlUpdateGroup = "UPDATE $tRubInfo SET nombre='$name' WHERE id='$idRubrica' ";
if ($con->query($sqlUpdateGroup) === TRUE) {
    $ban = true;
    $cad .= 'Rubrica modificada con éxito.';
} else {
    $ban = false;
    $cad .= 'Error al actualizar Rubrica.<br>' . $con->error;
}

//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msgErr" => $cad));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $cad));
}
?>