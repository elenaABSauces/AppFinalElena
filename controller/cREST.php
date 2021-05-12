<?php
if(!isset($_SESSION['usuarioDAW216DBProyectoFinal'])){                // Si el usuario no se ha logueado
        header('Location: index.php');                                          //Recargamos el index
        exit;
    }

if(isset($_REQUEST['volver'])){ // Si el usuario ha pulsado el boton de volver
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion paginaEnCurso la ruta del controlador del inicio
    header('Location: index.php'); //Cargamos el index
    exit;
}


if(isset($_REQUEST['fecha'])) { //si se ha enviado una fecha

        
        $aServicioAPOD = REST::sevicioAPOD($_REQUEST['fecha']); //llamamos al servicio y le pasamos la fecha introducida por el usuario
    }
    else { //si no llamamos al servicio y le pasamos la fecha de hoy
        
        $aServicioAPOD = REST::sevicioAPOD(date('Y-m-d'));
    }
    
    if(isset($_REQUEST['sexo'])) { //si se ha enviado el sexo

        $aElefante = REST::getElephant($_REQUEST['sexo']);//llamamos al servicio y le pasamos la fecha introducida por el usuario
        
    }else{
        $aElefante = REST::getElephant('female');
    }
    
$vistaEnCurso = $vistas['rest']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout']; // cargamos el layout

?>
    