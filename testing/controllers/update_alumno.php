<?php

include('../config/conexion.php');
include('../config/variables.php');

$idUser = $_POST['inputIdStudent'];
$nameUser = $_POST['inputStudent'];

$cad = '';
$ban = false;


$sqlUpdateUser = "UPDATE $tUsers SET nombre='$nameUser', actualizado='$dataTimeNow' WHERE id='$idUser' ";
if ($con->query($sqlUpdateUser) === TRUE) {
    $ban = true;
    $cad .= 'Alumno actualizado con éxito.';
} else {
    $ban = false;
    $cad .= 'Error al actualizar alumno.<br>' . $con->error;
}


//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msgErr" => $cad));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $cad));
}
?>