<?php

include('../config/conexion.php');
include('../config/variables.php');
$students = array();
$msgErr = '';
$ban = false;

$sqlGetStudents = "SELECT $tUsers.id as idStudent, $tUsers.nombre as nameStudent "
        . "FROM $tUsers "
        . "WHERE $tUsers.perfil_id = '4' ";

$idUser = (isset($_POST['idStudent'])) ? $_POST['idStudent'] : "";
if ($idUser != '') {
    $sqlGetStudents .= " AND $tUsers.id = '$idUser' ";
}

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
    $msgErr = 'No existen alumnos, aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $students, "sql" => $sqlGetStudents));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>