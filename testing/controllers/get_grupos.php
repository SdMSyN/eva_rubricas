<?php

include('../config/conexion.php');
include('../config/variables.php');
$grupos = array();
$msgErr = '';
$ban = false;

$sqlGetGrupo = "SELECT $tGInfo.nombre as grupo, $tTurn.nombre as turno, $tGrade.nombre as grado, $tGInfo.year as year "
        . "FROM $tGInfo "
        . "INNER JOIN $tGrade ON $tGrade.id = $tGInfo.nivel_grado_id "
        . "INNER JOIN $tTurn ON $tTurn.id = $tGInfo.nivel_turno_id "
        . "WHERE 1=1";

$query = (isset($_POST['query'])) ? $_POST['query'] : "";
if ($query != '') {
    $sqlGetGrupo .= " AND ($tGInfo.nombre LIKE '%$query%' OR $tGInfo.year LIKE '%$query%' ) ";
}
$tarea = (isset($_POST['tarea'])) ? $_POST['tarea'] : "";
if ($tarea != '') {
    $idGrupo = $_POST['idGrupo'];
    $sqlGetGrupo .= " AND $tGInfo.id = '$idGrupo' ";
}
//Ordenar ASC y DESC
$vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
if ($vorder != '') {
    $sqlGetGrupo .= " ORDER BY " . $vorder;
} else {
    $sqlGetGrupo .= " ORDER BY $tGInfo.nombre ";
}

$resGetGrupo = $con->query($sqlGetGrupo);
if ($resGetGrupo->num_rows > 0) {
    while ($rowGetGrupo = $resGetGrupo->fetch_assoc()) {
        $grupo = $rowGetGrupo['grupo'];
        $turno = $rowGetGrupo['turno'];
        $grado = $rowGetGrupo['grado'];
        $year = $rowGetGrupo['year'];
        $grupos[] = array('grupo' => $grupo, 'turno' => $turno, 'grado'=>$grado, 'year'=>$year);
        $ban = true;
        $msgErr = 'Grupos hallados.';
    }
} else {
    $ban = false;
    $msgErr = 'No existen grupos aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "msgErr" => $msgErr, "dataRes" => $grupos));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr, "sql"=>$sqlGetGrupo));
}
?>