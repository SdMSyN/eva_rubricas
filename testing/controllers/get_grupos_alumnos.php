<?php

include('../config/conexion.php');
include('../config/variables.php');
$students = array();
$msgErr = '';
$ban = false;

$idGrupo = $_POST['idGrupo'];
$sqlGetStudents = "SELECT $tUsers.id as idStudent, $tUsers.nombre as nameStudent "
        . "FROM $tGAlum "
        . "INNER JOIN $tUsers ON $tUsers.id = $tGAlum.user_alumno_id "
        . "WHERE $tGAlum.grupo_info_id = '$idGrupo' AND $tUsers.estado_id = '1' "
        . "ORDER BY nameStudent ";

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
$resGetStudents = $con->query($sqlGetStudents);
if ($resGetStudents->num_rows > 0) {
    while ($rowGetStudents = $resGetStudents->fetch_assoc()) {
        $id = $rowGetStudents['idStudent'];
        $name = $rowGetStudents['nameStudent'];
        $students[] = array('idStudent' => $id, 'nameStudent' => $name);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen alumnos en este grupo, aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $students, "sql" => $sqlGetStudents));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>