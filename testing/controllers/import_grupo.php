<?php

include('../config/conexion.php');
include('../config/variables.php');

$idGrupo = $_POST['inputIdGrupo']; //idGrupo
$file = $_FILES['inputFile']['name'];

$msgErr = '';
$cad = '';
$ban = true;
$arrIdMatsIns = array();


//Asignamos nombre al archivo subido, con fecha
$extFile = explode(".", $_FILES['inputFile']['name']);
$nameFile = 'grupo_' . $dateNow . "." . $extFile[1];

//Procesamos Excel
$destinoCsv = $csvUploads . '/' . $nameFile;
$csv = @move_uploaded_file($_FILES["inputFile"]["tmp_name"], $destinoCsv);
$sustituye = array("\r\n", "\n\r", "\n", "\r");
// Validamos archivo CSV (estructura)
if ($csv) {
    $csvFile = file($destinoCsv);
    $i = 0;
    foreach ($csvFile as $linea_num => $linea) {
        $i++;
        if ($i == 1)
            continue;
        $linea = utf8_encode($linea);
        $datos = explode(",", $linea);
        $contador = count($datos);
        //Número de campos menor
        if ($contador < 3) {
            $msgErr .= 'Tu archivo tiene menos columnas de las requeridas.' . $i;
            $ban = false;
            break;
        }
        //Se excede el número de campos
        if ($contador > 4) {
            $msgErr .= 'Tu archivo tiene más columnas de las requeridas.' . $i;
            $ban = false;
            break;
        }
        //Buscamos los usuarios, si no existe alguno mandamos mensaje de error
        $usuario = trim(str_replace($sustituye, "", $datos[3]));
        if ($usuario != "") {
            $sqlSearchUser = "SELECT id FROM $tUsers WHERE user='$usuario' ";
            $resSearchUser = $con->query($sqlSearchUser);
            if ($resSearchUser->num_rows < 1) {
                $msgErr .= 'El usuario: ' . $usuario . ', no existe.' . $i;
                $ban = false;
                break;
            }
        }
        //Validamos solo letras en los campos
        if (!preg_match('/^[a-zA-Z ]+$/', $datos[0]) || !preg_match('/^[a-zA-Z ]+$/', $datos[1]) || !preg_match('/^[a-zA-Z ]+$/', $datos[2])) {
            $msgErr .= 'Los nombres y apellidos solo pueden contener letras (sin acentos), registro: ' . $i . '--' . $datos[0] . $datos[1] . $datos[2];
            $ban = false;
            break;
        }
    }
} else {
    $msgErr .= "Error al subir el archivo CSV.";
    $ban = false;
}


if ($ban) {
    //Recorremos Excel para insertar alumnos
    $csvFile = file($destinoCsv);
    $j = 0;
    foreach ($csvFile as $linea_num => $linea) {
        $j++;
        if ($j == 1)
            continue;
        $linea = utf8_encode($linea);
        $datos = explode(",", $linea);
        $usuario = str_replace($sustituye, "", $datos[3]);
        if ($usuario != "") { //si hay algo en el campo de usuario
            /* $sqlSearchUser = "SELECT id FROM $tAlum WHERE user='$usuario' ";
              $resSearchUser = $con->query($sqlSearchUser);
              $rowGetUser = $resSearchUser->fetch_assoc();
              $idAlumno = $rowGetUser['id'];
              $sqlInsertAlumnoGrupo = "INSERT INTO $tGrupoAlums (grupo_id, alumno_id, creado) "
              . "VALUES ('$idGrupo', '$idAlumno','$dateNow')";
              if($con->query($sqlInsertAlumnoGrupo) === TRUE){
              $countArrIdMats = count($arrIdMatsIns);
              for($k = 0; $k < $countArrIdMats; $k++){
              $idMatProf = $arrIdMatsIns[$k];
              $sqlInsertMatAlum = "INSERT INTO $tGMatAlums "
              . "(grupo_materia_profesor_id, usuario_alumno_id, creado) "
              . "VALUES ('$idMatProf', '$idAlumno', '$dateNow')";
              if($con->query($sqlInsertMatAlum) === TRUE){
              continue;
              }else{
              $ban = false;
              $msgErr .= 'Error al insertar Materia del Alumno.'.$j.'.'.$con->error;
              break;
              }
              }//end for countArrMatsIns
              }else{
              $msgErr .= 'Error al insertar grupo alumno.'.$j.'.'.$con->error;
              $ban = false;
              break;
              }
             */
        }//end if usuario != null
        else {//Si es usuario nuevo
            //Obtenemos el último ID
            $sqlGetMaxId = "SELECT MAX(id) as id FROM $tUsers ";
            $resGetMaxId = $con->query($sqlGetMaxId);
            $rowGetMaxId = $resGetMaxId->fetch_assoc();
            $idMax = $rowGetMaxId['id'] + 1;
            //Obtenemos el usuario generado
            $apTmp = str_replace(' ', '', $datos[0]);
            $user = strtolower($datos[2]{0}) . strtolower($apTmp) . strtolower($datos[1]{0}) . $idMax;
            $name = $datos[0].' '.$datos[1].' '.$datos[2];
            //Insertamos usuario
            $sqlInsertStudent = "INSERT INTO $tUsers "
                    . "(nombre, user, perfil_id, estado_id, creado) "
                    . "VALUES"
                    . "('$name', '$user', '4', '1', '$dateNow' ) ";
            if ($con->query($sqlInsertStudent) === TRUE) {
                $idStudent = $con->insert_id;
                //Insertmos Alumno en el grupo
                $sqlInsertStudentGroup = "INSERT INTO $tGAlum (grupo_info_id, user_alumno_id) "
                        . "VALUES ('$idGrupo', '$idStudent')";
                if ($con->query($sqlInsertStudentGroup) === TRUE) {
                    //Si todo correcto buscamos las materias del grupo y se las asignamos al alumno
                    $sqlGetMatsProfGroup = "SELECT id, banco_materia_id FROM $tGMatProf WHERE grupo_info_id = '$idGrupo' ";
                    $resGetMatsProfGroup = $con->query($sqlGetMatsProfGroup);
                    while ($rowGetMatsProfGroup = $resGetMatsProfGroup->fetch_assoc()) {
                        $idMatProf = $rowGetMatsProfGroup['id'];
                        $idBMat = $rowGetMatsProfGroup['banco_materia_id'];
                        $sqlInsertMatAlum = "INSERT INTO $tGMatAlum "
                                . "(grupo_mat_prof_id, user_alumno_id, creado) "
                                . "VALUES ('$idMatProf', '$idStudent', '$dateNow')";
                        if ($con->query($sqlInsertMatAlum) === TRUE) {
                            continue;
                        } else {
                            $ban = false;
                            $cad .= 'Error al asignar alumno a la materia.<br>' . $con->error;
                            break;
                        }
                    }
                } else {
                    $ban = false;
                    $cad .= 'Error al insertar alumno en el grupo.<br>' . $con->query;
                }
            } else {
                $ban = false;
                $cad .= 'Error al insertar alumno nuevo.<br>' . $con->error;
            }
        }//end else usuario existe o no
    }//end foreach csvFile
} else {
    $msgErr .= "Hubo un error al validar CSV.";
    $ban = false;
}


if ($ban) {
    $cad .= 'Grupo importado con éxito';
    echo json_encode(array("error" => 0, "msgErr" => $cad));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}

//Función para generar password usuario
// http://www.leonpurpura.com/tutoriales/generar-claves-aleatorias.html
function generar_clave($longitud) {
    $cadena = "[^A-Z0-9]";
    return substr(eregi_replace($cadena, "", md5(rand())) .
            eregi_replace($cadena, "", md5(rand())) .
            eregi_replace($cadena, "", md5(rand())), 0, $longitud);
}

?>