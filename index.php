<?php
require_once 'config/config.php';// incluye el fichero de configuracion de la aplicacion 
require_once 'config/configDB.php'; // incluye el fichero de configuracion de la base de datos

session_start(); // Iniciamos una sesion o recuperamos la sesion anterior

if (isset($_REQUEST['cerrarSesion'])) { // si se ha pulsado el boton de Cerrar Sesion
    session_destroy(); // destruye todos los datos asociados a la sesion
    header("Location: index.php"); // redirige al login
    exit;
}

if(isset($_REQUEST['Tecnologias'])){ //  Si el usuario ha pulsado el boton Tecnoologias
    $_SESSION['paginaEnCursoSinRegistro'] = $controladores['tecnologias']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['tecnologias'];
    header('Location: index.php');
    exit;
}

if(isset($_SESSION['usuarioDAW215AplicacionFinal'])){ // Si el usuario ha iniciado sesion
    require_once $_SESSION['paginaEnCurso']; // Incluimos el controlador la pagina en curso
} else if (isset($_SESSION['paginaEnCursoSinRegistro'])){ // Si el usuario no ha iniciado sesion y a solicitado una pagina en curso sin registro
    require_once $_SESSION['paginaEnCursoSinRegistro']; // Incluimos el controlador de la pagina en curso sin registro
}else{ // Si el usuario no se ha identificado y no ha solicitado ninguna pagina en curso sin registro por defecto cargaremos el login
    require_once $controladores['principal']; // Incluimos el controlador del login
}

?>