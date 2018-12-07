<?php

include ('../config/conexion.php');
include ('../config/variables.php');

$student = array();
$query = $_REQUEST['query'];
$ban = false;
$msgErr = '';

$sqlGetStudent = "SELECT id, nombre FROM $tUsers WHERE perfil_id = '4' AND nombre LIKE '%{$query}%' ";

$resGetStudent = $con->query($sqlGetStudent);
if ($resGetStudent->num_rows > 0) {
    while ($rowGetStudent = $resGetStudent->fetch_assoc()) {
        $id = $rowGetStudent['id'];
        $name = $rowGetStudent['nombre'];
        $student[] = array('id' => $id, 'name' => $name);
        //$student[] = $name;
    }
    $ban = true;
} else {
    $ban = false;
    $msgErr .= 'Error: No existe el alumno.';
}

/* if ($ban) {
  echo json_encode(array("error" => 0, "dataRes" => $descuento, "sql"=>$sqlGetDesc));
  } else {
  echo json_encode(array("error" => 1, "msgErr" => $msgErr, "sql"=>$sqlGetDesc));
  } */
echo json_encode($student);
?>