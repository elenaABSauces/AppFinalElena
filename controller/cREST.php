<?php
$_SESSION['paginaAnterior'] = $controladores['REST']; // se guarda la ruta del controlador actual en la variable de sesion 'paginaEncurso' 
if(!isset($_SESSION['usuarioDAW216AplicacionFinal'])){                // Si el usuario no se ha logueado
        header('Location: index.php');                                          //Recargamos el index
        exit;
    }

if(isset($_REQUEST['volver'])){ // Si el usuario ha pulsado el boton de volver
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion paginaEnCurso la ruta del controlador del inicio
    header('Location: index.php'); //Cargamos el index
    exit;
}

//Si se ha pulsado el botón de Mto.Departamentos
if (isset($_REQUEST['wip'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['wip']; 
    header('Location: index.php');
    exit;
}

//Si se ha pulsado el botón de Cerrar Sesión
if (isset($_REQUEST['cerrarSesion'])) {
    //Destruye todos los datos asociados a la sesión
    session_destroy();
    //Redirige al login.php
    header("Location: index.php"); 
    exit;
}
//Si se ha pulsado el botón de detalle
if (isset($_REQUEST['detalle'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['detalle']; 
    header('Location: index.php');
    exit;
}
//Si se ha pulsado el botón de editar
if (isset($_REQUEST['editar'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['editar']; 
    header('Location: index.php');
    exit;
}

if(isset($_REQUEST['mtoDepartamentos'])){
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del work in progress
    header('Location: index.php');
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