<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $idProf = $_POST['idProf'];
    $idEdo = $_POST['idEdo'];
		$idEdo2 = ($idEdo == 1) ? 2 : 1;
    $ban = false;
    $msgErr = '';
    $sqlDeleteProf = "UPDATE $tUsers SET estado_id='$idEdo2' WHERE id='$idProf' ";
		//echo $sqlDeleteProf;
    if($con->query($sqlDeleteProf) === TRUE){
        $ban = true;
    }else{
        $banTmp = false;
        $msgErr .= ($idEdo == 1) ? 'Error al dar de baja al profesor.'.$con->error : 'Error al dar de alta al profesor.'.$con->error;
    }

    if($ban){
        $msgErr = 'Se modifico con éxito.';
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
?>