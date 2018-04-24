<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $prof = array();
    $msgErr = '';
    $ban = false;
    
		$idProf = $_POST['idProf'];
    $sqlGetProf = "SELECT $tUsers.*, $tInfo.* FROM $tUsers INNER JOIN $tInfo ON $tInfo.id = $tUsers.informacion_id WHERE $tUsers.perfil_id='3' AND $tUsers.id='$idProf' AND $tUsers.estado_id='1' ";

    $resGetProf = $con->query($sqlGetProf);
    if($resGetProf->num_rows > 0){
        while($rowGetProf = $resGetProf->fetch_assoc()){
            $id = $rowGetProf['id'];
            $name = $rowGetProf['nombre'];
            $user = $rowGetProf['user'];
            $pass = $rowGetProf['pass'];
            $clave = $rowGetProf['clave'];
            $logo = $rowGetProf['logo'];
            $idInfo = $rowGetProf['informacion_id'];
            $dir = $rowGetProf['dir'];
            $tel = $rowGetProf['tel'];
            $mail = $rowGetProf['mail'];
            $prof[] = array('id'=>$id, 'nombre'=>$name, 'user'=>$user, 'pass'=>$pass, 'clave'=>$clave, 'logo'=>$logo, 'idInfo'=>$idInfo, 'dir'=>$dir, 'tel'=>$tel, 'mail'=>$mail);
            $ban = true;
        }
    }else{
        $ban = false;
        $msgErr = 'No existe el profesor.<br>'.$con->error;
    }
    
    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$prof));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>