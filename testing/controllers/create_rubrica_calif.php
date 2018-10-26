<?php

include('../config/conexion.php');
include('../config/variables.php');

$idRubrica = $_POST['inputRubricas'];
$nameRubrica = $_POST['inputNombre'];
$dateRubrica = $_POST['inputFecha'];
$countAlms = count($_POST['inputIdAlum']);

$cad = '';
$ban = false;

//Insertamos rubrica_info_calif
$sqlInsertRubInfo = "INSERT INTO $tRubInfoCalif (rubrica_info_id, fecha, nombre) "
        . "VALUES ('$idRubrica', '$dateRubrica', '$nameRubrica' ) ";
if ($con->query($sqlInsertRubInfo) === TRUE) {
    $cad .= 'Rubrica añadida con éxito.';
    $idRubCalifInfo = $con->insert_id;
    for($i = 0; $i < $countAlms; $i++){
        $idAlum = $_POST['inputIdAlum'][$i];
        $califAlum = $_POST['inputCalif'][$i];
        $sqlInsertRubDetCalif = "INSERT INTO $tRubDetCalif (rubrica_info_calif_id, user_alumno_id, calificacion) "
                . "VALUES ('$idRubCalifInfo', '$idAlum', '$califAlum' )";
        if($con->query($sqlInsertRubDetCalif) === TRUE){
            $ban = true;
            $cad .= 'Calificación del alumno: '.$idAlum.', añadida con éxito.';
        }else{
            $cad .= 'Error al añadir calificación del alumno: '.$idAlum.'<br>'.$con->error;
            $ban = false;
            break;
        }
    }
} else {
    $ban = false;
    $cad .= 'Error al crear nueva rubrica.<br>' . $con->error;
}

//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msg" => $cad));
} else {
    echo json_encode(array("error" => 1, "msg" => $cad));
}
?>