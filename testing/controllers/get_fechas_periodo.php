<?php

include('../config/conexion.php');
include('../config/variables.php');
$fechasPeriodo = array();
$msgErr = '';
$ban = false;

$idPeriodo = $_POST['idPeriodo'];
$sqlGetFechasPeriodo = "SELECT $tPerFecha.id, "
        . "$tPerFecha.fecha_inicio as fechaInicio, $tPerFecha.fecha_fin as fechaFin "
        . " FROM $tPerFecha WHERE $tPerFecha.periodo_info_id = '$idPeriodo' ";

/*
$query = (isset($_POST['query'])) ? $_POST['query'] : "";
if ($query != '') {
    $sqlGetPlanEst .= " AND ($tPlanEst.nombre LIKE '%$query%' OR $tPlanEst.year LIKE '%$query%' ) ";
}
$tarea = (isset($_POST['tarea'])) ? $_POST['tarea'] : "";
if ($tarea != '') {
    $idPlanEst2 = $_POST['idPlanEst'];
    $sqlGetPlanEst .= " AND $tPlanEst.id = '$idPlanEst2' ";
}
//Ordenar ASC y DESC
$vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
if ($vorder != '') {
    $sqlGetPlanEst .= " ORDER BY " . $vorder;
}

 */

$resGetFechasPeriodos = $con->query($sqlGetFechasPeriodo);
if ($resGetFechasPeriodos->num_rows > 0) {
    while ($rowGetPeriodos = $resGetFechasPeriodos->fetch_assoc()) {
        $id = $rowGetPeriodos['id'];
        $fechaInicio = $rowGetPeriodos['fechaInicio'];
        $fechaFin = $rowGetPeriodos['fechaFin'];
        $fechasPeriodo[] = array('id' => $id, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen fechas en éste periodo, aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $fechasPeriodo, "sql" => $sqlGetFechasPeriodo));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>