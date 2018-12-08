<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $idUser = $_POST['idStudent'];
    $ban = false;
    $msgErr = '';
    $sqlDeleteStudent = "UPDATE $tUsers SET estado_id='2' WHERE id='$idUser' ";
		//echo $sqlDeleteProf;
    if($con->query($sqlDeleteStudent) === TRUE){
        $ban = true;
    }else{
        $banTmp = false;
        $msgErr =  'Error al dar de baja al alumno.'.$con->error;
    }

    if($ban){
        $msgErr = 'Se elimino con éxito.';
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
?>