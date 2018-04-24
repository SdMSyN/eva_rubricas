<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idMat = $_POST['inputIdMat'];
    $matName = $_POST['inputName'];
    $matGrado = $_POST['inputGrado'];

    $cad = '';
    $ban = false;
    
		$sqlUpdateMat = "UPDATE $tMats SET nombre='$matName', nivel_grado_id='$matGrado', actualizado='$dataTimeNow' WHERE id='$idMat' ";
		if($con->query($sqlUpdateMat) === TRUE){
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