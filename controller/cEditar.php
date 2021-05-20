<?php
$_SESSION['paginaAnterior'] = $controladores['editar'];
//Si se ha pulsado el botón Cancelar
if(isset($_REQUEST['Cancelar'])){
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del inicio
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; 
    header('Location: index.php');
    exit;
}
if(isset($_REQUEST['volver'])){ // Si el usuario ha pulsado el boton de volver
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion paginaEnCurso la ruta del controlador del inicio
    header('Location: index.php'); //Cargamos el index
    exit;
}
//Si se ha pulsado el botón Cambiar contraseña
if(isset($_REQUEST['CambiarPassword'])){
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del editor de contraseña
    $_SESSION['paginaEnCurso'] = $controladores['cambiarPassword']; 
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['wip'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['wip']; 
    header('Location: index.php');
    exit;
}

//Si se ha pulsado el botón de Cerrar Sesión
if (isset($_REQUEST['cerrarSesion'])) {
    //Destruye todos los datos asociados a la sesión
    session_destroy();
    //Redirige al login.php
    header("Location: index.php"); 
    exit;
}
//Si se ha pulsado el botón de detalle
if (isset($_REQUEST['detalle'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['detalle']; 
    header('Location: index.php');
    exit;
}
//Si se ha pulsado el botón de editar
if (isset($_REQUEST['editar'])) {
    //Guardamos en la variable de sesión 'pagina' la ruta del controlador del registro
    $_SESSION['paginaEnCurso'] = $controladores['editar']; 
    header('Location: index.php');
    exit;
}


if(isset($_REQUEST['rest'])){
    $_SESSION['paginaEnCurso'] = $controladores['rest']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del rest
    header('Location: index.php');
    exit;
}

if(isset($_REQUEST['mtoDepartamentos'])){
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del work in progress
    header('Location: index.php');
    exit;
}
//Definición y declaración de variables
define("OBLIGATORIO", 1);
define("OPCIONAL", 0);

$entradaOK = true;
$errorDescripcion = "";

//Creación del objeto usuarioActual con los datos almacenados en la sesión
$oUsuarioActual = $_SESSION['usuarioDAW216AplicacionFinal'];
//Variables que almacenan los datos del usuario
$codUsuario = $oUsuarioActual->getCodUsuario();
$numConexiones = $oUsuarioActual->getNumConexiones();
$descUsuario = $oUsuarioActual->getDescUsuario();

//Si se ha pulsado el botón Aceptar llamamos a la librería de validación para comprobar el campo introducido
if(isset($_REQUEST['Aceptar'])){
    $errorDescripcion = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescUsuario'], 255, 3, OBLIGATORIO);

    // Recorremos los arrays de errores comprobando que los campos no estén vacíos
    if ($errorDescripcion != null) {
        //En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario
        $entradaOK = false;
        //Limpiamos los campos del formulario
        $_REQUEST['Descripcion'] = "";
    }
}else{
    //Si el usuario no ha enviado el formulario asignamos a entradaOK el valor false para que rellene el formulario
    $entradaOK = false; 
}
//Si todo ha ido bien llamamos al método modificarUsuario, le pasamos los valores que necesita y volvemos a la página de inicio
if($entradaOK){
    $_SESSION['usuarioDAW216AplicacionFinal']=UsuarioPDO::modificarUsuario($codUsuario, $_REQUEST['DescUsuario'], $imagenSubida);
    $_SESSION['paginaEnCurso'] = $controladores['inicio'];
    header('Location: index.php');
    exit;
}

//Guardamos en la variable vistaEnCurso la vista que queremos implementar
$vistaEnCurso = $vistas['editar'];
$h2="Editar perfil";
require_once $vistas['layout'];
?> 

