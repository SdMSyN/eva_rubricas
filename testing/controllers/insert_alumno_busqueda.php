<?php

include('../config/conexion.php');
include('../config/variables.php');

$idGrupo = $_POST['idGrupo'];
$nameStudent = $_POST['nameStudent'];

$cad = '';
$ban = true;

//Primero buscamos si el alumno ya existen en el grupo y si no existe lo insertamos.
$sqlGetStudent = "SELECT id, nombre FROM $tUsers WHERE nombre LIKE '%{$nameStudent}%' ";
$resGetStudent = $con->query($sqlGetStudent);
if($resGetStudent->num_rows > 0){//Si existe el alumno, ahora a buscarlo en el grupo
    $rowGetStudent = $resGetStudent->fetch_assoc();
    $idStudent = $rowGetStudent['id'];
    $sqlGetStudentGroup = "SELECT $tGAlum.id FROM $tGAlum "
            . "WHERE $tGAlum.user_alumno_id = '$idStudent' AND $tGAlum.grupo_info_id ='$idGrupo'  ";
    $resGetStudentGroup = $con->query($sqlGetStudentGroup);
    if($resGetStudentGroup->num_rows > 0){//Si ya existe en el grupo
        $cad .= 'Error: El alumno ya existe en éste grupo.<br>'.$con->error;
        $ban = false;
    }else{//Si es nuevo
        //Insertmos Alumno en el grupo
            $sqlInsertStudentGroup = "INSERT INTO $tGAlum (grupo_info_id, user_alumno_id) "
                    . "VALUES ('$idGrupo', '$idStudent')";
            if($con->query($sqlInsertStudentGroup) === TRUE){
                //Si todo correcto buscamos las materias del grupo y se las asignamos al alumno
                $sqlGetMatsProfGroup = "SELECT id, banco_materia_id FROM $tGMatProf WHERE grupo_info_id = '$idGrupo' ";
                $resGetMatsProfGroup = $con->query($sqlGetMatsProfGroup);
                while($rowGetMatsProfGroup = $resGetMatsProfGroup->fetch_assoc()){
                    $idMatProf = $rowGetMatsProfGroup['id'];
                    $idBMat = $rowGetMatsProfGroup['banco_materia_id'];
                    $sqlInsertMatAlum = "INSERT INTO $tGMatAlum "
                            . "(grupo_mat_prof_id, user_alumno_id, creado) "
                            . "VALUES ('$idMatProf', '$idStudent', '$dateNow')";
                    if($con->query($sqlInsertMatAlum) === TRUE){
                        continue;
                    }else{
                        $ban = false;
                        $cad .= 'Error al asignar alumno a la materia.<br>'.$con->error;
                        break;
                    }
                }
            }else{
                $ban = false;
                $cad .= 'Error al insertar alumno en el grupo.<br>'.$con->query;
            }
    }
}else{
    $cad .= 'Error: No existe éste alumno.<br>'.$con->error;
    $ban = false;
}


//$ban = true;
if ($ban) {
    echo json_encode(array("error" => 0, "msgErr" => $cad, "sql1"=>$sqlGetStudentGroup));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $cad, "sql2"=>$sqlGetStudentGroup));
}
?>