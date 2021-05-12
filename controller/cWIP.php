<?php
  if(!isset($_SESSION['usuarioDAW216DBProyectoFinal'])){                // Si el usuario no se ha logueado
        header('Location: index.php');                                          //Recargamos el index
        exit;
    }
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior']; // guardamos en la variable de sesion 'pagina' la ruta del controlador anterior
    $_SESSION['paginaEnCursoSinRegistro'] = $_SESSION['paginaAnterior']; // guardamos en la variable de sesion 'pagina' la ruta del controlador anterior
    header('Location: index.php');
    exit;
}

$vistaEnCurso = $vistas['wip']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout'];

?>