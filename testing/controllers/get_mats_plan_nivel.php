<?php

include('../config/conexion.php');
include('../config/variables.php');
$mats = array();
$msgErr = '';
$ban = false;

$idGrupo = $_POST['idGrupo'];

//Obtenemos el plan de estudios y el nivel
$sqlGetPlanNiv = "SELECT nivel_grado_id, plan_estudios_id FROM $tGInfo WHERE id = '$idGrupo' ";
$resGetPlanNiv = $con->query($sqlGetPlanNiv);
$rowGetPlanNiv = $resGetPlanNiv->fetch_assoc();
$idPlanEst = $rowGetPlanNiv['plan_estudios_id'];
$idNivel = $rowGetPlanNiv['nivel_grado_id'];

//Obtenemos las materias de ese plan de estudios y nivel al que pertenece el grupo
$sqlGetMatsPlanNiv = "SELECT $tMats.id as idMat, $tMats.nombre as nameMat "
        . " FROM $tMats "
        . " WHERE $tMats.plan_estudio_id = '$idPlanEst' AND $tMats.nivel_grado_id = '$idNivel' ";

$resGetMatPlanNiv = $con->query($sqlGetMatsPlanNiv);
if ($resGetMatPlanNiv->num_rows > 0) {
    while ($rowGetMatPlanNiv = $resGetMatPlanNiv->fetch_assoc()) {
        $id = $rowGetMatPlanNiv['idMat'];
        $nameMat = $rowGetMatPlanNiv['nameMat'];
        $mats[] = array('id' => $id, 'nombre' => $nameMat);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen materias en este plan de estudio, aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $mats, "sql" => $sqlGetMatsPlanNiv));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr, "sql" => $sqlGetMatsPlanNiv));
}
?>