<?php

$oUsuarioActual = $_SESSION['usuarioDAW216AplicacionFinal']; // almacenamos en la variable el usuario actual

if (isset($_REQUEST["Cancelar"])) {
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

define("OBLIGATORIO", 1); // defino e inicializo la constante a 1 para los campos que son obligatorios
define('MYSQL_FLOAT_MAX', 3.402823466E+38); // defino e inicializo la constante de el maximo float que acepta MySQL

$entradaOK = true;

$aErrores = [ //declaro e inicializo el array de errores
    'CodDepartamento' => null,
    'DescDepartamento' => null,
    'VolumenNegocio' => null
];


if (isset($_REQUEST['Aceptar'])) {
    $aErrores['CodDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['CodDepartamento'], 3, 3, OBLIGATORIO); // comprueba que la entrada del codigo de departamento es correcta
    if ($aErrores['CodDepartamento'] == null) { // si no ha habido ningun error de validacion del campo del codigo del departamento
        if (!ctype_upper($_REQUEST['CodDepartamento'])) { // si el usuario introduce el codigo del departamento en minuscula
            $aErrores['CodDepartamento'] = "El código de Departamento debe introducirse en mayusculas"; // genera un mensaje de error para que el usuario lo meta en mayusculas
        }
    }
    if ($aErrores['CodDepartamento'] == null) { // si no ha habido ningun error de validacion del campo del codigo del departamento
        if (!DepartamentoPDO::validarCodNoExiste($_REQUEST['CodDepartamento'])) {
            $aErrores['CodDepartamento'] = "El codigo ya existe";
        }
    }

    $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 255, 1, OBLIGATORIO); // compruebo que la entrada de la descripcion del departamento es correcta
    $aErrores['VolumenNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['VolumenNegocio'], MYSQL_FLOAT_MAX, 0, OBLIGATORIO); // compruebo que la entrada del volumen de negocio del departamento es correcta

    foreach ($aErrores as $campo => $error) { // recorro el array de errores
        if ($error != null) { // compruebo si hay algun mensaje de error en algun campo
            $entradaOK = false; // le doy el valor false a $entradaOK
            $_REQUEST[$campo] = ""; // si hay algun campo que tenga mensaje de error pongo $_REQUEST a null
        }
    }
} else {
    $entradaOK = false;
}

if ($entradaOK) {
    if (DepartamentoPDO::altaDepartamento($_REQUEST['CodDepartamento'], $_REQUEST['DescDepartamento'], $_REQUEST['VolumenNegocio'])) {
        $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    }
    header('Location: index.php');
    exit;
}


$vistaEnCurso = $vistas['altaDepartamento']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout'];