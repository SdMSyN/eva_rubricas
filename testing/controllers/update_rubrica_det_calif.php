<?php

include('../config/conexion.php');
include('../config/variables.php');

$countCals = count($_POST['inputCalif']);

$cad = '';
$ban = false;


for($i = 0; $i < $countCals; $i++) {
    $idDetCalif = $_POST['inputIdDetCalif'][$i];
    $califAlum = $_POST['inputCalif'][$i];
    $sqlUpdateRubDetCalif = "UPDATE $tRubDetCalif SET calificacion = '$califAlum' WHERE id = '$idDetCalif' ";
    if ($con->query($sqlUpdateRubDetCalif) === TRUE) {
        $ban = true;
        $cad .= 'Calificación del alumno: ' . $idDetCalif . ', actualizada con éxito.';
    } else {
        $cad .= 'Error al actualizar calificación del alumno: ' . $idDetCalif . '<br>' . $con->error;
        $ban = false;
        break;
    }
}


//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>