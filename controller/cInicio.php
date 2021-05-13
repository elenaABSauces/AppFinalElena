<?php
$_SESSION['paginaAnterior'] = $controladores['inicio']; // se guarda la ruta del controlador actual en la variable de sesion 'paginaEncurso' 
    if(!isset($_SESSION['usuarioDAW216DBProyectoFinal'])){                //Si el usuario no se ha logeado
        header('Location: index.php');                                          //Recarga el index
        exit;
    }
if(isset($_REQUEST['editarPerfil'])){
    $_SESSION['paginaEnCurso'] = $controladores['miCuenta']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del work in progress
    header('Location: index.php');
    exit;
}

if(isset($_REQUEST['mtoDepartamentos'])){
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del work in progress
    header('Location: index.php');
    exit;
}

if(isset($_REQUEST['mtoUsuarios'])){
    $_SESSION['paginaEnCurso'] = $controladores['mtoUsuarios']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del work in progress
    header('Location: index.php');
    exit;
}

//Si se ha pulsado el botón de detalle
if (isset($_REQUEST['detalle'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['detalle']; 
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

if (isset($_REQUEST['volver'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del login
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}

if(isset($_REQUEST['rest'])){
    $_SESSION['paginaEnCurso'] = $controladores['rest']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del rest
    header('Location: index.php');
    exit;
}
if(isset($_REQUEST['wip'])){
    $_SESSION['paginaEnCurso'] = $controladores['wip']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del rest
    header('Location: index.php');
    exit;
}

//Variables que almacenan los datos del usuario sacadas de la BBDD
$numConexiones = $oUsuarioActual->getNumConexiones();
$descUsuario = $oUsuarioActual->getDescUsuario();
$ultimaConexionAnterior = $_SESSION['fechaHoraUltimaConexionAnterior'];
$imagenUsuario = $oUsuarioActual->getImagenPerfil();

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['inicio']; 
require_once $vistas['layout'];

?>