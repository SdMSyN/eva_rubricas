<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $name = $_POST['inputName'];
    $user = $_POST['inputUser'];
    $pass = $_POST['inputPass'];
    // Dirección
    $dir = (isset($_POST['inputDir'])) ? $_POST['inputDir'] : NULL;
    // Contacto
    $tel = (isset($_POST['inputTel'])) ? $_POST['inputTel'] : NULL;
    $mail = (isset($_POST['inputMail'])) ?  $_POST['inputMail'] : NULL;

    $cad = '';
    $ban = false;
    
    $sqlInsertInfo = "INSERT INTO $tInfo "
        . "(dir, tel, mail, creado) "
        . "VALUES"
        . "('$dir', '$tel', '$mail', '$dateNow') ";
    if($con->query($sqlInsertInfo) === TRUE){
        $idInfo = $con->insert_id;
        $sqlInsertUser = "INSERT INTO $tUsers "
            ."(nombre, user, pass, clave, informacion_id, perfil_id, estado_id, creado) "
            . "VALUES ('$name', '$user', '$pass', '$user', '$idInfo', '3', '1', '$dateNow' ) ";
        if($con->query($sqlInsertUser) === TRUE){
            $ban = true;
						$cad .= 'Profesor añadido con éxito.';
        }else{
            $ban = false;
            $cad .= 'Error al crear nueva profesor.<br>'.$con->error;
        }
    }else{
        $ban = false;
        $cad .= 'Error al insertar información.<br>'.$con->error;
    }
    
    //$ban = true;
    if($ban){
        echo json_encode(array("error"=>'0', "msg"=>$cad));
    }else{
        echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>