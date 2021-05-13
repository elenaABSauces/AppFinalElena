<?php
$_SESSION['paginaAnterior'] = $controladores['detalle']; // se guarda la ruta del controlador actual en la variable de sesion 'paginaEncurso' 
if(!isset($_SESSION['usuarioDAW216DBProyectoFinal'])){ //Si no hay una sesión iniciada te manda al Login
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

//Si se ha pulsado volver
if (isset($_REQUEST['volver'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del login
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['detalle']; 

require_once $vistas['layout'];                                            //Cargamos el layout
?>                                            //Cargamos el layout
?>