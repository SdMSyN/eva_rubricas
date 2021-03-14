<?php

include('../config/conexion.php');
include('../config/variables.php');

$idPeriodo = $_POST['inputIdPeriodo'];

$cad = '';
$ban = false;

$countNumPer = count($_POST['datePeriododBegin']);
for($i = 0; $i < $countNumPer; $i++){
    $fechaInicio = $_POST['datePeriododBegin'][$i];
    $fechaFin = $_POST['datePeriododEnd'][$i];
    $sqlInsertFechaPeriodo = "INSERT INTO $tPerFecha (periodo_info_id, fecha_inicio, fecha_fin) "
            . "VALUES ('$idPeriodo', '$fechaInicio', '$fechaFin')";
    if($con->query($sqlInsertFechaPeriodo) === TRUE){
        $ban = true;
        continue;
    }else{
        $ban = false;
        $cad .= 'Error al crear nueva fecha del periodo.<br>'.$con->error;
        break;
    }
}

//$ban = true;
if ($ban) {
    $cad .= 'Se añadieron las fechas de los periodos con éxito.';
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>