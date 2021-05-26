<?php
$_SESSION['paginaAnterior'] = $controladores['inicio'];
//Si el usuario no ha iniciado sesión se le redirige al login.php
if(!isset($_SESSION['usuarioDAW216AplicacionFinal'])){ 
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