<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idGrupo = $_POST['inputIdGrupo'];
    $ap = $_POST['inputAP'];
    $am = $_POST['inputAM'];
    $name = $_POST['inputName'];
    $nameAp = $ap." ".$am." ".$name;

    $cad = '';
    $ban = true;
    
    //Buscamos que existan materias en el grupo
    $sqlGetMatsGroup = "SELECT * FROM $tGMatProf WHERE grupo_info_id='$idGrupo' ";
    $resGetMatsGroup = $con->query($sqlGetMatsGroup);
    if($resGetMatsGroup->num_rows > 0){
        //Obtenemos el último ID
        $sqlGetMaxId = "SELECT MAX(id) as id FROM $tUsers ";
        $resGetMaxId = $con->query($sqlGetMaxId);
        $rowGetMaxId = $resGetMaxId->fetch_assoc();
        $idMax = $rowGetMaxId['id']+1;
        $user = $name{1}.$ap.$am{1}.$idMax;
        
        //Insertamos usuario
        $sqlInsertStudent = "INSERT INTO $tUsers "
            . "(nombre, user, perfil_id, estado_id, creado) "
            . "VALUES"
            . "('$nameAp', '$user', '4', '1', '$dateNow' ) ";
        if($con->query($sqlInsertStudent) === TRUE){
            $idStudent = $con->insert_id;
            
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
        }else{
            $ban = false;
            $cad .= 'Error al insertar alumno nuevo.<br>'.$con->error;
        }
    }else{
        $ban = false;
        $cad .= 'No puedes insertar alumnos si no hay materias creadas.';
    }
    //$ban = true;
    if($ban){
        $cad = 'Éxito, se registro el alumno nuevo.';
        echo json_encode(array("error"=>'0', "msg"=>$cad, "sql"=>''));
    }else{
        echo json_encode(array("error"=>1, "msg"=>$cad, "sql"=>''));
    }
?>