<?php

include('../config/conexion.php');
include('../config/variables.php');
$rubricas = array();
$msgErr = '';
$ban = false;

//$idGMatProf = $_POST['idGMatProf'];
//$idPeriodo = $_POST['idPeriodo'];

$sqlGetInfoRub = "SELECT $tRubInfo.id, $tRubInfo.nombre, $tRubInfo.porcentaje, $tRubInfo.estado_id "
        . "FROM $tRubInfo WHERE 1=1 ";

$periodo = (isset($_POST['idPeriodo'])) ? $_POST['idPeriodo'] : "";
if($periodo != ''){
    $idGMatProf = $_POST['idGMatProf'];
    $idPeriodo = $_POST['idPeriodo'];
    $sqlGetInfoRub .= " AND $tRubInfo.grupo_mat_prof_id = '$idGMatProf' "
            . "AND $tRubInfo.periodo_fecha_id = '$idPeriodo' ";
}

$idRubrica = (isset($_POST['idRubrica'])) ? $_POST['idRubrica'] : "";
if($idRubrica != ''){
    $sqlGetInfoRub .= " AND $tRubInfo.id = '$idRubrica' ";
}

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
$resGetInfoRub = $con->query($sqlGetInfoRub);
if ($resGetInfoRub->num_rows > 0) {
    while ($rowGetInfoRub = $resGetInfoRub->fetch_assoc()) {
        $id = $rowGetInfoRub['id'];
        $name = $rowGetInfoRub['nombre'];
        $porc = $rowGetInfoRub['porcentaje'];
        $edo = $rowGetInfoRub['estado_id'];
        $rubricas[] = array('id' => $id, 'nombre' => $name, 'porcentaje' => $porc, 'edo' => $edo );
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen rubricas en éste intervalo, aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $rubricas, "sql" => $sqlGetInfoRub));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>