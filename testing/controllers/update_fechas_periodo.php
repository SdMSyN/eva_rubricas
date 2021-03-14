<?php

include('../config/conexion.php');
include('../config/variables.php');

$cad = '';
$ban = false;

$countNumFechasPer = count($_POST['inputIdFechaPeriodo']);
for($i = 0; $i < $countNumFechasPer; $i++){
    $idFechaPeriodo = $_POST['inputIdFechaPeriodo'][$i];
    $fechaInicio = $_POST['datePeriododBegin'][$i];
    $fechaFin = $_POST['datePeriododEnd'][$i];
    $sqlUpdateFechaPeriodo = "UPDATE $tPerFecha SET "
            . "fecha_inicio = '$fechaInicio', fecha_fin = '$fechaFin' "
            . "WHERE id = '$idFechaPeriodo' ";
    if($con->query($sqlUpdateFechaPeriodo) === TRUE){
        $ban = true;
        continue;
    }else{
        $ban = false;
        $cad .= 'Error al actualizar fecha del periodo.<br>'.$con->error;
        break;
    }
}

//$ban = true;
if ($ban) {
    $cad .= 'Se actualizarón con éxito las fechas del periodo.';
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>