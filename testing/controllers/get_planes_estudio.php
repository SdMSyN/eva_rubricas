<?php

include('../config/conexion.php');
include('../config/variables.php');
$planes = array();
$msgErr = '';
$ban = false;

$sqlGetPlanEst = "SELECT $tPlanEst.id as idPlanEst, $tPlanEst.nombre as namePlanEst, $tPlanEst.year as yearPlanEst "
        . " FROM $tPlanEst WHERE 1=1 ";

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

$resGetProf = $con->query($sqlGetPlanEst);
if ($resGetProf->num_rows > 0) {
    while ($rowGetProf = $resGetProf->fetch_assoc()) {
        $id = $rowGetProf['idPlanEst'];
        $name = $rowGetProf['namePlanEst'];
        $year = $rowGetProf['yearPlanEst'];
        $planes[] = array('id' => $id, 'nombre' => $name, 'year' => $year );
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen planes de estudio, aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $planes, "sql" => $sqlGetPlanEst));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>