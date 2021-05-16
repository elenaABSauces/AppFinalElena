<?php

$oUsuarioActual = $_SESSION['usuarioDAW216AplicacionFinal']; // almacenamos en la variable el usuario actual

if(isset($_REQUEST["Cancelar"])){
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}


$oDepartamento = DepartamentoPDO::obtenerDatosDepartamento($_SESSION['codDepartamento']);


define("OBLIGATORIO", 1); // defino e inicializo la constante a 1 para los campos que son obligatorios
define('MYSQL_FLOAT_MAX', 3.402823466E+38); // defino e inicializo la constante de el maximo float que acepta MySQL

$entradaOK = true;

$aErrores = [//declaro e inicializo el array de errores
    'DescDepartamento' => null,
    'VolumenNegocio' => null
];

if(isset($_REQUEST['Aceptar'])){
    $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 255, 1, OBLIGATORIO); // compruebo que la entrada de la descripcion del departamento es correcta
    $aErrores['VolumenNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['VolumenNegocio'], MYSQL_FLOAT_MAX, 0, OBLIGATORIO); // compruebo que la entrada del volumen de negocio del departamento es correcta

    foreach ($aErrores as $campo => $error) { // recorro el array de errores
        if ($error != null) { // compruebo si hay algun mensaje de error en algun campo
            $entradaOK = false; // le doy el valor false a $entradaOK
            $_REQUEST[$campo] = ""; // si hay algun campo que tenga mensaje de error pongo $_REQUEST a null
        }
    }
} else { // si el usuario no le ha dado al boton de enviar
    $entradaOK = false; // le doy el valor false a $entradaOK
}

if($entradaOK){
    if(DepartamentoPDO::modificarDepartamento($_SESSION['codDepartamento'],$_REQUEST['DescDepartamento'],$_REQUEST['VolumenNegocio'])){
        $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    }
    header('Location: index.php');
    exit;
}




$vistaEnCurso = $vistas['consultarModificarDepartamento']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout'];


?>