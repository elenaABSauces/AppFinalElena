<?php
$_SESSION['paginaAnterior'] = $controladores['inicio'];
//Si el usuario no ha iniciado sesión se le redirige al login.php
if(!isset($_SESSION['usuarioDAW216AplicacionFinal'])){ 
    header('Location: index.php');
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


if(isset($_REQUEST['rest'])){
    $_SESSION['paginaEnCurso'] = $controladores['rest']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del rest
    header('Location: index.php');
    exit;
}

if(isset($_REQUEST['mtoDepartamentos'])){
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del work in progress
    header('Location: index.php');
    exit;
}
//Si se ha pulsado el botón Borrar Cuenta
if (isset($_REQUEST['BorrarCuenta'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del editor de contraseña
    $_SESSION['paginaEnCurso'] = $controladores['borrarCuenta'];
    header('Location: index.php');
    exit;
}



$oUsuarioActual = $_SESSION['usuarioDAW216AplicacionFinal'];

//Variables que almacenan los datos del usuario sacadas de la BBDD
$numConexiones = $oUsuarioActual->getNumConexiones();
$descUsuario = $oUsuarioActual->getDescUsuario();
$ultimaConexionAnterior = $_SESSION['fechaHoraUltimaConexionAnterior'];
$imagenUsuario = $oUsuarioActual->getImagenPerfil();

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['inicio'];
$h2="Inicio";
require_once $vistas['layout'];
?>