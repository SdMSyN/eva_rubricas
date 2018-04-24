<?php
    session_start();
    include ('../config/conexion.php');
    $user = $_POST['inputUser'];
    $pass = $_POST['inputPass'];
    
    $cadErr = '';
    $ban =false;
    $perfil = 0;
    
    $sqlGetUser = "SELECT $tUsers.id as id, $tUsers.nombre as name, "
            . "$tUsers.clave as clave, $tUsers.logo, $tUsers.perfil_id, $tUPerfil.nombre as perfil_name, "
						. "$tEsc.nivel_escolar_id as nivEscId, $tUsers.escuela_id as idEsc "
            . "FROM $tUsers "
						. "INNER JOIN $tUPerfil ON $tUPerfil.id=$tUsers.perfil_id "
						. "INNER JOIN $tEsc ON $tEsc.id = $tUsers.escuela_id "
            . "WHERE BINARY $tUsers.user='$user' AND BINARY $tUsers.pass='$pass' AND $tUsers.estado_id='1' ";
    $resGetUser=$con->query($sqlGetUser);
    if($resGetUser->num_rows > 0){
				if (array_key_exists('inputCheckRecuerdame',$_POST)) {
					// Crear un nuevo cookie de sesion, que expira a los 30 días
					ini_set('session.cookie_lifetime', 60 * 60 * 24 * 30);
					session_regenerate_id(TRUE);
				}
        $rowGetUser=$resGetUser->fetch_assoc();
        $_SESSION['sessU'] = true;
        $_SESSION['userId'] = $rowGetUser['id'];
        $_SESSION['userName'] = $rowGetUser['name'];
        $_SESSION['userKey'] = $rowGetUser['clave'];
        $_SESSION['userLogo'] = $rowGetUser['logo'];
        $_SESSION['idEsc'] = $rowGetUser['idEsc'];
        $_SESSION['nivEscId'] = $rowGetUser['nivEscId'];
        $_SESSION['userPerfil'] = $rowGetUser['perfil_id'];
        $perfil = $rowGetUser['perfil_id'];
				$_SESSION['namePerfil'] = $rowGetUser['perfil_name'];
        $ban = true;
    }
    else{ 
        $_SESSION['sessU']=false;
        $cadErr = "Usuario incorrecto";
        $ban = false;
    }
                        
    if($ban){
        echo json_encode(array("error"=>0, "perfil"=>$perfil));
    }else{
        echo json_encode(array("error"=>1, "msgErr"=>$cadErr, "sql"=>$sqlGetUser));
    }
?>