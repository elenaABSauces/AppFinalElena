<?php

$oUsuarioActual = $_SESSION['usuarioDAW216AplicacionFinal']; // almacenamos en la variable el usuario actual

if (isset($_REQUEST['Cancelar'])) { // si se ha pulsado el boton de cancelar
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del inicio
    
    header('Location: index.php');
    exit;
}

$entradaOK = true;

$errorArchivoImportado = null;
$errorFormato = null;

if (isset($_REQUEST['Aceptar'])) { // si se ha pulsado Aceptar
    $errorFormato = validacionFormularios::validarElementoEnLista($_REQUEST['Formato'],["text/xml","application/json","application/vnd.ms-excel"]);
    
    if ($_FILES['ArchivoImportado']['type'] != $_REQUEST['Formato']) { // comprueba si el fichero no es de tipo xml
        $errorArchivoImportado = "El fomato de archivo debe ser ". substr($_REQUEST['Formato'],strpos($_REQUEST['Formato'],"/")+1) ; // guarda un mensaje en la variable de error del archivo
    }
    
    if($errorArchivoImportado!=null){ // si hay algun error con el archivo
        $entradaOK=false;
    }
    
    if($errorFormato != null){
        $_REQUEST['Formato'] = "";
        $entradaOK = false;
    }
}else{
    $entradaOK=false;
}

if($entradaOK){
    if(DepartamentoPDO::importar($_FILES['ArchivoImportado']['tmp_name'],$_FILES['ArchivoImportado']['type'])){
        $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del inicio
    }
    header("Location: index.php");
    exit;
}


$vistaEnCurso = $vistas['importarDepartamentos']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
$h2="Importar departamentos";
require_once $vistas['layout'];

?>