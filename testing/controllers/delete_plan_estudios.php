<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $idPlanEst = $_POST['idPlanEst'];
    $idEdo = $_POST['idEdo'];
		$idEdo2 = ($idEdo == 1) ? 2 : 1;
    $ban = false;
    $msgErr = '';
    $sqlDeleteProf = "UPDATE $tPlanEst SET estado_id='$idEdo2' WHERE id='$idPlanEst' ";
		//echo $sqlDeleteProf;
    if($con->query($sqlDeleteProf) === TRUE){
        $ban = true;
    }else{
        $banTmp = false;
        $msgErr .= ($idEdo == 1) ? 'Error al dar de baja el plan de estudios.'.$con->error : 'Error al dar de alta el plan de estudios.'.$con->error;
    }

    if($ban){
        $msgErr = 'Se modifico con éxito.';
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
?>