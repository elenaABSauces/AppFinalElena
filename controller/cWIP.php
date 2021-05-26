<?php
$_SESSION['paginaAnterior'] = $controladores['REST']; // se guarda la ruta del controlador actual en la variable de sesion 'paginaEncurso' 
if(!isset($_SESSION['usuarioDAW216AplicacionFinal'])){                // Si el usuario no se ha logueado
        header('Location: index.php');                                          //Recargamos el index
        exit;
    }
//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['wip'];
$h2="WORK IN PROGRESS";
require_once $vistas['layout'];
?>

