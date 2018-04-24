<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idUser = $_POST['inputIdUser'];
    $idInfo = $_POST['inputIdInfo'];
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
    
    $sqlUpdateInfo = "UPDATE $tInfo SET dir='$dir', tel='$tel', mail='$mail', actualizado='$dataTimeNow' WHERE id='$idInfo' ";
    if($con->query($sqlUpdateInfo) === TRUE){
        $sqlUpdateUser = "UPDATE $tUsers SET nombre='$name', user='$user', pass='$pass', actualizado='$dataTimeNow' WHERE id='$idUser' ";
        if($con->query($sqlUpdateUser) === TRUE){
            $ban = true;
						$cad .= 'Profesor modificado con éxito.';
        }else{
            $ban = false;
            $cad .= 'Error al actualizar profesor.<br>'.$con->error;
        }
    }else{
        $ban = false;
        $cad .= 'Error al insertar información.<br>'.$con->error;
    }
    
    //$ban = true;
    if($ban){
        echo json_encode(array("error"=>0, "msg"=>$cad));
    }else{
        echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>