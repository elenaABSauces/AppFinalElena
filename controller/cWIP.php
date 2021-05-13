<?php

  if(!isset($_SESSION['usuarioDAW216DBProyectoFinal'])){                // Si el usuario no se ha logueado
        header('Location: index.php');                                          //Recargamos el index
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
    $_SESSION['paginaEnCurso'] = $controladores['paginaAnterior'];
    header('Location: index.php');
    exit;
}
$vistaEnCurso = $vistas['wip']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout'];

?>