<?php
$_SESSION['paginaAnterior'] = $controladores['borrar'];

$oDepartamento = DepartamentoPDO::obtenerDatosDepartamento($_SESSION['CodDepartamento']);

if(isset($_REQUEST['Cancelar'])){
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
    header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
    exit;
}

if(isset($_REQUEST['Aceptar'])){
    DepartamentoPDO::bajaFisicaDepartamento($_SESSION['CodDepartamento']);
    $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
    header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
    exit;
}

$vistaEnCurso = $vistas['borrar']; // guardamos en la variable vistaEnCurso la vista que queremos implementar

require_once $vistas['layout'];
?>