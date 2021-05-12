<?php
$_SESSION['paginaAnterior'] = $controladores['inicio'];
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

if(isset($_REQUEST['rest'])){
    $_SESSION['paginaEnCurso'] = $controladores['rest']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del rest
    header('Location: index.php');
    exit;
}

$oUsuarioActual = $_SESSION['usuarioDAW216DBProyectoFinal'];

if(isset($_SESSION['fechaHoraUltimaConexionAnterior'])){
    $ultimaConexion = $_SESSION['fechaHoraUltimaConexionAnterior']; // variable que tiene la ultima hora de conexion del usuario
}

$vistaEnCurso = $vistas['inicio']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout']; // incluimos la vista del layout

?>