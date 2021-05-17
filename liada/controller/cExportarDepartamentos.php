<?php

$oUsuarioActual = $_SESSION['usuarioDAW216AplicacionFinal']; // almacenamos en la variable el usuario actual

if (isset($_REQUEST['Cancelar'])) { // si se ha pulsado el boton de cancelar
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del mtoDepartamento

    header('Location: index.php');
    exit;
}

$entradaOK = true;

$errorFormato = null;


if (isset($_REQUEST['Aceptar'])) {
    $errorFormato = validacionFormularios::validarElementoEnLista($_REQUEST['Formato'], ["xml", "json", "csv"]);

    if ($errorFormato != null) {
        $_REQUEST['Formato'] = "";
        $entradaOK = false;
    }
} else {
    $entradaOK = false;
}

if ($entradaOK) {
    $formato = $_REQUEST['Formato'];
    DepartamentoPDO::exportar($formato);
}

$vistaEnCurso = $vistas['exportarDepartamentos']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout'];