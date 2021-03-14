<?php

include('../config/conexion.php');
include('../config/variables.php');

$students = array();
$rubricas = array();
$msgErr = '';
$ban = true;

$idGrupo = $_POST['idGrupo'];
$idRubrica = $_POST['idRubricaInfo'];

//Obtenemos alumnos
$sqlGetStudents = "SELECT $tUsers.id as idStudent, $tUsers.nombre as nameStudent "
        . "FROM $tGAlum "
        . "INNER JOIN $tUsers ON $tUsers.id = $tGAlum.user_alumno_id "
        . "WHERE $tGAlum.grupo_info_id = '$idGrupo' ORDER BY nameStudent ";
/*$resGetStudents = $con->query($sqlGetStudents);
if ($resGetStudents->num_rows > 0) {
    while ($rowGetStudents = $resGetStudents->fetch_assoc()) {
        $idStudent = $rowGetStudents['idStudent'];
        $name = $rowGetStudents['nameStudent'];
        $students[] = array('idStudent' => $idStudent, 'nameStudent' => $name);
    }
}else {
    $ban = false;
    $msgErr .= 'No existen alumnos en este grupo, aún.<br>' . $con->error;
}*/

//Obtenemos las rubricas
$sqlGetRubricas = "SELECT $tRubInfoCalif.id as idRub, $tRubInfoCalif.fecha as fechaRub, "
        . "$tRubInfoCalif.nombre as nombreRub "
        . "FROM $tRubInfoCalif "
        . "WHERE $tRubInfoCalif.rubrica_info_id = '$idRubrica' ";
$resGetRubricas = $con->query($sqlGetRubricas);
if ($resGetRubricas->num_rows > 0) {
    while ($rowGetRubricas = $resGetRubricas->fetch_assoc()) {
        $idRub = $rowGetRubricas['idRub'];
        $fechaRub = $rowGetRubricas['fechaRub'];
        $nombreRub = $rowGetRubricas['nombreRub'];
        $rubricas[] = array('idRub' => $idRub, 'fechaRub' => $fechaRub, 'nombreRub' => $nombreRub);
    }
}else{
    $ban = false;
    $msgErr .= 'No existen calificaciones en ésta rubrica, aún.<br>' . $con->error;
}

$cadSqlRub = '';
/*
//foreach($rubricas as $key => $value){
foreach($students as $key2 => $value2){
    //foreach($students as $key2 => $value2){
    foreach($rubricas as $key => $value){
        $idRubArr = $value['idRub'];
        $idStudent = $value2['idStudent'];
        $sqlGetCalifRub = "SELECT $tRubDetCalif.id as idDetCalif, $tRubDetCalif.calificacion as califRub "
                . "FROM $tRubDetCalif "
                . "WHERE $tRubDetCalif.user_alumno_id = '$idStudent' "
                . "AND $tRubDetCalif.rubrica_info_calif_id = '$idRubArr' ";
                //. "WHERE $tRubDetCalif.rubrica_info_calif_id = '$idRubArr' "
                //. "AND $tRubDetCalif.user_alumno_id = '$idStudent' ";
        $cadSqlRub .= $sqlGetCalifRub .';';
        $resGetCalifRub = $con->query($sqlGetCalifRub);
        if($resGetCalifRub->num_rows > 0){
            while($rowGetCalifRubricas = $resGetCalifRub->fetch_assoc()){
                $idDetCalif = $rowGetCalifRubricas['idDetCalif'];
                $califRub = $rowGetCalifRubricas['califRub'];
                $calRubricas[] = array('idDetCalif' => $idDetCalif, 'califRub' => $califRub);
            }
        }else{
            $ban = false;
            $msgErr .= 'No existen alumnos en éste grupo, aún.<br>' . $con->error;
            break;
        }
    }
}
 * */



$resGetStudents = $con->query($sqlGetStudents);
if ($resGetStudents->num_rows > 0) {
    while ($rowGetStudents = $resGetStudents->fetch_assoc()) {
        $idStudent = $rowGetStudents['idStudent'];
        $name = $rowGetStudents['nameStudent'];
        $calRubricas = array();
        foreach($rubricas as $key => $value){
            $idRubArr = $value['idRub'];
            //Obtenemos las calificaciones de los estudiantes
            $sqlGetCalifRub = "SELECT $tRubDetCalif.id as idDetCalif, $tRubDetCalif.calificacion as califRub "
                    . "FROM $tRubDetCalif "
                    . "WHERE $tRubDetCalif.rubrica_info_calif_id = '$idRubArr' "
                    . "AND $tRubDetCalif.user_alumno_id = '$idStudent' ";
            $resGetCalifRub = $con->query($sqlGetCalifRub);
            if($resGetCalifRub->num_rows > 0){
                while($rowGetCalifRubricas = $resGetCalifRub->fetch_assoc()){
                    $idDetCalif = $rowGetCalifRubricas['idDetCalif'];
                    $califRub = $rowGetCalifRubricas['califRub'];
                    $calRubricas[] = array('idDetCalif' => $idDetCalif, 'califRub' => $califRub);
                }
            }else{
                $ban = false;
                $msgErr .= 'No existen alumnos en éste grupo, aún.<br>' . $con->error;
                break;
            }
        }
        $students[] = array('idStudent' => $idStudent, 'nameStudent' => $name, 'cals' => $calRubricas);
    }
}else {
    $ban = false;
    $msgErr .= 'No existen alumnos en este grupo, aún.<br>' . $con->error;
}


if ($ban) {
    echo json_encode(array("error" => 0, "students" => $students, "rubricas" => $rubricas, "calRubricas" => $calRubricas, 
        "sql" => $sqlGetStudents, "sql2"=>$sqlGetRubricas, "sql3"=>$cadSqlRub));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr, 
        "sql" => $sqlGetStudents, "sql2"=>$sqlGetRubricas, "sql3"=>$cadSqlRub));
}
?>