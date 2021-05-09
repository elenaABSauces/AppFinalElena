<?php
$_SESSION['paginaAnterior'] = $controladores ['rest'];

error_reporting(0);

if(isset($_REQUEST['volver'])){ // Si el usuario ha pulsado el boton de volver
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion paginaEnCurso la ruta del controlador del inicio
    header('Location: index.php'); //Cargamos el index
    exit;
}

$apodSelected = "selected"; //marcamos como seleccionado el servicio por defecto (apod)
$apodDisplay = "block"; //mostramos el servicio por defecto (apod)

if($_REQUEST['fecha']) { //si se ha enviado una fecha
        
        $aServicioAPOD = REST::sevicioAPOD($_REQUEST['fecha']); //llamamos al servicio y le pasamos la fecha introducida por el usuario
    }
    else { //si no llamamos al servicio y le pasamos la fecha de hoy
        
        $aServicioAPOD = REST::sevicioAPOD(date('Y-m-d'));
    }
    
  
   

error_reporting(-1);
$vistaEnCurso = $vistas['rest']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout']; // cargamos el layout

?>

    