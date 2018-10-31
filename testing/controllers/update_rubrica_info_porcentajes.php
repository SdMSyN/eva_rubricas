<?php
//MODIFICAR
include('../config/conexion.php');
include('../config/variables.php');

$countRubs = count($_POST['inputIdRubInfo']);

$cad = '';
$ban = false;


for($i = 0; $i < $countRubs; $i++) {
    $idRubInfo = $_POST['inputIdRubInfo'][$i];
    $porcRub = $_POST['porcRub'][$i];
    $sqlUpdateRubInfo = "UPDATE $tRubInfo SET porcentaje = '$porcRub', estado_id = '2' WHERE id = '$idRubInfo' ";
    if ($con->query($sqlUpdateRubInfo) === TRUE) {
        $ban = true;
        $cad .= 'Rubrica ' . $idRubInfo . ', actualizada con éxito.';
    } else {
        $cad .= 'Error al actualizar porcentajes <br>' . $con->error;
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