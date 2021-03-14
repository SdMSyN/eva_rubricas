<?php

include('../config/conexion.php');
include('../config/variables.php');
$periodos = array();
$msgErr = '';
$ban = false;

$sqlGetPeriodos = "SELECT $tPerInfo.id as idPeriodo, $tPerInfo.nombre as namePeriodo, "
        . "$tPerInfo.estado_id as edoPeriodo, $tPerInfo.num_periodos as numPeriodos "
        . " FROM $tPerInfo WHERE 1=1 ";

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

$resGetPeriodos = $con->query($sqlGetPeriodos);
if ($resGetPeriodos->num_rows > 0) {
    while ($rowGetPeriodos = $resGetPeriodos->fetch_assoc()) {
        $id = $rowGetPeriodos['idPeriodo'];
        $name = $rowGetPeriodos['namePeriodo'];
        $edo = $rowGetPeriodos['edoPeriodo'];
        $num = $rowGetPeriodos['numPeriodos'];
        $periodos[] = array('id' => $id, 'nombre' => $name, 'estado' => $edo, 'numero'=>$num );
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen periodos, aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $periodos, "sql" => $sqlGetPeriodos));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>