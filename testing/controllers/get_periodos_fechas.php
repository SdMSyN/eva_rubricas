<?php

include('../config/conexion.php');
include('../config/variables.php');
$periodos = array();
$msgErr = '';
$ban = false;

$sqlGetPeriodos = "SELECT $tPerFecha.id as idPerFecha, "
        . "$tPerFecha.fecha_inicio as fInicio, $tPerFecha.fecha_fin as fFin "
        . "FROM $tPerFecha "
        . "WHERE 1=1 ";

$tarea = (isset($_POST['tarea'])) ? $_POST['tarea'] : "";
if ($tarea == 'periodo') {
    $idPeriodo = $_POST['idPeriodo'];
    $sqlGetPeriodos .= " AND $tPerFecha.periodo_info_id = '$idPeriodo' ";
}
/*
$query = (isset($_POST['query'])) ? $_POST['query'] : "";
if ($query != '') {
    $sqlGetPlanEst .= " AND ($tPlanEst.nombre LIKE '%$query%' OR $tPlanEst.year LIKE '%$query%' ) ";
}

//Ordenar ASC y DESC
$vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
if ($vorder != '') {
    $sqlGetPlanEst .= " ORDER BY " . $vorder;
}

 */

$resGetPeriodos = $con->query($sqlGetPeriodos);
if ($resGetPeriodos->num_rows > 0) {
    while ($rowGetPeriodos = $resGetPeriodos->fetch_assoc()) {
        $id = $rowGetPeriodos['idPerFecha'];
        $fInicio = $rowGetPeriodos['fInicio'];
        $fFin = $rowGetPeriodos['fFin'];
        $periodos[] = array('id' => $id, 'fInicio' => $fInicio, 'fFin' => $fFin );
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen periodos creados.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $periodos, "sql" => $sqlGetPeriodos));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>