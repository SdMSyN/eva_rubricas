<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $mats = array();
    $msgErr = '';
    $ban = false;
    
		$idPlan = $_POST['idPlan'];
    $sqlGetMatsPlanEst = "SELECT $tMats.id as idMat, $tMats.nombre as nameMat, "
			." $tGrade.nombre as nameGrade "
			." FROM $tMats INNER JOIN $tGrade ON $tGrade.id=$tMats.nivel_grado_id "
			." WHERE $tMats.plan_estudio_id = '$idPlan' ";
    
		$query = (isset($_POST['query'])) ? $_POST['query'] : "";
		if($query != ''){
			$sqlGetMatsPlanEst .= " AND ($tMats.nombre LIKE '%$query%' OR $tGrade.nombre LIKE '%$query%' ) ";
		}
		$tarea = (isset($_POST['tarea'])) ? $_POST['tarea'] : "";
		if($tarea != ''){
			$idMat = $_POST['idMat'];
			$sqlGetMatsPlanEst .= " AND $tMats.id = '$idMat' ";
		}
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
      $sqlGetMatsPlanEst .= " ORDER BY ".$vorder;
    }else{
			$sqlGetMatsPlanEst .= " ORDER BY nameGrade ";
		}
    
    $resGetProf = $con->query($sqlGetMatsPlanEst);
    if($resGetProf->num_rows > 0){
        while($rowGetProf = $resGetProf->fetch_assoc()){
            $id = $rowGetProf['idMat'];
            $nameMat = $rowGetProf['nameMat'];
            $nameGrade = $rowGetProf['nameGrade'];
            $mats[] = array('id'=>$id, 'nombre'=>$nameMat, 'grado'=>$nameGrade );
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen materias en este plan de estudio, aún.<br>'.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$mats, "sql"=>$sqlGetMatsPlanEst));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>