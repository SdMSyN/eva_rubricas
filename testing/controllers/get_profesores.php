<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $profes = array();
    $msgErr = '';
    $ban = false;
    
    $sqlGetProf = "SELECT $tUsers.*, $tUsers.nombre as nameUser, $tEdos.nombre as estado FROM $tUsers INNER JOIN $tEdos ON $tEdos.id=$tUsers.estado_id WHERE perfil_id='3' ";
    
		$query = (isset($_POST['query'])) ? $_POST['query'] : "";
		if($query != ''){
			$sqlGetProf .= " AND $tUsers.nombre LIKE '%$query%' ";
		}
		
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
        $sqlGetProf .= " ORDER BY ".$vorder;
    }
                
    $resGetProf = $con->query($sqlGetProf);
    if($resGetProf->num_rows > 0){
        while($rowGetProf = $resGetProf->fetch_assoc()){
            $id = $rowGetProf['id'];
            $name = $rowGetProf['nameUser'];
            $user = $rowGetProf['user'];
            $edoId = $rowGetProf['estado_id'];
            $edo = $rowGetProf['estado'];
            $profes[] = array('id'=>$id, 'nombre'=>$name, 'user'=>$user, 'estado'=>$edo, 'edoId'=>$edoId);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No existen profesores aún.<br>'.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$profes));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>