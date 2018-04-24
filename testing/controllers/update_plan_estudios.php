<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idPlan = $_POST['inputIdPlan'];
    $planName = $_POST['inputName'];
    $planYear = $_POST['inputYear'];

    $cad = '';
    $ban = false;
    
		$sqlUpdateUser = "UPDATE $tPlanEst SET nombre='$planName', year='$planYear', actualizado='$dataTimeNow' WHERE id='$idPlan' ";
		if($con->query($sqlUpdateUser) === TRUE){
			$ban = true;
			$cad .= 'Plan de estudios modificado con éxito.';
		}else{
			$ban = false;
			$cad .= 'Error al actualizar Plan de Estudios.<br>'.$con->error;
		}
    
    //$ban = true;
    if($ban){
			echo json_encode(array("error"=>0, "msg"=>$cad));
    }else{
			echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>