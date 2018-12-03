<?php

include('../config/conexion.php');
include('../config/variables.php');

$students = array();
$mats = array();
$msgErr = '';
$ban = true;

$idPerFecha = (isset($_POST['idPeriodoFecha'])) ? $_POST['idPeriodoFecha'] : "";
$idGrupo = $_POST['idGrupo'];
    
$cadSqlRub = '';

//Obtenemos alumnos
$sqlGetStudents = "SELECT $tUsers.id as idStudent, $tUsers.nombre as nameStudent "
        . "FROM $tGAlum "
        . "INNER JOIN $tUsers ON $tUsers.id = $tGAlum.user_alumno_id "
        . "WHERE $tGAlum.grupo_info_id = '$idGrupo' ORDER BY nameStudent ";

//Obtenemos nombre de las materias del grupo
/*$sqlGetMats = "SELECT $tMats.nombre as nameMat, $tMats.id as idMat "
        . "FROM $tPerMatProm "
        . "INNER JOIN $tGMatProf ON $tGMatProf.id = $tPerMatProm.grupo_mat_prof_id "
        . "INNER JOIN $tMats ON $tMats.id = $tGMatProf.banco_materia_id "
        . "WHERE $tGMatProf.grupo_info_id = '$idGrupo' AND $tPerMatProm.periodo_fecha_id = '$idPerFecha' ";*/
/*$sqlGetMats = "SELECT $tMats.id as idMat, $tMats.nombre as nameMat "
        . "FROM $tGMatProf "
        . "INNER JOIN $tMats ON $tMats.id = $tGMatProf.banco_materia_id "
        . "INNER JOIN $tPerMatProm ON $tPerMatProm.grupo_mat_prof_id = $tGMatProf.id "
        . "WHERE $tPerMatProm.periodo_fecha_id = '$idPerFecha' AND $tGMatProf.grupo_info_id = '$idGrupo' ";*/
$sqlGetMats = "SELECT $tMats.id as idMat, $tMats.nombre as nameMat "
        . "FROM $tMats "
        . "INNER JOIN $tGMatProf ON $tGMatProf.banco_materia_id = $tMats.id "
        . "WHERE $tGMatProf.grupo_info_id = '$idGrupo' ";
$resGetMats = $con->query($sqlGetMats);
if ($resGetMats->num_rows > 0) {
    while ($rowGetMats = $resGetMats->fetch_assoc()) {
        $idMat = $rowGetMats['idMat'];
        $nameMat = $rowGetMats['nameMat'];
        $mats[] = array('idMat' => $idMat, 'nameMat' => $nameMat);
    }
}else{
    $ban = false;
    $msgErr .= 'No existen materias en éste grupo, aún.<br>' . $con->error;
}

$resGetStudents = $con->query($sqlGetStudents);
if ($resGetStudents->num_rows > 0) {
    while ($rowGetStudents = $resGetStudents->fetch_assoc()) {
        $idStudent = $rowGetStudents['idStudent'];
        $name = $rowGetStudents['nameStudent'];
        $calMats = array();
        foreach($mats as $key => $value){
            $idMat = $value['idMat'];
            if($idPerFecha != ""){
                $sqlGetProms = "SELECT $tPerMatProm.id as idPermatProm, $tPerMatProm.promedio as promMat "
                    . "FROM $tPerMatProm "
                    . "INNER JOIN $tGMatProf ON $tGMatProf.id = $tPerMatProm.grupo_mat_prof_id "
                    . "WHERE $tGMatProf.grupo_info_id = '$idGrupo' "
                    . "AND $tPerMatProm.user_alumno_id = '$idStudent' "
                    . "AND $tPerMatProm.periodo_fecha_id = '$idPerFecha' "
                    . "AND $tGMatProf.banco_materia_id = '$idMat' ";
            }else{
                $sqlGetProms = "SELECT $tPerMatProm.id as idPermatProm, AVG($tPerMatProm.promedio) as promMat "
                    . "FROM $tPerMatProm "
                    . "INNER JOIN $tGMatProf ON $tGMatProf.id = $tPerMatProm.grupo_mat_prof_id "
                    . "WHERE $tGMatProf.grupo_info_id = '$idGrupo' "
                    . "AND $tPerMatProm.user_alumno_id = '$idStudent' "
                    . "AND $tGMatProf.banco_materia_id = '$idMat' ";
            }
            $resGetProms = $con->query($sqlGetProms);
            if($resGetProms->num_rows > 0){
                while($rowGetProms = $resGetProms->fetch_assoc()){
                    $idPermatProm = $rowGetProms['idPermatProm'];
                    //if($idPerFecha == "") $promMat = $rowGetProms['promMat'] / ($resGetProms->num_rows+1);
                    //else $promMat = $rowGetProms['promMat'];
                    $promMat = $rowGetProms['promMat'];
                    $calMats[] = array('idPerMatProm' => $idPermatProm, 'promMat' => $promMat, "numRows" => $resGetProms->num_rows);
                }
            }else{
                //$ban = false;
                $msgErr .= 'No existen calificaciones de ésta materia, aún.<br>' . $con->error;
                $calMats[] = array('idPerMatProm' => '0', 'promMat' => 'N/D');
                //break;
            }
        }
        $students[] = array('idStudent' => $idStudent, 'nameStudent' => $name, 'cals' => $calMats);
    }
}else {
    $ban = false;
    $msgErr .= 'No existen alumnos en este grupo, aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "students" => $students, "mats" => $mats, "sql1"=>$sqlGetMats));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr, "sql3"=>$sqlGetMats));
}
    
?>