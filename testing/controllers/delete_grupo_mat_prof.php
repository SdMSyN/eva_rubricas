<?php

include('../config/conexion.php');
include('../config/variables.php');

$idGMatProf = $_POST['idGMatProf'];
$ban = false;
$msgErr = '';
$sqlDeleteMat = "DELETE FROM $tGMatProf WHERE id='$idGMatProf' ";

if ($con->query($sqlDeleteMat) === TRUE) {
    $ban = true;
    $msgErr .= 'Se elimino con éxito.';
} else {
    $banTmp = false;
    $msgErr .= 'Error al eliminar materia del grupo.' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $msgErr));
} else {
    echo json_encode(array("error" => 1, "dataRes" => $msgErr));
}
?>