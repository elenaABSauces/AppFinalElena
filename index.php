<?php
require_once 'config/config.php';// incluye el fichero de configuracion de la aplicacion 
require_once 'config/configDB.php'; // incluye el fichero de configuracion de la base de datos
session_start(); // inicia una sesion o recupera una anterior
//Si se ha pulsado el botón de Mto.Departamentos
if (isset($_REQUEST['wip'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['wip']; 
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['tecnologias'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del login
    $_SESSION['paginaEnCurso'] = $controladores['tecnologias'];
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['volver'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del login
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
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


    if(isset($_SESSION['usuarioDAW216AplicacionFinal'])){ // si se ha iniciado sesion
        require_once $_SESSION['paginaEnCurso']; // incluye el controlador de la pagina en curso
    } else if (isset($_SESSION['paginaEnCursoSinRegistro'])){ // si no se ha iniciado sesion pero esta inicializada la variable de sesion 'paginaEnCursoSinRegistro'
        require_once $_SESSION['paginaEnCursoSinRegistro']; // incluye el controlador de la pagina en curso de usuarios sin registrar
    }else{
        require_once $controladores['principal']; // incluye el controlador del login
    }
?>