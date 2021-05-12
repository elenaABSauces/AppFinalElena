<?php 

$_SESSION['paginaEnCursoSinRegistro'] = $controladores['principal'];

if(isset($_REQUEST['inicioSesion'])){ //  Si el usuario ha pulsado el boton Tecnoologias
    $_SESSION['paginaEnCursoSinRegistro'] = $controladores['login']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del registro
    header('Location: index.php');
    exit;
}

$vistaEnCurso = $vistas['principal']; // guardamos en la variable vistaEnCurso la vista que queremos implementar

require_once $vistas['layout'];
?>