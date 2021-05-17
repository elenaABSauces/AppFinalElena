<?php

$oUsuarioActual = $_SESSION['usuarioDAW216AplicacionFinal']; // almacenamos en la variable el usuario actual

if (isset($_REQUEST["Cancelar"])) {
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

$oDepartamento = DepartamentoPDO::obtenerDatosDepartamento($_SESSION['codDepartamento']);

if (isset($_REQUEST['Aceptar'])) {
    if (DepartamentoPDO::bajaFisicaDepartamento($_SESSION['codDepartamento'])) {
        $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    }
    header('Location: index.php');
    exit;
}

$vistaEnCurso = $vistas['eliminarDepartamento']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout'];