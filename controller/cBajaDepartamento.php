<?php

$oUsuarioActual = $_SESSION['usuarioDAW216AplicacionFinal']; // almacenamos en la variable el usuario actual

if (isset($_REQUEST["Cancelar"])) {
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}


$oDepartamento = DepartamentoPDO::obtenerDatosDepartamento($_SESSION['codDepartamento']);

define("OBLIGATORIO", 1); // defino e inicializo la constante a 1

$entradaOK = true;

$errorFechaBaja = null; // inicializa la variable de errores de la fecha de baja

if (isset($_REQUEST['Aceptar'])) {
    $errorFechaBaja = validacionFormularios::validarFecha($_REQUEST['FechaBaja'],  '2100/01/01', date("Y/m/d", time()), OBLIGATORIO); // valida que la fecha este entre los dos valores establecidos

    if ($errorFechaBaja != null) { // compruebo si hay algun mensaje de error en algun campo
        $entradaOK = false; // le doy el valor false a $entradaOK
        $_REQUEST['FechaBaja'] = ""; // si hay algun campo que tenga mensaje de error pongo $_REQUEST a null
    }
} else {
    $entradaOK = false;
}

if ($entradaOK) {
    if (DepartamentoPDO::bajaLogicaDepartamento($_SESSION['codDepartamento'], $_REQUEST['fechaBaja'])) { // si se ha dado de baja correctamente
        $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    }
    header('Location: index.php');
    exit;
}


$vistaEnCurso = $vistas['bajaLogicaDepartamento']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout'];