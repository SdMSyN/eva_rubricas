<?php

include('../config/conexion.php');
include('../config/variables.php');
$mats = array();
$msgErr = '';
$ban = false;

$sqlGetProf = "SELECT $tMats.id as idMat, $tMats.nombre as nameMat, $tGrade.nombre as nameGrade "
        . "FROM $tMats "
        . "INNER JOIN $tGrade ON $tGrade.id = $tMats.nivel_grado_id ";

$query = (isset($_POST['query'])) ? $_POST['query'] : "";
if ($query != '') {
    $sqlGetProf .= " WHERE $tMats.nombre LIKE '%$query%' ";
}

//Ordenar ASC y DESC
$vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
if ($vorder != '') {
    $sqlGetProf .= " ORDER BY " . $vorder;
}

$resGetProf = $con->query($sqlGetProf);
if ($resGetProf->num_rows > 0) {
    while ($rowGetProf = $resGetProf->fetch_assoc()) {
        $id = $rowGetProf['idMat'];
        $nameMat = $rowGetProf['nameMat'];
        $nameGrade = $rowGetProf['nameGrade'];
        $mats[] = array('id' => $id, 'nombre' => $nameMat, 'grado' => $nameGrade);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen materias aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $mats));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>