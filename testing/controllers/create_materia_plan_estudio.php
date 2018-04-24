<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idPlanEst = $_POST['inputIdPlanEst'];
    $name = $_POST['inputName'];
    $grade = $_POST['inputGrado'];

    $cad = '';
    $ban = false;
    
		$sqlInsertMat = "INSERT INTO $tMats "
				. "(nombre, nivel_grado_id, plan_estudio_id, creado) "
				. "VALUES ('$name', '$grade', '$idPlanEst', '$dataTimeNow' ) ";
		if($con->query($sqlInsertMat) === TRUE){
			$ban = true;
			$cad .= 'Materia añadida con éxito.';
		}else{
			$ban = false;
			$cad .= 'Error al añadir materia al plan de estudios.<br>'.$con->error;
		}
		
    //$ban = true;
    if($ban){
        echo json_encode(array("error"=>0, "msg"=>$cad));
    }else{
        echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>