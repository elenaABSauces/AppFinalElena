<?php 

$_SESSION['paginaAnterior'] = $controladores ['cambiarPassword'];

if(isset($_REQUEST['Cancelar'])){
    $_SESSION['paginaEnCurso'] = $controladores['miCuenta']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}


define("OBLIGATORIO", 1);
$entradaOK = true;
$aErrores = [ //declaro e inicializo el array de errores
    'Password' => null,
    'NuevaPassword' => null,
    'RepetirPassword' => null
];
$oUsuarioActual = $_SESSION['usuarioDAW216DBProyectoFinal'];

if(isset($_REQUEST['Aceptar'])){
    $aErrores['Password'] = validacionFormularios::validarPassword($_REQUEST['Password'], 8, 1, 1, OBLIGATORIO);// comprueba que la entrada del password es correcta
    $aErrores['NuevaPassword'] = validacionFormularios::validarPassword($_REQUEST['NuevaPassword'], 8, 1, 1, OBLIGATORIO);
    $aErrores['RepetirPassword'] = validacionFormularios::validarPassword($_REQUEST['RepetirPassword'], 8, 1, 1, OBLIGATORIO);
    
    if($_REQUEST['NuevaPassword'] != $_REQUEST['RepetirPassword']){
        $aErrores['RepetirPassword'] = "Las contraseñas no coinciden";
    }
    
    foreach ($aErrores as $campo => $error) { // recorro el array de errores
        if ($error != null) { // compruebo si hay algun mensaje de error en algun campo
            $entradaOK = false; // le doy el valor false a $entradaOK
            $_REQUEST[$campo] = ""; // si hay algun campo que tenga mensaje de error pongo $_REQUEST a null
        }
    }

    if($entradaOK){
        $passwordEncriptada = hash("sha256", $oUsuarioActual->codUsuario.$_REQUEST['Password']);
        if($oUsuarioActual->password != $passwordEncriptada){
            $entradaOK = false;
            $_REQUEST['Password'] = "";
        }
    }
}else{
    $entradaOK = false;
}

if($entradaOK){
    $_SESSION['usuarioDAW216DBProyectoFinal'] = UsuarioPDO::cambiarPassword($oUsuarioActual->codUsuario, $_REQUEST['NuevaPassword']);
    $_SESSION['paginaEnCurso'] = $controladores['miCuenta']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

$vistaEnCurso = $vistas['cambiarPassword']; // guardamos en la variable vistaEnCurso la vista que queremos implementar

require_once $vistas['layout'];
?>