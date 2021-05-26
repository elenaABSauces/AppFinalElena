<?php
$_SESSION['paginaAnterior'] = $controladores['REST']; // se guarda la ruta del controlador actual en la variable de sesion 'paginaEncurso' 
if(!isset($_SESSION['usuarioDAW216AplicacionFinal'])){                // Si el usuario no se ha logueado
        header('Location: index.php');                                          //Recargamos el index
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
$h2="REST";
require_once $vistas['layout']; // cargamos el layout

?>