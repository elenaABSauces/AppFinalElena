<?php 

require_once 'config/config.php';
require_once 'config/configDB.php';


session_start(); // Iniciamos una sesion o recuperamos la sesion anterior

if(isset($_SESSION['usuarioDAW216DBProyectoFinal'])){ // Si el usuario ha iniciado sesion
    require_once $_SESSION['paginaEnCurso']; // Incluimos el controlador la pagina en curso
} else if (isset($_SESSION['paginaEnCursoSinRegistro'])){ // Si el usuario no ha iniciado sesion y a solicitado una pagina en curso sin registro
    require_once $_SESSION['paginaEnCursoSinRegistro']; // Incluimos el controlador de la pagina en curso sin registro
}else{ // Si el usuario no se ha identificado y no ha solicitado ninguna pagina en curso sin registro por defecto cargaremos el login
    require_once $controladores['principal']; // Incluimos el controlador del login
}
?>