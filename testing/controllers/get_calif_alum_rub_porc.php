<?php

include('../config/conexion.php');
include('../config/variables.php');

$students = array();
$rubricas = array();
$msgErr = '';
$ban = true;

$idGrupo = $_POST['idGrupo'];
$idGrupoMatProf = $_POST['idGrupoMtProf'];
$idPeriodoFecha = $_POST['periodoFecha'];

//Obtenemos alumnos del grupo
$sqlGetStudents = "SELECT $tUsers.id as idStudent, $tUsers.nombre as nameStudent "
        . "FROM $tGAlum "
        . "INNER JOIN $tUsers ON $tUsers.id = $tGAlum.user_alumno_id "
        . "WHERE $tGAlum.grupo_info_id = '$idGrupo' ORDER BY nameStudent ";

//Obtenemos las rubricas y porcentajes
$sqlGetRubricas = "SELECT $tRubInfo.id as idRub, $tRubInfo.nombre as nombre, $tRubInfo.porcentaje as porcRub "
        . "FROM $tRubInfo "
        . "WHERE $tRubInfo.estado_id = '2' AND $tRubInfo.grupo_mat_prof_id = '$idGrupoMatProf' "
        . "AND $tRubInfo.periodo_fecha_id = '$idPeriodoFecha' ";
$resGetRubricas = $con->query($sqlGetRubricas);
if ($resGetRubricas->num_rows > 0) {
    while ($rowGetRubricas = $resGetRubricas->fetch_assoc()) {
        $idRub = $rowGetRubricas['idRub'];
        $nombreRub = $rowGetRubricas['nombre'];
        $porcRub = $rowGetRubricas['porcRub'];
        $rubricas[] = array('idRub' => $idRub, 'nombreRub' => $nombreRub, 'porcRub' => $porcRub);
    }
}else{
    $ban = false;
    $msgErr .= 'No existen calificaciones en ésta rubrica, aún.<br>' . $con->error;
}

$cadDR = '';
$resGetStudents = $con->query($sqlGetStudents);
if ($resGetStudents->num_rows > 0) {
    while ($rowGetStudents = $resGetStudents->fetch_assoc()) {
        $idStudent = $rowGetStudents['idStudent'];
        $name = $rowGetStudents['nameStudent'];
        $calRubricas = array();
        foreach($rubricas as $key => $value){
            //$idRubArr = $value['idRub'];
            $idRubInfo = $value['idRub'];
            $porcentaje = $value['porcRub'];
            $calif = 0; 
            $promCalif = 0;
            $porcCalif = 0;
            //Obtenemos rubricas_info_calif y luego rubricas_detalles_calif
            $sqlGetRubInfoCalif = "SELECT id, nombre FROM $tRubInfoCalif WHERE rubrica_info_id = '$idRubInfo' ";
            $resGetRubInfoCalif= $con->query($sqlGetRubInfoCalif);
            if($resGetRubInfoCalif->num_rows > 0){
                while($rowGetRubInfoCalif = $resGetRubInfoCalif->fetch_assoc()){
                    $idRubInfoCalif = $rowGetRubInfoCalif['id'];
                    $sqlGetCalifRub = "SELECT $tRubDetCalif.id as idDetCalif, $tRubDetCalif.calificacion as califRub "
                        . "FROM $tRubDetCalif "
                        . "WHERE $tRubDetCalif.rubrica_info_calif_id = '$idRubInfoCalif' "
                        . "AND $tRubDetCalif.user_alumno_id = '$idStudent' ";
                    $resGetCalifRub = $con->query($sqlGetCalifRub);
                    if($resGetCalifRub->num_rows > 0){
                        while($rowGetCalifRubricas = $resGetCalifRub->fetch_assoc()){
                            $idDetCalif = $rowGetCalifRubricas['idDetCalif'];
                            $califRub = $rowGetCalifRubricas['califRub'];
                            $calif += $califRub;
                            //$calRubricas[] = array('idDetCalif' => $idDetCalif, 'califRub' => $califRub);
                        }
                    }else{
                        //$ban = false;
                        $msgErr .= 'No existen calificaciones de ésta rubrica, aún.<br>' . $con->error;
                        //break;
                    }
                }
                $promCalif = $calif / $resGetRubInfoCalif->num_rows;
                $porcCalif = $promCalif * ($porcentaje * 0.01);
                //$cadDR .= 'ID: '.$idStudent.': , IDRUB: '.$idRubInfo.', SUMCALIF: '.$calif.', PROMCALIF: '.$promCalif.', %:'.$porcCalif;
            }else{
                //$ban = false;
                $msgErr .= 'No existen actividades en ésta rubrica, aún.<br>' . $con->error;
            }
            $calRubricas[] = array('idRub' => $idRubInfo, 'porcentaje'=>$porcentaje, 'promCalif' => $promCalif, 'porcCalif' => $porcCalif);
        }
        $students[] = array('idStudent' => $idStudent, 'nameStudent' => $name, 'cals' => $calRubricas);
    }
}else {
    $ban = false;
    $msgErr .= 'No existen alumnos en este grupo, aún.<br>' . $con->error;
}



if ($ban) {
    echo json_encode(array("error" => 0, "students" => $students, "rubricas" => $rubricas, "calRubricas" => $calRubricas, 
        "sql" => $sqlGetStudents, "sql2"=>$sqlGetRubricas, "sql3"=>$cadDR));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr, 
        "sql" => $sqlGetStudents, "sql2"=>$sqlGetRubricas, "sql3"=>$cadDR));
}
?>