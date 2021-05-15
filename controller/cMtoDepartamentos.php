<?php
$_SESSION['paginaAnterior'] = $controladores['mtoDepartamentos'];
$_SESSION['CriterioBusqueda'] = "Todos";

//Si se ha pulsado el bot�n de Cerrar Sesi�n
if (isset($_REQUEST['cerrarSesion'])) {
    //Destruye todos los datos asociados a la sesi�n
    session_destroy();
    //Redirige al login.php
    header("Location: index.php"); 
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

//Si se ha pulsado el bot�n de detalle
if (isset($_REQUEST['detalle'])) {
    //Guardamos en la variable de sesi�n 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['detalle']; 
    header('Location: index.php');
    exit;
}


if (isset($_REQUEST['volver'])) {
    //Guardamos en la variable de sesi�n 'pagina' la ruta del controlador del login
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}

if(isset($_REQUEST['rest'])){
    $_SESSION['paginaEnCurso'] = $controladores['rest']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del rest
    header('Location: index.php');
    exit;
}
$vistaEnCurso = $vistas['mtoDepartamentos']; // guardamos en la variable vistaEnCurso la vista que queremos implementar

require_once $vistas['layout'];
?>