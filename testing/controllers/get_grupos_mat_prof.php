<?php

include('../config/conexion.php');
include('../config/variables.php');
$mats = array();
$msgErr = '';
$ban = false;

$idGrupo = $_POST['idGrupo'];
$sqlGetMatsProf = "SELECT $tGMatProf.id as idGMatProf, $tMats.nombre as nameMat, "
        . " $tUsers.nombre as nameProf "
        . " FROM $tGMatProf "
        . " INNER JOIN $tMats ON $tMats.id = $tGMatProf.banco_materia_id "
        . " INNER JOIN $tUsers ON $tUsers.id = $tGMatProf.user_profesor_id "
        . " WHERE $tGMatProf.grupo_info_id = '$idGrupo' ";

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

$resGetProf = $con->query($sqlGetMatsProf);
if ($resGetProf->num_rows > 0) {
    while ($rowGetProf = $resGetProf->fetch_assoc()) {
        $id = $rowGetProf['idGMatProf'];
        $nameMat = $rowGetProf['nameMat'];
        $nameProf = $rowGetProf['nameProf'];
        $mats[] = array('id' => $id, 'materia' => $nameMat, 'profesor' => $nameProf);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen materias en este grupo, aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $mats, "sql" => $sqlGetMatsProf));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>