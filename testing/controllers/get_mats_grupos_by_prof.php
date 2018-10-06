<?php

include('../config/conexion.php');
include('../config/variables.php');
$mats = array();
$msgErr = '';
$ban = false;

$idUser = $_POST['idUser'];
$sqlGetMats = "SELECT $tGMatProf.id as idGMatProf, $tMats.nombre as mat, $tGInfo.id as idGrupo, "
        . "$tGInfo.nombre as grupo, $tGInfo.year as year, $tTurn.nombre as turno, "
        . "$tGrade.nombre as grado, $tPlanEst.nombre as planEstudios, $tGInfo.periodo_info_id as idPeriodo "
        . "FROM $tGMatProf "
        . "INNER JOIN $tMats ON $tMats.id = $tGMatProf.banco_materia_id "
        . "INNER JOIN $tGInfo ON $tGInfo.id = $tGMatProf.grupo_info_id "
        . "INNER JOIN $tTurn ON $tTurn.id = $tGInfo.nivel_turno_id "
        . "INNER JOIN $tGrade ON $tGrade.id = $tGInfo.nivel_grado_id "
        . "INNER JOIN $tPlanEst ON $tPlanEst.id = $tGInfo.plan_estudios_id "
        . "INNER JOIN $tPerInfo ON $tPerInfo.id = $tGInfo.periodo_info_id "
        . "WHERE $tGMatProf.user_profesor_id = '$idUser' AND $tPerInfo.estado_id = '1' ";

/*
$query = (isset($_POST['query'])) ? $_POST['query'] : "";
if ($query != '') {
    $sqlGetMatsProf .= " AND ($tMats.nombre LIKE '%$query%' OR $tGrade.nombre LIKE '%$query%' ) ";
}
$tarea = (isset($_POST['tarea'])) ? $_POST['tarea'] : "";
if ($tarea != '') {
    $idMat = $_POST['idMat'];
    $sqlGetMatsProf .= " AND $tMats.id = '$idMat' ";
}
//Ordenar ASC y DESC
$vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
if ($vorder != '') {
    $sqlGetMatsProf .= " ORDER BY " . $vorder;
} else {
    $sqlGetMatsProf .= " ORDER BY idGMatProf ";
}
*/
$resGetMats = $con->query($sqlGetMats);
if ($resGetMats->num_rows > 0) {
    while ($rowGetMats = $resGetMats->fetch_assoc()) {
        $id = $rowGetMats['idGMatProf'];
        $nameMat = $rowGetMats['mat'];
        $idGrupo = $rowGetMats['idGrupo'];
        $nameGrupo = $rowGetMats['grupo'];
        $yearGrupo = $rowGetMats['year'];
        $turnoGrupo = $rowGetMats['turno'];
        $gradoGrupo = $rowGetMats['grado'];
        $planEst = $rowGetMats['planEstudios'];
        $idPeriodo = $rowGetMats['idPeriodo'];
        $mats[] = array('id' => $id, 'materia' => $nameMat, 'grupo' => $nameGrupo, 
            'idGrupo'=>$idGrupo, 'year'=>$yearGrupo, 'turno'=>$turnoGrupo, 'grado'=>$gradoGrupo, 
            'planEst' => $planEst, 'idPeriodo' => $idPeriodo);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No tienes materias asignadas, aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $mats, "sql" => $sqlGetMats));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>