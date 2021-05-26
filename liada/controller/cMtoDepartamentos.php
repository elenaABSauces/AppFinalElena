<?php

$oUsuarioActual = $_SESSION['usuarioDAW216AplicacionFinal']; // almacenamos en la variable el usuario actual

if (isset($_REQUEST["Volver"])) {
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

if (isset($_REQUEST["InsertarDepartamento"])) {
    $_SESSION['codDepartamento'] = $_REQUEST["InsertarDepartamento"];
    $_SESSION['paginaEnCurso'] = $controladores['altaDepartamento']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

if (isset($_REQUEST["ConsultarModificarDepartamento"])) {
    $_SESSION['codDepartamento'] = $_REQUEST["ConsultarModificarDepartamento"];
    $_SESSION['paginaEnCurso'] = $controladores['consultarModificarDepartamento']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

if (isset($_REQUEST["EliminarDepartamento"])) {
    $_SESSION['codDepartamento'] = $_REQUEST["EliminarDepartamento"];
    $_SESSION['paginaEnCurso'] = $controladores['eliminarDepartamento']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

if (isset($_REQUEST["BajaLogicaDepartamento"])) {
    $_SESSION['codDepartamento'] = $_REQUEST["BajaLogicaDepartamento"];
    $_SESSION['paginaEnCurso'] = $controladores['bajaLogicaDepartamento']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

if (isset($_REQUEST["RehabilitacionDepartamento"])) {
    $_SESSION['codDepartamento'] = $_REQUEST["RehabilitacionDepartamento"];
    $_SESSION['paginaEnCurso'] = $controladores['rehabilitacionDepartamento']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

if (isset($_REQUEST["ImportarDepartamentos"])) {
    $_SESSION['paginaEnCurso'] = $controladores['importarDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

if (isset($_REQUEST["ExportarDepartamentos"])) {
    $_SESSION['paginaEnCurso'] = $controladores['exportarDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['BusquedaDepartamento'])) {
    $_SESSION['BusquedaDepartamento'] = "";
}
if (!isset($_SESSION['CriterioBusqueda'])) {
    $_SESSION['CriterioBusqueda'] = "todos";
}
if (!isset($_SESSION['PaginaActual'])) { // si no esta definida la variable de sesion "PaginaActual"
    $_SESSION['PaginaActual'] = 1; // inicializacion de la variable de sesion "PaginaActual" a 1 para que muestre la primera pagina la primera vez
}


if (isset($_REQUEST['avanzarPagina'])) { // si se ha pulsado avanzar pagina
    $_SESSION['PaginaActual'] = $_REQUEST['avanzarPagina']; // el numero de pagina es el valor del boton avanzar pagina ($numero de pagina +1)
} else if (isset($_REQUEST['retrocederPagina'])) { // si se ha pulsado retroceder pagina
    $_SESSION['PaginaActual'] = $_REQUEST['retrocederPagina']; // el numero de pagina es el valor del boton retroceder pagina ($numero de pagina -1)
} else if (isset($_REQUEST['paginaInicial'])) { // si se ha pulsado pagina inicial
    $_SESSION['PaginaActual'] = $_REQUEST['paginaInicial']; // el numero de pagina es el valor del boton pagina inicial (1)
} else if (isset($_REQUEST['paginaFinal'])) { // si se ha pulsado pagina final
    $_SESSION['PaginaActual'] = $_REQUEST['paginaFinal']; // el numero de pagina es el valor del boton pagina inicial ($numPaginaMaximo)
}


$entradaOK = true;
define("OPCIONAL", 0);
$aErrores = [
    'codDepartamento' => null,
    'criterioBusqueda' => null
];


if (isset($_REQUEST["Buscar"])) {
    $aErrores['codDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 255, 1, OPCIONAL);
    $aErrores['criterioBusqueda'] = validacionFormularios::validarElementoEnLista($_REQUEST['BusquedaPor'],["todos","alta","baja"]);

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
    $_SESSION['BusquedaDepartamento'] = $_REQUEST['DescDepartamento'];
    $_SESSION['PaginaActual'] = 1;
    $_SESSION['CriterioBusqueda'] = $_REQUEST["BusquedaPor"];

    $aResultadoBusqueda = DepartamentoPDO::buscarDepartamentosPorDescripcion($_SESSION['BusquedaDepartamento'], $_SESSION['CriterioBusqueda'], $_SESSION['PaginaActual'], MAX_DEPARTAMENTOS_PAGINA);
    $aDepartamentos = $aResultadoBusqueda[0];
}else{
    $aResultadoBusqueda = DepartamentoPDO::buscarDepartamentosPorDescripcion($_SESSION['BusquedaDepartamento'], $_SESSION['CriterioBusqueda'], $_SESSION['PaginaActual'], MAX_DEPARTAMENTOS_PAGINA);
}


// $busquedaDepartamento = $_SESSION['BusquedaDepartamento'];
// $criterioBusqueda = $_SESSION['CriterioBusqueda'];

// if($entradaOK){
//     $_SESSION['BusquedaDepartamento'] = $_REQUEST['DescDepartamento'];
//     $_SESSION['PaginaActual'] = 1;
// }

// $aResultadoBusqueda = DepartamentoPDO::buscarDepartamentosPorDescripcion($_SESSION['BusquedaDepartamento'],$_SESSION['PaginaActual'],MAX_DEPARTAMENTOS_PAGINA);
$criterioBusqueda = $_SESSION['CriterioBusqueda'];
$aDepartamentos = $aResultadoBusqueda[0];
$paginasTotales = $aResultadoBusqueda[1];
$paginaActual = $_SESSION['PaginaActual'];
$busquedaDepartamento = $_SESSION['BusquedaDepartamento'];


$vistaEnCurso = $vistas['mtoDepartamentos']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout'];