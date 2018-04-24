<?php

    if(isset($_SESSION['sessU'])  AND $_SESSION['sessU'] == "true"){
        $cadMenuNavbar='';
        if($_SESSION['userPerfil'] == "1"){//Director
						$cadMenuNavbar .= '<li><a href="#"><i class="fa fa-calendar text-green"></i> <span>Asignaciones</span></a></li>';
						$cadMenuNavbar .= '<li><a href="director_planes_estudios.php"><i class="fa fa-list text-yellow"></i> <span>Planes de estudio</span></a></li>';
        } else if($_SESSION['userPerfil'] == "2"){//Administrativo
            $cadMenuNavbar .= '<li><a href="administrativo_grupos.php"><i class="fa fa-users text-red"></i> <span>Grupos</span></a></li>';
            $cadMenuNavbar .= '<li><a href="administrativo_profesores.php"><i class="fa fa-user text-aqua"></i> <span>Profesores</span></a></li>';
            $cadMenuNavbar .= '<li><a href="#"><i class="fa fa-graduation-cap text-yellow"></i> <span>Alumnos</span></a></li>';
            $cadMenuNavbar .= '<li><a href="administrativo_materias.php"><i class="fa fa-book text-green"></i> <span>Materías</span></a></li>';
        } else if($_SESSION['userPerfil'] == "3"){//Profesor
          
        } else if($_SESSION['userPerfil'] == "4"){//Alumno
          
        } else if($_SESSION['userPerfil'] == "5"){ //Tutor
          
        } else if($_SESSION['userPerfil'] == "10"){ //Sysadmin
          
        } else{
            $cadMenuNavbar .= '<li>¿Cómo llegaste hasta acá?</li>';
        }
        echo $cadMenuNavbar;
    }
	
?>