<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $idMat = $_POST['idMat'];
    $ban = false;
    $msgErr = '';
    $sqlDeleteMat = "DELETE FROM $tMats WHERE id='$idMat' ";
		//echo $sqlDeleteProf;
    if($con->query($sqlDeleteMat) === TRUE){
        $ban = true;
        $msgErr .= 'Se elimino con éxito.';
    }else{
        $banTmp = false;
        $msgErr .= 'Error al eliminar materia del plan de estudios.'.$con->error;
    }

    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
?>