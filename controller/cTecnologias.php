<?php

if(isset($_REQUEST["Volver"])){
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior']; 
    header('Location: index.php');
    exit;
} 


$vistaEnCurso = $vistas['tecnologias']; // guardamos en la variable vistaEnCurso la vista que queremos implementar
require_once $vistas['layout'];

?>