<?php
$_SESSION['paginaAnterior'] = $controladores['REST']; // se guarda la ruta del controlador actual en la variable de sesion 'paginaEncurso' 
if(!isset($_SESSION['usuarioDAW216AplicacionFinal'])){                // Si el usuario no se ha logueado
        header('Location: index.php');                                          //Recargamos el index
        exit;
    }
$vistaEnCurso = $vistas['tecnologias']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
$h2="TECNOLOGÍAS UTILIZADAS";
require_once $vistas['layout'];

?>