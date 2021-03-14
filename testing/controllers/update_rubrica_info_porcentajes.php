<?php
//MODIFICAR
include('../config/conexion.php');
include('../config/variables.php');

$students = array();
$rubricas = array();

$userProfId = $_POST['inputUserId'];
$idPeriodoFecha = $_POST['inputPeriodoFecha'];
$idGrupoMatProf = $_POST['inputGMatProf'];
$idGrupo = $_POST['inputIdGrupo'];
$countRubs = count($_POST['inputIdRubInfo']);

$cad = '';
$ban = false;

for($i = 0; $i < $countRubs; $i++) {
    $idRubInfo = $_POST['inputIdRubInfo'][$i];
    $porcRub = $_POST['porcRub'][$i];
    $sqlUpdateRubInfo = "UPDATE $tRubInfo SET porcentaje = '$porcRub', estado_id = '2' WHERE id = '$idRubInfo' ";
    if ($con->query($sqlUpdateRubInfo) === TRUE) {
        $ban = true;
        $cad .= 'Rubrica ' . $idRubInfo . ', actualizada con éxito.';
    } else {
        $cad .= 'Error al actualizar porcentajes <br>' . $con->error;
        $ban = false;
        break;
    }
}

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
        $promGral = 0;
        $idStudent = $rowGetStudents['idStudent'];
        $calRubricas = array();
        foreach($rubricas as $key => $value){
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
                        }
                    }else{
                        $msgErr .= 'No existen calificaciones de ésta rubrica, aún.<br>' . $con->error;
                    }
                }
                $promCalif = $calif / $resGetRubInfoCalif->num_rows;
                $porcCalif = $promCalif * ($porcentaje * 0.01);
                $promGral += $porcCalif;
                //$cadDR .= 'ID: '.$idStudent.': , IDRUB: '.$idRubInfo.', SUMCALIF: '.$calif.', PROMCALIF: '.$promCalif.', %:'.$porcCalif;
            }else{
                $msgErr .= 'No existen actividades en ésta rubrica, aún.<br>' . $con->error;
            }
            //$calRubricas[] = array('idRub' => $idRubInfo, 'porcentaje'=>$porcentaje, 'promCalif' => $promCalif, 'porcCalif' => $porcCalif);
            $sqlInsertPerRubCalif = "INSERT INTO $tPerRubCalif (rubrica_info_id, user_alumno_id, calificacion) "
                    . "VALUES ('$idRubInfo', '$idStudent', '$promCalif')";
            if($con->query($sqlInsertPerRubCalif) === TRUE){
                continue;
            }else{
                $ban = false;
                $msgErr .= 'Error al añadir calificacion del alumno.<br>'.$con->error;
                break;
            }
        }
        //$students[] = array('idStudent' => $idStudent, 'cals' => $calRubricas);
        $sqlInsertPerMatProm = "INSERT INTO $tPerMatProm (periodo_fecha_id, user_alumno_id, grupo_mat_prof_id, promedio) "
                . "VALUES ('$idPeriodoFecha', '$idStudent', '$idGrupoMatProf', '$promGral')";
        if($con->query($sqlInsertPerMatProm) === TRUE){
            continue;
        }else{
            $ban = false;
            $msgErr .= 'Error al añadir el promedio.<br>'.$con->error;
            break;
        }
    }
}else {
    $ban = false;
    $msgErr .= 'No existen alumnos en este grupo, aún.<br>' . $con->error;
}

//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>