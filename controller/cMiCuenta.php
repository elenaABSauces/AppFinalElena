<?php
if(isset($_REQUEST['cancelar'])) {                                             // si se ha pulsado el boton de cancelar
    $_SESSION['paginaAnterior'] = $controladores['inicio'];                     //??????????????????????????? Si no no me funciona
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];                   //Cargamos PaginaAnterior de inicio en PaginaenCurso
    header('Location: index.php');
    exit;
}
if(isset($_REQUEST['CambiarPassword'])){
    $_SESSION['paginaEnCurso'] = $controladores['cambiarPassword']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

if(isset($_REQUEST['EliminarCuenta'])){
    $_SESSION['paginaEnCurso'] = $controladores['borrarCuenta']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

define("OBLIGATORIO", 1);
define("OPCIONAL", 0);

$entradaOK = true;
$errorDescripcion = "";
$errorImagen = "";
$imagenSubida = null;

$oUsuarioActual = $_SESSION['usuarioDAW216DBProyectoFinal'];

if(isset($_REQUEST['Aceptar'])){
    $errorDescripcion = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescUsuario'], 255, 3, OBLIGATORIO);

    if($_FILES['imagen']['tmp_name']!=null){//Si el usuario ha introducido una imagen
        $tipo = $_FILES['imagen']['type'];//Almacenamos el tipo de la imagen
        if (($tipo == "image/gif") || ($tipo == "image/jpeg") || ($tipo == "image/jpg") || ($tipo == "image/png")){//Comprobamos que el tipo se encuentra entre las diferentes opciones
            $imagenSubida = file_get_contents($_FILES['imagen']['tmp_name']);//Almacenamos el archivo convertido en una cadena
            
        }else{
            $errorImagen="formato incorrecto";
        }
    }
    // Recorremos el array de errores
    if ($errorDescripcion != null) { // Comprobamos que el campo no esté vacio
        $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario
        $_REQUEST['Descripcion']="";//Limpiamos los campos del formulario
    }
    
    if ($errorImagen != null) { // Comprobamos que el campo no esté vacio
        $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario
    }
}else{
    $entradaOK = false; // Si el usuario no ha enviado el formulario asignamos a entradaOK el valor false para que rellene el formulario
}
if($entradaOK){
    $_SESSION['usuarioDDAW216DBProyectoFinal']=UsuarioPDO::modificarUsuario($oUsuarioActual->codUsuario, $_REQUEST['DescUsuario'], $imagenSubida);
    $_SESSION['paginaEnCurso'] = $controladores['paginaAnterior']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del inicios
    header('Location: index.php');
    exit;
}


$vistaEnCurso = $vistas['miCuenta']; // guardamos en la variable vistaEnCurso la vista que queremos implementar

require_once $vistas['layout'];

